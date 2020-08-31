<?php

namespace App\Http\Controllers;

use App\Classe;
use App\Course;
use App\Subject;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function addUser(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|between:4,100',
                'email' => 'required|email|unique:users|max:50',
                'phone' => 'sometimes|digits:10',
                'username' => 'required|string|unique:users|between:4,50',
                'password' => 'required|confirmed|string|min:6',
                'adresse' => 'sometimes|string|max:100',
                'city' => 'sometimes|string|max:25',
                'classe' => 'sometimes|integer|exists:classes,id',
                'is_admin' => 'required|integer|max:1',
                'is_teacher' => 'required|integer|max:1'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $user = User::create(array_merge(
                $validator->validated(),
                ['password' => bcrypt($request->password)],
            ));

            return response()->json([
                'message' => 'Registred Successfully',
                'user' => $user
            ], 201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function addClasse(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nomination' => 'required|string|between:4,50',
                'level' => 'required|string|max:50'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $classe = Classe::create($validator->validated());

            return response()->json([
                'message' => 'Saved Successfully',
                'classe' => $classe
            ], 201);
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function addSubject(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|between:3,50',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $subject = Subject::create($validator->validated());

            return response()->json([
                'message' => 'Saved Successfully',
                'subject' => $subject
            ], 201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
}
