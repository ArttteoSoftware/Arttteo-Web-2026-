<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Http\Resources\PageResource;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::where('status', true)->orderBy('ordering')->get();
        return PageResource::collection($pages);
    }
}
