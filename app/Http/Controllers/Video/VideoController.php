<?php

namespace App\Http\Controllers\Video;

use App\Http\Controllers\Controller;
use App\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
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
            $video = Video::where('video_name', 'LIKE', "%$keyword%")
                ->orWhere('video_file', 'LIKE', "%$keyword%")
                ->orWhere('video_url', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $video = Video::latest()->paginate($perPage);
        }

        return view('backend.video.index', compact('video'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.video.create');
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
        $video = new video();

        if ($request->hasFile('video_file')) {
            $this->validate($request, [
                'video_file' => 'required|mimes:mp4,mov,ogg,flv,mov,avi,wmv|max:20000',
            ]);
            $video_file = $request->file('video_file');
	    $name = date('Ymd') . '-' . time() . '.' . $video_file->getClientOriginalExtension();
	    $video_file->storeAs("public/uploads/video/file/", $name);
            $video->video_file = $name;
        }

        $video->video_name = $request->get('video_name');
        $video->video_type = $request->get('video_type');
        $video->video_url = $request->get('video_url');

        $video->save();
        return redirect('/admin/video');
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
        $video = Video::findOrFail($id);

        return view('backend.video.show', compact('video'));
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
        $video = Video::findOrFail($id);

        return view('backend.video.edit', compact('video'));
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

        $video = Video::findOrFail($id);
        $video->update($requestData);

        return redirect('admin/video')->with('flash_message', 'Video updated!');
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
        Video::destroy($id);

        return redirect('admin/video')->with('flash_message', 'Video deleted!');
    }
}
