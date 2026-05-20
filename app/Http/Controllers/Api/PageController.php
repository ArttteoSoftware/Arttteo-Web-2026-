<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Http\Resources\PageResource;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::with(['sections.contents.items', 'faqs'])->where('status', true)->orderBy('ordering')->get();
        return PageResource::collection($pages);
    }

    public function show(string $name)
    {
        $page = Page::with(['sections.contents.items', 'faqs'])
            ->where('status', true)
            ->where('name', $name)
            ->firstOrFail();

        return new PageResource($page);
    }
}
