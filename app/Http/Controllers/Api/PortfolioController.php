<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Http\Resources\PortfolioResource;
use App\Http\Resources\PortfolioIndexResource;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $portfolios = Portfolio::with('category')
            ->when($request->category_id, fn ($query, $categoryId) => $query->where('category_id', $categoryId))
            ->latest()
            ->get();

        return PortfolioIndexResource::collection($portfolios);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $portfolio = Portfolio::with(['category', 'images', 'engagements'])->findOrFail($id);
        return new PortfolioResource($portfolio);
    }
}
