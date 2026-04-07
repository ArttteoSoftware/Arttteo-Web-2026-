<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Http\Resources\FaqResource;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = Faq::where('status', true)->orderBy('ordering')->get();
        return FaqResource::collection($faqs);
    }
}
