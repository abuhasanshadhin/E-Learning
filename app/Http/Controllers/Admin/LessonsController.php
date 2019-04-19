<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Course;
use App\Lesson;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class LessonsController extends Controller
{
    public function addLessonForm()
    {
        return view('admin.lesson.add', [
            'courses' => Course::where('is_approved', 1)
                                ->where('instructor_id', Auth::id())
                                ->get()
        ]);
    }

    public function saveLessonInfo(Request $request)
    {
        $this->validateLessonData($request);

        $lessonData = $request->all();
        $lessonData['instructor_id'] = Auth::id();
        $newLesson = Lesson::create($lessonData);

        $newsletter_emails = NewsLetter::all();

        foreach ($newsletter_emails as $email) {
            Mail::to($email->email)->send(new NewsLetterMail($newLesson));
        }

        Toastr::success('Lesson Saved Successfully', 'Save');
        return redirect()->route('admin.all-lesson');
    }

    public function allLesson()
    {
        return view('admin.lesson.lessons', [
            'lessons' => Lesson::all()
        ]);
    }

    public function deleteLesson(Request $request)
    {
        Lesson::find($request->id)->delete();

        Toastr::success('Lesson Deleted Successfully', 'Delete');
        return redirect()->route('admin.all-lesson');
    }

    public function editLesson($id)
    {
        return view('admin.lesson.edit', [
            'lesson' => Lesson::find($id),
            'courses' => Course::where('is_approved', 1)->get()
        ]);
    }

    public function updateLesson(Request $request)
    {
        $this->validateLessonData($request);
        
        Lesson::find($request->id)->update($request->all());

        Toastr::info('Lesson Updated Successfully', 'Update');
        return redirect()->route('admin.all-lesson');
    }

    public function validateLessonData($request)
    {
        $request->validate([
            'course_id' => 'required',
            'section_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'video_url' => 'required',
        ]);
    }

}
