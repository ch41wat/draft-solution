<?php

namespace App\Http\Controllers\Reservoir;

use App\Reservoir;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReservoirController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request) {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $reservoir = Reservoir::where('name', 'LIKE', "%$keyword%")
                            ->orWhere('latitude', 'LIKE', "%$keyword%")
                            ->orWhere('longitude', 'LIKE', "%$keyword%")
                            ->latest()->paginate($perPage);
        } else {
            $reservoir = Reservoir::latest()->paginate($perPage);
        }

        return view('backend.reservoir.index', compact('reservoir'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        return view('backend.reservoir.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request) {

        $this->validate($request, [
            'name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $requestData = $request->all();

        Reservoir::create($requestData);

        return redirect('admin/reservoir')->with('flash_message', 'Reservoir added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id) {
        $reservoir = Reservoir::findOrFail($id);

        return view('backend.reservoir.show', compact('reservoir'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id) {
        $reservoir = Reservoir::findOrFail($id);

        return view('backend.reservoir.edit', compact('reservoir'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id) {

        $requestData = $request->all();

        $reservoir = Reservoir::findOrFail($id);
        $reservoir->update($requestData);

        return redirect('admin/reservoir')->with('flash_message', 'Reservoir updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id) {
        Reservoir::destroy($id);

        return redirect('admin/reservoir')->with('flash_message', 'Reservoir deleted!');
    }

    public function dataAjaxReservoir(Request $request) {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = Reservoir::where('name', 'LIKE', "%$search%")->get();
        }

        return response()->json($data);
    }

}
