<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Landing;
use App\Http\Resources\LandingResource;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $landings = Landing::where('status', true)->orderBy('ordering')->get();
        return LandingResource::collection($landings);
    }
}
