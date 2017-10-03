<?php

namespace App\Http\Controllers;

use App\Video;

class VideosController extends Controller
{
    public function index()
    {
        $videos = Video::all();

        return $videos;
    }

    public function show(Video $video)
    {
        return view('videos.show', ['video' => $video]);
    }
}
