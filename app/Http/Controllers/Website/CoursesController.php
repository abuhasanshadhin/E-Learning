<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Course;
use App\Rating;
use Illuminate\Support\Facades\Auth;

class CoursesController extends Controller
{
    public function index($id, $title)
    {
        return view('website.course.course', [
            'course' => Course::find($id),
        ]);
    }

    public function addRating($id, $rating)
    {
        Rating::create([
            'user_id' => Auth::id(),
            'course_id' => $id,
            'rate' => $rating
        ]);

        return redirect()->back();
    }
}
