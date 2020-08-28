<?php

namespace App\Http\Controllers;



class AdminController extends Controller
{
    public function admin()
    {
        return response()->json(['message' => 'hey admin'], 200);
    }
}
