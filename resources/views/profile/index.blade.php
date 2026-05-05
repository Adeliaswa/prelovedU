@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-3xl">
    <h1 class="text-2xl font-bold mb-6">Profil Saya</h1>

    @if (session('success'))
        <div class="mb-4 rounded bg-green-100 px-4 py-3 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow p-6">
        <div class="mb-6">
            <p class="text-sm text-gray-500">Nama</p>
            <p class="text-lg font-semibold">{{ $user->name }}</p>
        </div>

        <div class="mb-6">
            <p class="text-sm text-gray-500">Email</p>
            <p class="text-lg font-semibold">{{ $user->email }}</p>
        </div>

        <hr class="my-6">

        <h2 class="text-xl font-semibold mb-4">Edit Profil</h2>

        <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium mb-1">Nama</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    class="w-full rounded border px-3 py-2"
                    required
                >
                @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium mb-1">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    class="w-full rounded border px-3 py-2"
                    required
                >
                @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <hr class="my-6">

<h2 class="text-xl font-semibold mb-4">Ubah Password</h2>

<div>
    <label for="current_password" class="block text-sm font-medium mb-1">Password Lama</label>
    <input
        type="password"
        id="current_password"
        name="current_password"
        class="w-full rounded border px-3 py-2"
    >
    @error('current_password')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="new_password" class="block text-sm font-medium mb-1">Password Baru</label>
    <input
        type="password"
        id="new_password"
        name="new_password"
        class="w-full rounded border px-3 py-2"
    >
    @error('new_password')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="new_password_confirmation" class="block text-sm font-medium mb-1">Konfirmasi Password Baru</label>
    <input
        type="password"
        id="new_password_confirmation"
        name="new_password_confirmation"
        class="w-full rounded border px-3 py-2"
    >
</div>
            <button
                type="submit"
                class="rounded bg-black px-4 py-2 text-white hover:bg-gray-800"
            >
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection