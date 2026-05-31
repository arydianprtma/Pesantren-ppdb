<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Terjadi Kesalahan' }} - {{ $code ?? 'Error' }}</title>
    <link rel="stylesheet" href="{{ asset('css/verification.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-lg w-full bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-100">
        <!-- Header -->
        <div class="p-8 text-center border-b border-slate-50 bg-gradient-to-b from-slate-50 to-white">
            <div class="w-20 h-20 {{ $is_client_error ? 'bg-amber-100 text-amber-600' : 'bg-rose-100 text-rose-600' }} rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-sm ring-1 ring-inset {{ $is_client_error ? 'ring-amber-200' : 'ring-rose-200' }}">
                @if($code == 404)
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                @elseif($code == 419)
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                @else
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                @endif
            </div>
            <div class="text-6xl font-black text-slate-900 tracking-tighter italic mb-1">{{ $code }}</div>
            <h1 class="text-sm font-black text-slate-500 uppercase tracking-[0.2em]">{{ $title }}</h1>
            <p class="text-slate-400 text-[10px] font-bold mt-2 uppercase tracking-[0.2em]">Pondok Pesantren Riyadussalikin</p>
        </div>

        <!-- Error Content -->
        <div class="p-8">
            <div class="p-6 {{ $is_client_error ? 'bg-amber-50 border-amber-100 text-amber-800' : 'bg-rose-50 border-rose-100 text-rose-800' }} rounded-2xl border mb-6 text-center">
                <p class="font-extrabold text-sm leading-relaxed uppercase italic">
                    {{ $message }}
                </p>
            </div>
            
            <p class="text-slate-500 text-xs font-medium leading-relaxed mb-8 text-center px-4">
                {{ $description }}
            </p>

            @if(config('app.debug') && isset($debug))
            <div class="mb-8 p-4 bg-slate-900 rounded-xl text-left overflow-x-auto">
                <p class="text-[10px] font-mono text-emerald-400 mb-2 uppercase tracking-widest border-b border-slate-700 pb-1">Debug Information</p>
                <pre class="text-[10px] font-mono text-slate-300 leading-tight">Message: {{ $debug['message'] }}
File: {{ $debug['file'] }}
Line: {{ $debug['line'] }}
Exception: {{ $debug['class'] }}</pre>
            </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <a href="/" class="flex items-center justify-center px-6 py-3 bg-slate-900 text-white rounded-xl font-bold text-[10px] uppercase tracking-widest hover:bg-slate-800 transition-all shadow-lg shadow-slate-200">
                    Ke Beranda
                </a>
                <a href="javascript:history.back()" class="flex items-center justify-center px-6 py-3 bg-white text-slate-500 border border-slate-200 rounded-xl font-bold text-[10px] uppercase tracking-widest hover:bg-slate-50 transition-all">
                    Kembali
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="p-6 bg-slate-50 text-center border-t border-slate-100">
            <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.3em]">&copy; 2026 Sistem Informasi PPDB Riyadussalikin</p>
        </div>
    </div>
</body>
</html>