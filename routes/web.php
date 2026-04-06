<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome', [
    'greeting' => 'Hello, World!',
    'name' => 'John Doe',
    'age' => 30,
    'tasks' => [
        'Learn Laravel',
        'Build a project',
        'Deploy to production',
    ],
]);

Route::view('/about', 'about');
Route::view('/contact', 'contact');
Route::view('/services', 'services');
Route::view('/showcases', 'showcases');
Route::view('/blog', 'blog');

Route::get('/formtest', function(){
    $emails = session()->get('emails', []);
    return view('formtest', [
        'emails' => $emails,
    ]);
});

Route::post('/formtest', function(){
    // Task 2: Validation
    request()->validate([
        'email' => 'required|email',
    ]);

    $emails = session()->get('emails', []);

    // Task 6: Limit to 5
    if(count($emails) >= 5){
        return back()->with('warning', 'Maximum of 5 emails reached.');
    }

    // Task 3: Prevent duplicates
    if(in_array(request('email'), $emails)){
        return back()->with('warning', 'Email already exists.');
    }

    session()->push('emails', request('email'));

    // Task 5: Success message
    return back()->with('success', 'Email added successfully!');
});

// Task 4: Delete individual email
Route::post('/delete-email', function(){
    $emails = session()->get('emails', []);
    $emails = array_filter($emails, fn($e) => $e !== request('email'));
    session()->put('emails', array_values($emails));
    return back()->with('success', 'Email deleted.');
});

// Delete all (optional, keep if you want)
Route::get('/delete-emails', function(){
    session()->forget('emails');
    return redirect('/formtest');
});