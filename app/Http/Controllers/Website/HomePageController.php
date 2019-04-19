<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Course;
use App\Rating;
use Illuminate\Support\Facades\Auth;

class HomePageController extends Controller
{
    public function index()
    {
        return view('website.home.home', [
            'courses' => Course::where('is_approved', 1)->paginate(8)
        ]);
    }
}
