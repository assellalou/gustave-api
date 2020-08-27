<?php

namespace App\Http\Controllers;

use App\Classe;
use App\Course;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function student()
    {
        $courses = DB::table('courses')->where('classe_id', '=', Auth::guard()->user()->classe)->get();
        return response()->json(['message' => 'hey student', 'data' => $courses], 200);
    }
    public function courses()
    {
        $courses = DB::table('courses')->where(['classe_id', '=', Auth::guard()->user()->classe, 'end_time', '<=', time()])->get();
        return response()->json(['courses' => $courses], 200);
    }
}
