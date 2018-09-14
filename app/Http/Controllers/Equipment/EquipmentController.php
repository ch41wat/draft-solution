<?php

namespace App\Http\Controllers\Equipment;

use App\Equipment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EquipmentController extends Controller
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
            $equipment = Equipment::where('name', 'LIKE', "%$keyword%")
                ->orWhere('detail', 'LIKE', "%$keyword%")
                ->orWhere('picture', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $equipment = Equipment::latest()->paginate($perPage);
        }

        return view('backend.equipment.index', compact('equipment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.equipment.create');
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
            'detail' => 'required',
            'picture' => 'required',
        ]);

        $requestData = $request->all();

        Equipment::create($requestData);

        return redirect('admin/equipment')->with('flash_message', 'Equipment added!');
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
        $equipment = Equipment::findOrFail($id);

        return view('backend.equipment.show', compact('equipment'));
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
        $equipment = Equipment::findOrFail($id);

        return view('backend.equipment.edit', compact('equipment'));
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

        $equipment = Equipment::findOrFail($id);
        $equipment->update($requestData);

        return redirect('admin/equipment')->with('flash_message', 'Equipment updated!');
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
        Equipment::destroy($id);

        return redirect('admin/equipment')->with('flash_message', 'Equipment deleted!');
    }
}
