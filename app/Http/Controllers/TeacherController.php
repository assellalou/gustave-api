<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function teacher()
    {
        return response()->json(['message' => 'hey teacher'], 200);
    }
}
