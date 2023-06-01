<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Category;
use App\Models\Page;
use Illuminate\Support\Facades\View;

class MainController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        $teachers = Teacher::where('approved', 1)->paginate(15); // Paginate the teachers with 15 records per page
        return view('main', compact('teachers', 'pages'));
    }
    
    public function filterTeachers(Request $request)
    {
        $search = $request->input('search');
        $page = $request->input('page');
    
        $teachers = Teacher::where('approved', 1)
            ->where(function ($query) use ($search) {
                $query->where('lastname', 'like', '%' . $search . '%')
                    ->orWhere('firstname', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            })
            ->paginate(15, ['*'], 'page', $page); // Pass the current page number to paginate
    
        // Return the filtered teachers as a partial view
        return View::make('partials.teacher-list', compact('teachers'))->render();
    }
    
}
