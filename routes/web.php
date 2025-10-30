<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public Routes
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/universal-documentation', function () {
    return view('universal-docs');
})->name('universal-docs');

// Authentication Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    // Handle login logic here
    return redirect()->route('sites.select');
})->name('login.submit');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function () {
    // Handle registration logic here
    return redirect()->route('sites.select');
})->name('register.submit');

Route::get('/password/reset', function () {
    return view('auth.passwords.email');
})->name('password.request');

Route::get('/logout', function () {
    // Handle logout logic here
    return redirect()->route('home');
})->name('logout');

// Protected Routes (Site Selection and Dashboard)
Route::get('/sites', function () {
    return view('sites.select');
})->name('sites.select');

Route::get('/dashboard/{site?}', function ($site = 1) {
    return view('dashboard', compact('site'));
})->name('dashboard');

// Service Routes
Route::get('/service/{id}', function ($id) {
    return view('service-detail', compact('id'));
})->name('service.detail');

// Invoice Routes
Route::get('/invoices', function () {
    return view('invoices');
})->name('invoices');

// Quote Routes
Route::get('/quote/request', function () {
    return view('request-quote');
})->name('quote.request');

Route::post('/quote/submit', function () {
    // Handle quote submission
    // Email to commercial@tomspestcontrol.com.au
    return redirect()->route('dashboard')->with('success', 'Quote request submitted successfully!');
})->name('quote.submit');

// Site Documentation Routes
Route::get('/site-documentation', function () {
    return view('site-documentation');
})->name('site.documentation');

// Contact Routes
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
