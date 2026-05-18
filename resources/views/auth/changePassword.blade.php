@extends('layouts.app1')

@section('pagetitle')
    {{ $pagetitle ?? '' }}
@endsection

@section('css')
@endsection
@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">

    <h2 class="text-2xl font-bold mb-6">Change Password</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700  rounded mb-1" style="color:green">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 text-red-700  rounded mb-1" style="color:red">
            <ul class="list-disc ml-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <!-- Current Password -->
        <div class="mb-4">
            <label class="block mb-1 font-medium">Current Password</label>
            <input type="password"
                   name="current_password"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                   required>
        </div>

        <!-- New Password -->
        <div class="mb-4">
            <label class="block mb-1 font-medium">New Password</label>
            <input type="password"
                   name="new_password"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                   required>
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label class="block mb-1 font-medium">Confirm New Password</label>
            <input type="password"
                   name="new_password_confirmation"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                   required>
        </div>

        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Update Password
        </button>

    </form>

</div>

@endsection




