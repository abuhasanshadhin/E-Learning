<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Course;

class CategoriesController extends Controller
{
    public function index($id, $title)
    {
        return view('website.category-courses.category-courses', [
            'courses' => Course::where('category_id', $id)
                                ->where('is_approved', 1)
                                ->paginate(8),
            'course_name' => ucfirst( str_replace('-', ' ', $title))
        ]);
    }
}
