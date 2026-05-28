<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuoteRequest;
use App\Mail\QuoteRequestMail;
use Illuminate\Support\Facades\Mail;

class QuoteController extends Controller
{
    public function send(QuoteRequest $request)
    {
        $data = $request->validated();

        Mail::to('Quotes@arttteo.com')->send(new QuoteRequestMail($data));

        return response()->json(['message' => 'Quote request sent successfully.']);
    }
}
