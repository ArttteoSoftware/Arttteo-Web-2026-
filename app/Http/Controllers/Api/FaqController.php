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
        $query = Faq::where('status', true);

        if (request()->has('page')) {
            $query->where('page', request('page'));
        }

        $faqs = $query->orderBy('ordering')->get();
        return FaqResource::collection($faqs);
    }
}
