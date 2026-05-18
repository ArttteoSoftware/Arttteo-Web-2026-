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
        $query = Faq::with('page')->where('status', true);

        if (request()->has('page')) {
            $query->whereHas('page', fn ($q) => $q->where('name', request('page')));
        } elseif (request()->has('page_id')) {
            $query->where('page_id', request('page_id'));
        }

        $faqs = $query->orderBy('ordering')->get();
        return FaqResource::collection($faqs);
    }
}
