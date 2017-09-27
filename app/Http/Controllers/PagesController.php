<?php

namespace App\Http\Controllers;

use App\Page;

class PagesController extends Controller
{
    public function __invoke($permalink)
    {
        $page = Page::wherePermalink($permalink)->firstOrFail();

        return view('pages.show', ['page' => $page]);
    }
}
