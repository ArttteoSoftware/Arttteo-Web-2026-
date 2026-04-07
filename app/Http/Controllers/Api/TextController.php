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
        return TextResource::collection(Text::all());
    }

    /**
     * Display the specified resource.
     */
    public function show($key)
    {
        $text = Text::where('key', $key)->firstOrFail();
        return new TextResource($text);
    }
}
