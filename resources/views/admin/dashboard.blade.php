@extends('layouts.app')

@section('content')
    <h2>Dashboard Admin</h2>

    <p>Selamat datang di halaman admin.</p>

    <a href="{{ route('admin.orders.index') }}">Kelola Pesanan</a>
@endsection