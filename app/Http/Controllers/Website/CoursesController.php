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
        $ifExist = Rating::where('user_id', Auth::id())
                            ->where('course_id', $id)
                            ->first();

        if ($ifExist) {
            session()->flash('error', 'Sorry! You already given rating in this course.');
            return redirect()->back();
        } else {
            Rating::create([
                'user_id' => Auth::id(),
                'course_id' => $id,
                'rate' => $rating
            ]);

            return redirect()->back();
        }

        

        
    }
}
