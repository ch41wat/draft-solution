<?php

namespace App\Http\Controllers\Technology;

use App\Equipment;
use App\Http\Controllers\Controller;
use App\Picture;
use App\Service;
use App\Technology;
use App\Video;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $technology = Technology::where('name', 'LIKE', "%$keyword%")
                ->orWhere('picture', 'LIKE', "%$keyword%")
                ->orWhere('video', 'LIKE', "%$keyword%")
                ->orWhere('equipment', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $technology = Technology::latest()->paginate($perPage);
        }

        return view('backend.technology.index', compact('technology'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $service = Service::all();
        $picture = Picture::where('path', 'LIKE', 'technology')->get();
        $equipment = Equipment::all();
        $video = Video::all();
        return view('backend.technology.create', compact('service', 'video', 'picture', 'equipment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'picture' => 'required',
            'video' => 'required|array',
            'video.*' => 'required',
            'service' => 'required',
            'price' => 'required',
        ]);

        $technology = new technology();
        // dd($request->input('video'));

        if (count($request->input('video')) > 0) {
            $technology->video = implode(",", $request->input('video'));
        }

        $technology->picture = $request->input('picture');
        $technology->name = $request->get('name');
        $technology->service = $request->get('service');
        $technology->price = $request->get('price');

        $technology->save();
        return redirect('/admin/technology');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $technology = Technology::findOrFail($id);

        return view('backend.technology.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $service = Service::all();
        $video = Video::all();
        $picture = Picture::all();
        $equipment = Equipment::all();
        $technology = Technology::findOrFail($id);

        return view('backend.technology.edit', compact('technology', 'service', 'video', 'equipment', 'picture'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        $technology = Technology::findOrFail($id);
        $technology->update($requestData);

        if (count($request->input('video')) > 0) {
            $technology->video = implode(",", $request->input('video'));
        }
        else if (count($request->input('picture')) > 0) {
            $technology->picture = implode(",", $request->input('picture'));
        }


        return redirect('admin/technology')->with('flash_message', 'Technology updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Technology::destroy($id);

        return redirect('admin/technology')->with('flash_message', 'Technology deleted!');
    }

    public function dataAjaxTechnology(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = Technology::where($request->column, '=', "$search")->get();
            foreach ($data as $key => $value) {
                $picture_array = [];
                $picture_id = explode(",", $value->picture);
                foreach ($picture_id as $pic) {
                    $picture_data = Picture::where('id', '=', $pic)->first();
                    $picture_array[] = '/' . $picture_data->path . '/picture/' . $picture_data->name;
                }
                $data[$key]->picture_id = implode(",", $picture_id);
                $data[$key]->picture_name = implode(",", $picture_array);
            }
        } else {
            $data = Technology::latest()->paginate(1);
        }

        return response()->json($data);
    }

}
