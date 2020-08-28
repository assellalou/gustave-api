<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function courses()
    {
        try {
            $courses = DB::table('courses')->where([['classe_id', Auth::guard()->user()->classe], ['end_time', '>=', Carbon::today()->toDateString()]])->get();
            return response()->json(['courses' => $courses], 200);
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json(['error' => 'something went wrong!'], 500);
        }
    }
}
