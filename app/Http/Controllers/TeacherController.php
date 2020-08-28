<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    public function welcomer()
    {
        return response()->json(['message' => 'Welcome ' . Auth::guard()->user()->name], 200);
    }

    public function allMyCourses()
    {
        try {
            $courses = DB::table('courses')->where('teacher', Auth::guard()->user()->id)->get();
            return response()->json(['courses' => $courses], 200);
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json(['error' => 'something went wrong'], 500);
        }
    }

    public function newCourse(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|between:4,100',
                'link' => 'required|url|max:100',
                'chapter' => 'required|string|max:50',
                'subject' => 'required|integer|exists:subjects,id',
                'start_time' => 'required|date:YYYY-MM-DD HH:MM:SS',
                'end_time' => 'required|date:YYYY-MM-DD HH:MM:SS|after:start_time',
                'classe' => 'required|integer|exists:classes,id'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $course = Course::create(array_merge(
                $validator->validated(),
                ['teacher' => (Auth::guard()->user()->id)]
            ));

            return response()->json([
                'message' => 'Successfully saved the course',
                'course' => $course
            ], 201);
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json([
                'error' => 'something went wrong!',
            ]);
        }
    }

    public function editCourse(Course $course, Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'sometimes|string|between:4,100',
                'link' => 'sometimes|url|max:100',
                'chapter' => 'sometimes|string|max:50',
                'subject' => 'sometimes|integer|exists:subjects,id',
                'start_time' => 'sometimes|date:YYYY-MM-DD HH:MM:SS',
                'end_time' => 'sometimes|date:YYYY-MM-DD HH:MM:SS|after:start_time',
                'classe' => 'sometimes|integer|exists:classes,id'
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $course->update($validator->validated());

            return response()->json([
                'message' => 'Updated the course Successfully',
                'course' => $course
            ], 201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'error' => 'something went wrong!',
            ]);
        }
    }

    public function deleteCourse(Course $course)
    {
        try {
            $course->delete();
            return response()->json([
                'message' => 'deleted the course Successfully',
            ], 201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'error' => 'something went wrong!',
            ]);
        }
    }
}
