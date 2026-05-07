<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Http\Resources\PortfolioResource;
use App\Http\Resources\PortfolioIndexResource;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portfolios = Portfolio::with('category')->latest()->get();
        return PortfolioIndexResource::collection($portfolios);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $portfolio = Portfolio::with(['images', 'engagements'])->findOrFail($id);
        return new PortfolioResource($portfolio);
    }
}
