<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Support\Facades\Auth;
use App\Course;
use Brian2694\Toastr\Facades\Toastr;

class CoursesController extends Controller
{
    public function addCourseForm()
    {
        return view('instructor.course.add', [
            'categories' => Category::all()
        ]);
    }

    public function saveCourseInfo(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png|max:2048'
        ]);

        $courseInfo = $request->all();
        $uploadedImagePath = imageUpload($request, 'image', 'uploads', 500, 265);
        $courseInfo['image'] = $uploadedImagePath;
        $courseInfo['instructor_id'] = Auth::id();
        Course::create($courseInfo);

        Toastr::success('Course Saved Successfully', 'Save');
        return redirect()->route('instructor.all-course');
    }

    public function allCourse()
    {
        return view('instructor.course.courses', [
            'courses' => Course::where('instructor_id', Auth::id())
                                ->latest()->get()
        ]);
    }

    public function editCourse($id)
    {
        return view('instructor.course.edit', [
            'course' => Course::find($id),
            'categories' => Category::all()
        ]);
    }

    public function updateCourse(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'image' => 'mimes:jpg,jpeg,png|max:2048'
        ]);

        $course = Course::find($request->id);
        $form_data = $request->all();
        if (isset($request->image)) {
            if (file_exists($course->image)) {
                unlink($course->image);
            }
            $uploadedImagePath = imageUpload($request, 'image', 'uploads', 500, 265);
            $form_data['image'] = $uploadedImagePath;
        }
        $course->update($form_data);

        Toastr::info('Course Updated Successfully', 'Update');
        return redirect()->route('instructor.all-course');
    }

    public function deleteCourse(Request $request)
    {
        $course = Course::find($request->id);
        if (file_exists($course->image)) {
            unlink($course->image);
        }
        $course->delete();

        Toastr::success('Course Deleted Successfully', 'Delete');
        return redirect()->route('instructor.all-course');
    }

}
