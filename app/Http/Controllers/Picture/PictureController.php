<?php

namespace App\Http\Controllers\Picture;

use App\Http\Controllers\Controller;
use App\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $picture = Picture::where('name', 'LIKE', "%$keyword%")
                ->orWhere('path', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $picture = Picture::latest()->paginate($perPage);
        }

        return view('backend.picture.index', compact('picture'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.picture.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'path' => 'required',
            'picture' => 'required|array|max:2048',
            'picture.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // dd($request->file('picture'));
        if (count($request->file('picture')) > 0) {
            foreach ($request->file('picture') as $picture) {
                $pictures = new Picture;
                $path = $request->get('path');
                $name = date('Ymd'). '-' .time(). '-' .uniqid(). '.' .$picture->getClientOriginalExtension();
                $picture->storeAs("public/uploads/$path/picture/", $name);
                $pictures->path = $path;
                $pictures->name = $name;
                $pictures->save();
                $pictures = null;
            }
        }
        return redirect('/admin/picture');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $picture = Picture::findOrfail($id);
        $picture_path = 'public\\uploads\\' . $picture->path . '\\picture\\' . $picture->name;
        if (Storage::exists($picture_path)) {
            Storage::delete($picture_path);
        }
        Picture::destroy($id);

        return redirect('admin/picture')->with('flash_message', 'Technology Picture deleted!');
    }

    public function getPicture($type, $search)
    {
        $data = '';
        $pictures = Picture::where('name', 'LIKE', "%$search%")
            ->orWhere('path', 'LIKE', "%$search%")
            ->get();
        if ($pictures) {
            foreach ($pictures as $item) {
                $data .= '<div class="bg-folder1">
                    <div class="image">
                    <table width="100%" border="0">
                        <tr>
                            <td><img src="' . Storage::url("public/uploads/$search/picture/" . $item->name) . '" /></td>
                        </tr>
                    </table>
                </div>
                    <div class="name">
                        <input type="' . $type . '" name="select-item" value="' . $item->id . '|/' . $search . '/picture/' . $item->name . '" class="select-item">
                    </div>
                </div>';

            }
        }
        return $data;
    }
}
