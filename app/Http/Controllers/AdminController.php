<?php

namespace App\Http\Controllers;

use App\Classe;
use App\Course;
use App\User;
use courses_seed;

class AdminController extends Controller
{
    public function admin()
    {
        return response()->json(['message' => 'hey admin'], 200);
    }

    public function listClasses()
    {
        try {
            $classes = Classe::all();
            return response()->json(['classes' => $classes]);
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json(['error' => 'something went wrong!'], 500);
        }
    }

    public function listStudents()
    {
        try {
            $students = User::where('is_admin', false)
                ->where('is_teacher', false)
                ->get();
            return response()->json(['students' => $students]);
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json(['error' => 'something went wrong!'], 500);
        }
    }

    public function listTeachers()
    {
        try {
            $students = User::where('is_teacher', true)->get();
            return response()->json(['teachers' => $students]);
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json(['error' => 'something went wrong!'], 500);
        }
    }

    public function listCourses()
    {
        try {
            $courses = Course::all()->groupBy('classe');
            return response()->json(['courses' => $courses]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error' => 'something went wrong!'], 500);
        }
    }
}
