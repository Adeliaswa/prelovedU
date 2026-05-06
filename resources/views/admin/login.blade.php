<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — prelovedU</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-pattern {
            background-color: #0f172a;
            background-image: radial-gradient(ellipse at 20% 50%, rgba(16,185,129,0.15) 0%, transparent 50%),
                              radial-gradient(ellipse at 80% 20%, rgba(16,185,129,0.08) 0%, transparent 40%);
        }
        .glass-card {
            background: rgba(255,255,255,0.04);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.08);
        }
        input:focus { outline: none; }
        .input-field {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            transition: border-color 0.2s, background 0.2s;
        }
        .input-field:focus {
            border-color: #10b981;
            background: rgba(16,185,129,0.05);
        }
        .btn-login {
            background: #10b981;
            transition: background 0.2s, transform 0.15s;
        }
        .btn-login:hover { background: #059669; transform: translateY(-1px); }
        .btn-login:active { transform: translateY(0); }
    </style>
</head>
<body class="bg-pattern min-h-screen flex items-center justify-center p-4">

<div class="w-full max-w-md">

    {{-- Logo --}}
    <div class="text-center mb-8">
        <div class="inline-flex items-center gap-3 mb-4">
            <div class="w-10 h-10 bg-emerald-500 rounded-xl flex items-center justify-center">
                <span class="text-white font-black text-lg">P</span>
            </div>
            <span class="text-white font-bold text-2xl tracking-tight">prelovedU</span>
        </div>
        <p class="text-slate-400 text-sm">Masuk ke Panel Administrator</p>
    </div>

    {{-- Card --}}
    <div class="glass-card rounded-2xl p-8">

        <h2 class="text-white font-bold text-xl mb-1">Selamat Datang</h2>
        <p class="text-slate-400 text-sm mb-6">Masukkan kredensial admin untuk melanjutkan</p>

        {{-- Error Alert --}}
        @if ($errors->any())
            <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-3 mb-5">
                @foreach ($errors->all() as $error)
                    <p class="text-red-400 text-sm font-medium flex items-center gap-2">
                        <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ $error }}
                    </p>
                @endforeach
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-3 mb-5">
                <p class="text-red-400 text-sm font-medium flex items-center gap-2">
                    <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('error') }}
                </p>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf

            {{-- Email --}}
            <div>
                <label class="block text-slate-300 text-sm font-medium mb-2">Email Admin</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                       placeholder="admin@prelovdu.com"
                       class="input-field w-full rounded-xl px-4 py-3 text-white placeholder-slate-500 text-sm @error('email') border-red-500/60 @enderror">
                @error('email')
                    <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label class="block text-slate-300 text-sm font-medium mb-2">Kata Sandi</label>
                <div class="relative">
                    <input type="password" name="password" id="password" required
                           placeholder="••••••••"
                           class="input-field w-full rounded-xl px-4 py-3 text-white placeholder-slate-500 text-sm pr-12 @error('password') border-red-500/60 @enderror">
                    <button type="button" onclick="togglePassword()"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-200 transition-colors">
                        <svg id="eye-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
                @error('password')
                    <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            {{-- Remember --}}
            <div class="flex items-center gap-2">
                <input type="checkbox" name="remember" id="remember"
                       class="w-4 h-4 accent-emerald-500 rounded">
                <label for="remember" class="text-slate-400 text-sm cursor-pointer">Ingat saya</label>
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn-login w-full py-3 rounded-xl text-white font-semibold text-sm">
                Masuk ke Dashboard
            </button>
        </form>

        {{-- Back link --}}
        <div class="mt-6 text-center">
            <a href="{{ route('products.index') }}"
               class="text-slate-500 text-xs hover:text-slate-300 transition-colors">
                ← Kembali ke toko
            </a>
        </div>
    </div>

    <p class="text-center text-slate-600 text-xs mt-6">
        Hanya admin yang berwenang yang dapat mengakses halaman ini.
    </p>
</div>

<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const isText = input.type === 'text';
        input.type = isText ? 'password' : 'text';
        document.getElementById('eye-icon').style.opacity = isText ? '1' : '0.4';
    }
</script>
</body>
</html>
