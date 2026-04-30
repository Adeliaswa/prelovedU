@extends('layouts.app')

@section('content')
<h1>Login Customer</h1>

<form action="{{ route('login.store') }}" method="POST">
    @csrf

    <div>
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}">
        @error('email') <p style="color:red;">{{ $message }}</p> @enderror
    </div>

    <div>
        <label>Password</label>
        <input type="password" name="password">
        @error('password') <p style="color:red;">{{ $message }}</p> @enderror
    </div>

    <button type="submit">Login</button>
</form>
@endsection