<?php

namespace App\Http\Controllers;

use Facades\App\Services\GoogleAnalytics;
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
        GoogleAnalytics::trackPage();
        GoogleAnalytics::trackEvent('videos', 'viewed', $video->name);

        return view('videos.show', ['video' => $video]);
    }
}
