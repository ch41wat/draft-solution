<?php

namespace App\Http\Controllers\Technology;

use App\Http\Controllers\Controller;
use App\Service;
use App\Technology;
use App\Equipment;
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
        $equipment = Equipment::all();
        $video = Video::all();
        return view('backend.technology.create', compact('service','video','equipment'));
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
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $technology = new technology();

        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $name = str_slug($request->name) . '.' . $picture->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/technology/picture');
            $imagePath = $destinationPath . "/" . $name;
            $picture->move($destinationPath, $name);
            $technology->picture = $name;
        }

        $technology->name = $request->get('name');
        $technology->video = $request->get('video');
        $technology->equipment = $request->get('equipment');
        $technology->service = $request->get('service');

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
        $equipment = Equipment::all();
        $technology = Technology::findOrFail($id);

        return view('backend.technology.edit', compact('technology', 'service', 'video', 'equipment'));
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
            $data = Technology::where('service','video', '=', "$search")->get();
        }

        return response()->json($data);
    }

}
