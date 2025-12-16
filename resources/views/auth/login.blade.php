@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow">

        <h1 class="text-2xl font-bold text-center mb-6">
            Login
        </h1>

        @if ($errors->any())
            <div class="mb-4 text-sm text-red-600">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ url('/login') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">
                    Email
                </label>
                <input
                    type="email"
                    name="email"
                    required
                    class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-400"
                >
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium mb-1">
                    Password
                </label>
                <input
                    type="password"
                    name="password"
                    required
                    class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-400"
                >
            </div>

            <button
                type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition"
            >
                Login
            </button>
            <div>
                
            </div>
        </form>

    </div>
</div>
@endsection
