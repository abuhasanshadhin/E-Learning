<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Course;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class CoursesController extends Controller
{
    public function addCourseForm()
    {
        return view('admin.course.add', [
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
        $courseInfo['is_approved'] = 1;
        Course::create($courseInfo);

        Toastr::success('Course Saved Successfully', 'Save');
        return redirect()->route('admin.all-course');
    }

    public function allCourse()
    {
        return view('admin.course.courses', [
            'courses' => Course::latest()->get()
        ]);
    }

    public function deleteCourse(Request $request)
    {
        $course = Course::find($request->id);
        if (file_exists($course->image)) {
            unlink($course->image);
        }
        $course->delete();

        Toastr::success('Course Deleted Successfully', 'Delete');
        return redirect()->route('admin.all-course');
    }

    public function editCourse($id)
    {
        return view('admin.course.edit', [
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
        return redirect()->route('admin.all-course');
    }

    public function courseApprove($id)
    {
        $course = Course::find($id);
        $course->is_approved = 1;
        $course->save();

        Toastr::info('Course Approved Successfully', 'Approve');
        return redirect()->route('admin.all-course');
    }

    public function pendingCourse()
    {
        return Course::where('is_approved', 0)->count();
    }

}
