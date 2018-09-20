<?php

namespace App\Http\Controllers\Pipe;

use App\Pipe;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PipeController extends Controller
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
            $pipe = Pipe::where('name', 'LIKE', "%$keyword%")
                ->orWhere('size', 'LIKE', "%$keyword%")
                ->orWhere('price', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $pipe = Pipe::latest()->paginate($perPage);
        }

        return view('backend.pipe.index', compact('pipe'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.pipe.create');
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
            'size' => 'required',
            'price' => 'required',
        ]);

        $requestData = $request->all();

        Pipe::create($requestData);

        return redirect('admin/pipe')->with('flash_message', 'Pipe added!');
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
        $pipe = Pipe::findOrFail($id);

        return view('backend.pipe.show', compact('pipe'));
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
        $pipe = Pipe::findOrFail($id);

        return view('backend.pipe.edit', compact('pipe'));
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

        $pipe = Pipe::findOrFail($id);
        $pipe->update($requestData);

        return redirect('admin/pipe')->with('flash_message', 'Pipe updated!');
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
        Pipe::destroy($id);

        return redirect('admin/pipe')->with('flash_message', 'Pipe deleted!');
    }

    public function dataAjaxReservoir(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = Reservoir::where('name', 'LIKE', "%$search%")->get();
        }

        return response()->json($data);
    }
}
