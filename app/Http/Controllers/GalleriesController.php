<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;

class GalleriesController extends Controller
{
    public function store(Request $request)
    {
        $gallery = Gallery::create($request->only('name'));
        $project = new Project();
        $project->addZone($gallery);
    }
}
