<?php

namespace App\Http\Controllers\EquipmentAssignment;

use App\EquipmentAssignment;
use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Http\Request;

class EquipmentAssignmentController extends Controller
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
            $equipment_assignment = EquipmentAssignment::where('technology_id', 'LIKE', "%$keyword%")
                ->orWhere('equipment_id', 'LIKE', "%$keyword%")
                ->orWhere('picture_id', 'LIKE', "%$keyword%")
                ->orWhere('layer', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $equipment_assignment = EquipmentAssignment::latest()->paginate($perPage);
        }

        return view('backend.equipment-assignment.index', compact('equipment_assignment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $services = Service::all();
        return view('backend.equipment-assignment.create', compact('services'));
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
            'technology_id' => 'required',
            'picture_id' => 'required|array',
            'picture_id.*' => 'required',
        ]);

        $layer = 1;
        foreach ($request->get('picture_id') as $picture) {
            for ($i = 1; $i <= 18; $i++) {
                if (!empty($request->get('layer_' . $picture . '_' . $i))) {
                    $equipment_assignment = new EquipmentAssignment();
                    $equipment_assignment->technology_id = $request->get('technology_id');
                    $equipment_assignment->equipment_id = $request->get('layer_' . $picture . '_' . $i);
                    $equipment_assignment->picture_id = $picture;
                    $equipment_assignment->layer = $i;
                    $equipment_assignment->save();
                }
            }
        }

        // $technology->save();

        return redirect('admin/equipment-assignment')->with('flash_message', 'Equipment Assignment added!');
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
        $equipment_assignment = EquipmentAssignment::findOrFail($id);

        return view('backend.equipment-assignment.show', compact('equipment-assignment'));
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
        $equipment_assignment = EquipmentAssignment::findOrFail($id);

        return view('backend.equipment-assignment.edit', compact('equipment-assignment'));
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

        $equipment_assignment = EquipmentAssignment::findOrFail($id);
        $equipment_assignment->update($requestData);

        return redirect('admin/equipment-assignment')->with('flash_message', 'equipment-assignment updated!');
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
        equipment - assignment::destroy($id);

        return redirect('admin/equipment-assignment')->with('flash_message', 'equipment-assignment deleted!');
    }
}
