<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\NewsLetter;

class NewsLettersController extends Controller
{
    public function newsLetterSubscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        NewsLetter::create($request->all());

        return redirect()->back();
    }
}
