<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Lesson;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Course;
use App\Like;
use App\LessonViews;

class LessonsController extends Controller
{
    public function index($id, $title)
    {
        $this->lesson_view_add($id);

        $single_lesson = Lesson::find($id);
        $course_id = $single_lesson->section->course->category->id;

        $is_liked = Like::where('user_id', Auth::id())->where('lesson_id', $id)->first();

        $previous = Lesson::where('id', '<', $single_lesson->id)
                            ->where('section_id', $single_lesson->section->id)
                            ->max('id');
        $previous_lesson = Lesson::find($previous);

        $next = Lesson::where('id', '>', $single_lesson->id)
                        ->where('section_id', $single_lesson->section->id)
                        ->min('id');
        $next_lesson = Lesson::find($next);

        return view('website.lesson.lesson', [
            'single_lesson' => $single_lesson,
            'course' => $single_lesson->course,
            'section_id' => $single_lesson->section->id,
            'user' => User::find(Auth::id()),
            'related_course' => Course::where('category_id', $course_id)->get(),
            'is_liked' => $is_liked,
            'total_likes' => Like::where('lesson_id', $id)->count(),
            'likers' => $this->likers_count($id),
            'previous' => $previous_lesson,
            'next' => $next_lesson,
        ]);
    }

    private function lesson_view_add($id)
    {
        $view_check = LessonViews::where('lesson_id', $id)
                                ->where('ip_address', request()->ip())
                                ->first();

        if (!$view_check) {
            LessonViews::create([
                'lesson_id' => $id,
                'ip_address' => request()->ip()
            ]);
        }
    }

    private function likers_count($id)
    {
        $likers = '';
        $likes  = Like::where('lesson_id', $id)->latest()->get();
        foreach ($likes as $like) {
            $likers .= $like->user->name . '<br>';
        }
    }

    public function addLike($id)
    {
        $like_check = Like::where('user_id', Auth::id())
                            ->where('lesson_id', $id)->first();
        if ($like_check) {
            Like::where('lesson_id', $id)
                ->where('user_id', Auth::id())
                ->delete();
        } else {
            Like::create([
                'user_id' => Auth::id(),
                'lesson_id' => $id
            ]);
        }

        return redirect()->back();
    }
}
