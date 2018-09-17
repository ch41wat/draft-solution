<?php

namespace App\Http\Controllers;

use App\Customer;
use App\EquipmentAssignment;
use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            ], /*[
        'link' => 'success',
        'name' => 'บันทึก ' . config('app.name'),
        ],*/
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
        // dd($array);
        foreach ($draft->technology_id as $item) {
            $query->orWhere('t.id', '=', $item);
        }
        $technology = $query->get();
        return view("frontend.technology.create", compact(['step_form', 'draft', 'technology']));
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
        return redirect('/create/service');

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
        $draft->water_need_qty = $request->input('water_need_qty');
        $draft->purpose = $request->input('purpose');
        $draft->budget = $request->input('budget');
        $draft->start_date = $request->input('start_date');
        $draft->start_service_duration = $request->input('start_service_duration');
        $draft->end_service_duration = $request->input('end_service_duration');
        $draft->other = $request->input('other');
        $draft->latitude = $request->input('latitude');
        $draft->longitude = $request->input('longitude');
        $draft->water_qty = $request->input('water_qty');
        $draft->pipe_size = $request->input('pipe_size');
        $draft->pipe_setup_price = $request->input('pipe_setup_price');
        $draft->draft_level = 3;
        $request->session()->put('draft', $draft);
        return redirect(route(Auth::user()->role . '-create-form', ['form' => 'draft']));

    }

    public function clear(Request $request)
    {
        $request->session()->forget('draft');
        return redirect('/create/customer');
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
}
