<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Category;
use App\Models\Teacher; // Add this import statement
use Illuminate\Support\Facades\Mail;


class RegistrationController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        $categories = Category::all();
        return view('register', compact('locations', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => "required|string|max:250",
            'firstname' => "required|string|max:250",
            'email' => 'required|email|max:250|unique:users',
            'description' => "required|string|max:250",
            'remarks' => 'nullable|string|max:250',
            'phone' => "required",
            'website' => 'nullable|string',
            'location' => 'required|integer',
            'category' => 'required|integer',
            'streetnr' => "required|string",
            'codecity' => "required|string",
        ]);
       

        Teacher::create([
            'lastname' => $request->name,
            'firstname' => $request->firstname,
            'email' => $request->email,
            'description' => $request->description,
            'remarks' => $request->remarks,
            'phone' => $request->phone,
            'website' => $request->website,
            'approved' => 0, // Set 'approved' field to 0 by default
            'location_id' => $request->location,
            'category_id' => $request->category,
            'streetnr' => $request->streetnr,
            'codecity' => $request->codecity,
        ]);


        
        Mail::send('mail.contact', $request->all(), function($message){
            $message->to(request('email'))
            ->subject('Bedankt voor uw registratie, '. request('firstname').'.');
        });

        return redirect('/main')->with('success', 'Registration successful. Welcome!');

    }
}
