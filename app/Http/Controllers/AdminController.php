<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin()
    {
        return response()->json(['message' => 'hey admin'], 200);
    }
}
