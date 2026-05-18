<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Text;
use App\Http\Resources\TextResource;

class TextController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Text::with('page');

        if (request()->has('page_id')) {
            $query->where('page_id', request('page_id'));
        } elseif (request()->has('page')) {
            $query->whereHas('page', fn ($q) => $q->where('name', request('page')));
        }

        return TextResource::collection($query->get());
    }

    public function show($key)
    {
        $text = Text::with('page')->where('key', $key)->firstOrFail();
        return new TextResource($text);
    }
}
