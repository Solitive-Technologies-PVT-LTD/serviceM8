@extends('layouts.app')

@section('title', 'Sign Up - Tom\'s Pest Control')

@section('header-action')
@endsection

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Create Account</h2>
            <p class="text-gray-600">Welcome to Tom's Pest Control client portal</p>
        </div>

        <form method="POST" action="{{ route('register.submit') }}">
            @csrf
            
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                <input type="text" id="name" name="name" required 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-toms-green focus:border-transparent"
                    placeholder="John Doe">
            </div>

            <div class="mb-4">
                <label for="company" class="block text-sm font-medium text-gray-700 mb-2">Company Name</label>
                <input type="text" id="company" name="company" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-toms-green focus:border-transparent"
                    placeholder="Your Company">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" id="email" name="email" required 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-toms-green focus:border-transparent"
                    placeholder="your.email@example.com">
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                <input type="tel" id="phone" name="phone" required 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-toms-green focus:border-transparent"
                    placeholder="0400 000 000">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input type="password" id="password" name="password" required 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-toms-green focus:border-transparent"
                    placeholder="Create a password">
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-toms-green focus:border-transparent"
                    placeholder="Confirm your password">
            </div>

            <button type="submit" class="w-full bg-toms-green hover:bg-green-700 text-white font-medium py-3 rounded-lg transition">
                Sign Up
            </button>

            <div class="mt-4 text-center">
                <p class="text-sm text-gray-600">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-toms-green font-medium hover:underline">Log in here</a>
                </p>
            </div>
        </form>
    </div>

    <div class="mt-6 text-center">
        <a href="{{ route('home') }}" class="text-gray-600 hover:text-toms-green">← Back to Home</a>
    </div>
</div>
@endsection


