@extends('layouts.app')

@section('content')
<h1>Register Customer</h1>

<form action="{{ route('register.store') }}" method="POST">
    @csrf

    <div>
        <label>Nama</label>
        <input type="text" name="name" value="{{ old('name') }}">
        @error('name') <p style="color:red;">{{ $message }}</p> @enderror
    </div>

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

    <div>
        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation">
    </div>

    <button type="submit">Register</button>
</form>
@endsection