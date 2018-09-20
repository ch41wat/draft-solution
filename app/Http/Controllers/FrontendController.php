<?php

namespace App\Http\Controllers;

use App\Customer;
use App\EquipmentAssignment;
use App\Http\Controllers\Controller;
use App\Service;
use App\Reservoir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Exports\DraftsExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Mail;
use App\Mail\verifyUser;
use App\Draft;
use App\Pipe;

class FrontendController extends Controller
{

    public function index(Request $request, $form)
    {
        $step_form = [
            [
                'link' => 'home',
                'name' => config('app.name'),
            ], [
                'link' => 'customer',
                'name' => 'ข้อมูลลูกค้า',
            ], [
                'link' => 'service',
                'name' => 'เลือกประเภทบริการ/เทคโนโลยี',
            ], [
                'link' => 'draft',
                'name' => 'สรุปรายละเอียด',
            ], /*[
        'link' => 'success',
        'name' => 'บันทึก ' . config('app.name'),
        ],*/
        ];
        $draft = $request->session()->get('draft');
        if ($form == 'home') {
            $request->session()->forget('draft');
            return view("frontend.$form", compact(['step_form', 'draft']));
        }
        $service = Service::all();
        $technology = DB::table('technologies AS t')
            ->join('pictures AS p', function ($join) {
                $join->whereRaw("find_in_set(p.id, t.picture)");
            })
            ->select(
                't.id', 't.name', 't.video', 't.picture', 't.service',
                DB::raw('GROUP_CONCAT(p.name) AS picture_name')
            )
            ->groupBy('t.id', 't.name', 't.video', 't.picture', 't.service')
            ->orderBy('p.id')
            ->where('t.service', '=', (isset($draft->service)) ? $draft->service : null)
            ->get();
        return view("frontend.$form.create", compact(['step_form', 'draft', 'service', 'technology']));
    }

    public function service(Request $request, $array)
    {
        $step_form = [
            [
                'link' => 'home',
                'name' => config('app.name'),
            ], [
                'link' => 'customer',
                'name' => 'ข้อมูลลูกค้า',
            ], [
                'link' => 'service',
                'name' => 'เลือกประเภทบริการ/เทคโนโลยี',
            ], [
                'link' => 'draft',
                'name' => 'สรุปรายละเอียด',
            ],
        ];
        $draft = $request->session()->get('draft');
        $query = DB::table('technologies AS t')
            ->join('pictures AS p', function ($join) {
                $join->whereRaw("find_in_set(p.id, t.picture)");
            })
            ->select(
                't.id', 't.name', 't.video', 't.picture', 't.service',
                DB::raw('GROUP_CONCAT(p.name) AS picture_name')
            )
            ->groupBy('t.id', 't.name', 't.video', 't.picture', 't.service')
            ->orderBy('p.id');
        foreach ($draft->technology_id as $item) {
            $query->orWhere('t.id', '=', $item);
        }
        $technology = $query->get();
        $reservoir = Reservoir::all();
        $pipes = Pipe::all();
        return view("frontend.technology.create", compact(['step_form', 'draft', 'technology', 'reservoir', 'pipes']));
    }

    public function draft(Request $request)
    {
        // dd($request);
        $step_form = [
            [
                'link' => 'home',
                'name' => config('app.name'),
            ], [
                'link' => 'customer',
                'name' => 'ข้อมูลลูกค้า',
            ], [
                'link' => 'service',
                'name' => 'เลือกประเภทบริการ/เทคโนโลยี',
            ], [
                'link' => 'draft',
                'name' => 'สรุปรายละเอียด',
            ],
        ];
        $draft = $request->session()->get('draft');
        $query = DB::table('technologies AS t')
            ->join('pictures AS p', function ($join) {
                $join->whereRaw("find_in_set(p.id, t.picture)");
            })
            ->select(
                't.id', 't.name', 't.video', 't.picture', 't.service',
                DB::raw('GROUP_CONCAT(p.name) AS picture_name')
            )
            ->groupBy('t.id', 't.name', 't.video', 't.picture', 't.service')
            ->orderBy('p.id');
        foreach ($draft->technology_id as $item) {
            $query->orWhere('t.id', '=', $item);
            if ($draft->reservoir[$item]) {
                $reservoir[$item] = Reservoir::findOrFail($draft->reservoir[$item]);
            }
            $service[$item] = Service::findOrFail($draft->service);
            $equipment_assignment[$item] = EquipmentAssignment::with(['technology', 'equipment', 'picture'])
                ->where('technology_id', '=', $item)
                ->get();
        }
        $technology = $query->get();
        return view("frontend.draft.create", compact([
            'step_form', 'draft', 'technology', 'reservoir', 'equipment_assignment', 'service'
        ]));
    }

    public function postCreateCustomer(Request $request)
    {
        if ($request->input('customer_type') == 'customer-old') {
            $validatedData = $request->validate([
                'customer_type' => 'required',
                'customer_name_old' => 'required',
            ]);
        } else {
            $validatedData = $request->validate([
                'customer_type' => 'required',
                'company_name' => 'required',
                'customer_name' => 'required',
            ]);
        }

        if (empty($request->session()->get('draft'))) {
            $draft = new Customer();
            $draft->fill($validatedData);
            $draft->customer_type = $request->input('customer_type');
        } else {
            $draft = $request->session()->get('draft');
            $draft->fill($validatedData);
            $draft->customer_type = $request->input('customer_type');
        }
        $draft->draft_level = 1;
        $draft->customer_name_old = $request->input('customer_name_old');
        $request->session()->put('draft', $draft);
        return redirect(route(Auth::user()->role . '-create-form', 'service'));

    }

    public function postCreateService(Request $request)
    {
        $validatedData = $request->validate([
            'service' => 'required',
            'technology_id' => 'required|array',
            'technology_id.*' => 'required',
        ]);

        $draft = $request->session()->get('draft');
        $draft->fill($validatedData);
        $draft->service = $request->input('service');
        $draft->technology_id = $request->input('technology_id');
        $draft->draft_level = 2;
        $request->session()->put('draft', $draft);
        return redirect(route(Auth::user()->role . '-create-service-form', $request->input('technology_id')));

    }

    public function postCreateTechnology(Request $request)
    {
        $validatedData = $request->validate([
            'water_need_qty' => 'required|array',
            'water_need_qty.*' => 'required',
        ]);

        $draft = $request->session()->get('draft');
        $draft->fill($validatedData);
        $draft->is_water = $request->input('is_water');
        $draft->water_need_qty = $request->input('water_need_qty');
        $draft->purpose = $request->input('purpose');
        $draft->budget = $request->input('budget');
        $draft->start_date = $request->input('start_date');
        $draft->start_service_duration = $request->input('start_service_duration');
        $draft->end_service_duration = $request->input('end_service_duration');
        $draft->other = $request->input('other');
        $draft->reservoir = $request->input('reservoir');
        $draft->reservoir_latitude = $request->input('reservoir_latitude');
        $draft->reservoir_longitude = $request->input('reservoir_longitude');
        $draft->distance = $request->input('distance');
        $draft->latitude = $request->input('latitude');
        $draft->longitude = $request->input('longitude');
        $draft->pipe_size_need = $request->input('pipe_size_need');
        $draft->pipe_select = $request->input('pipe_select');
        $draft->pipe_size = $request->input('pipe_size');
        $draft->pipe_price = $request->input('pipe_price');
        $draft->pipe_cost = $request->input('pipe_cost');
        $draft->labor_cost = $request->input('labor_cost');
        $draft->fast_flow = $request->input('fast_flow');
        $draft->pipe_setup_price = $request->input('pipe_setup_price');
        $draft->draft_level = 3;
        $request->session()->put('draft', $draft);
        return redirect(route(Auth::user()->role . '-draft'));

    }

    public function postCreateDraft(Request $request)
    {
        $draft = $request->session()->get('draft');
        $draft_id = time();
        // dd($draft);
        foreach ($draft->technology_id as $i) {
            $drafts = new Draft;
            $drafts->draft_id = $draft_id;
            $drafts->water_need_qty = $draft->water_need_qty[$i];
            $drafts->purpose = $draft->purpose[$i];
            $drafts->budget = $draft->budget[$i];
            $drafts->start_date = $draft->start_date[$i];
            $drafts->start_service_duration = $draft->start_service_duration[$i];
            $drafts->end_service_duration = $draft->end_service_duration[$i];
            $drafts->other = $draft->other[$i];
            $drafts->latitude = $draft->latitude[$i];
            $drafts->longitude = $draft->longitude[$i];
            $drafts->pipe_size_need = $draft->pipe_size_need[$i];
            $drafts->pipe_size_select = $draft->pipe_select[$i];
            $drafts->pipe_setup_price = $draft->pipe_setup_price[$i];
            $drafts->labor_cost = $draft->pipe_cost[$i] * $draft->labor_cost[$i];
            $drafts->fast_flow = $draft->fast_flow[$i];
            $drafts->distance = $draft->distance[$i];
            $drafts->cork_water = $draft->is_water[$i];
            $drafts->technology = $i;
            $drafts->sale_name = Auth::user()->email;
            $drafts->company = ($draft->customer_type == 'customer-old') ? $draft->customer_name_old : $draft->customer_name;
            $drafts->save();
        }
        $data = Draft::where('draft_id', '=', $draft_id)->first();
        // $this->sendEmail(Auth::user(), $data);
        return redirect(route(Auth::user()->role . '-create-form', ['form' => 'home']));

    }

    public function clear(Request $request)
    {
        $request->session()->forget('draft');
        return redirect(route(Auth::user()->role . '-create-service-form', 'customer'));
    }

    public function equipment_assignment(Request $request)
    {
        $equipment_assignment = EquipmentAssignment::with(['technology', 'equipment', 'picture'])
        // ->select([
        //     'technology_id', 'picture_id',
        //     DB::raw('group_concat(equipment_id) as equipment_id'),
        //     DB::raw('group_concat(layer) as layer'),
        // ])
            ->where('technology_id', '=', $request->id)
        // ->groupBy('picture_id', 'technology_id')
            ->get();
        // dd($equipment_assignment);
        if ($request->ajax()) {
            return view('frontend.service.load', ['equipment_assignment' => $equipment_assignment])->render();
        }
        return view('frontend.service.load', compact('equipment_assignment'));
    }

    public function video(Request $request)
    {
        $videos = Video::where('id', '=', $request->id)->get();
        if ($request->ajax()) {
            return view('frontend.video.load', ['videos' => $equipment_assignment])->render();
        }
        return view('frontend.video.load', compact('videos'));
    }

    public function generate_pdf(Request $request)
    {

        $draft = $request->session()->get('draft');
        $technology = DB::table('technologies AS t')
            ->join('pictures AS p', function ($join) {
                $join->whereRaw("find_in_set(p.id, t.picture)");
            })
            ->select(
                't.id', 't.name', 't.video', 't.picture', 't.service',
                DB::raw('GROUP_CONCAT(p.name) AS picture_name')
            )
            ->groupBy('t.id', 't.name', 't.video', 't.picture', 't.service')
            ->orderBy('p.id')
            ->where('t.service', '=', (isset($draft->service)) ? $draft->service : null)
            ->get();
        $data = [
            'draft' => $draft,
            'technology' => $technology
        ];
        $pdf = PDF::loadView('frontend.draft.export', $data);
        return $pdf->download('draft.pdf');
    }

    public function export(Request $request) 
    {
        $draft = $request->session()->get('draft');
        $query = DB::table('technologies AS t')
            ->join('pictures AS p', function ($join) {
                $join->whereRaw("find_in_set(p.id, t.picture)");
            })
            ->select(
                't.id', 't.name', 't.video', 't.picture', 't.service',
                DB::raw('GROUP_CONCAT(p.name) AS picture_name')
            )
            ->groupBy('t.id', 't.name', 't.video', 't.picture', 't.service')
            ->orderBy('p.id');
        foreach ($draft->technology_id as $item) {
            $query->orWhere('t.id', '=', $item);
            if ($draft->reservoir[$item]) {
                $reservoir[$item] = Reservoir::findOrFail($draft->reservoir[$item]);
            } else {
                $reservoir[$item] = null;
            }
            $service[$item] = Service::findOrFail($draft->service);
            $equipment_assignment[$item] = EquipmentAssignment::with(['technology', 'equipment', 'picture'])
                ->where('technology_id', '=', $item)
                ->get();
        }
        $technology = $query->get();
        // return view("frontend.draft.export", compact([
        //     'draft', 'technology', 'reservoir', 'equipment_assignment', 'service'
        // ]));
        // return view("frontend.draft.export", compact(['draft', 'technology']));
        return Excel::download(new DraftsExport(
            'frontend.draft.export', [
                'draft' => $draft, 'technology' => $technology,
                'reservoir' => $reservoir, 'equipment_assignment' => $equipment_assignment, 'service' => $service
            ]
        ), time() . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function test_mail(Request $request)
    {
        $this->sendEmail(Auth::user());
        return redirect(route(Auth::user()->role . '-create-form', ['form' => 'home']));
    }

    public function sendEmail($thisUser, $thisDraft){
        Mail::to($thisUser['email'])
            ->send(new verifyUser($thisUser, $thisDraft));
    }
}
