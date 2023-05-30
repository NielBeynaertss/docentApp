<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Category;
use App\Models\Page;

class MainController extends Controller
{
    public function index()
    {
        $pages = Page::all(); // Fetch all pages from the database
        $teachers = Teacher::where('approved', 1)->paginate(12); // Limit to approved teachers and paginate with 10 records per page
        return view('main', compact('teachers', 'pages'));
    }

}
