@extends('layouts.app') {{-- Assuming you have a default layout --}}
@section('content')

<div class="container mt-5">
    <h2>Step 1: Account Information</h2>

    <form action="{{ url('/register/step1') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" name="username" required minlength="5">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" required minlength="8">
            {{-- Password strength meter here --}}
        </div>

        <div class="form-group">
            <label for="photo">Profile Photo (Max 2MB):</label>
            <input type="file" class="form-control-file" name="photo" accept=".jpg, .png">
        </div>

        <button type="submit" class="btn btn-primary">Next</button>
    </form>
</div>

@endsection
