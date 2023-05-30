<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Category;

class MainController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();
        return view('main', compact('teachers'));
    }
}
