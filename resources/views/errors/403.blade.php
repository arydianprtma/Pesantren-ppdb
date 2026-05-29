<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Ditolak - 403 Forbidden</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-100">
        <!-- Header -->
        <div class="p-8 text-center border-b border-slate-50 bg-gradient-to-b from-slate-50 to-white">
            <div class="w-20 h-20 bg-rose-100 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-sm">
                <svg class="w-10 h-10 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m0-8v6m-5 2h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h1 class="text-2xl font-black text-slate-900 uppercase tracking-tighter italic">403 ACCESS DENIED</h1>
            <p class="text-slate-500 text-sm font-bold mt-1 uppercase tracking-widest">Sistem Keamanan Terpadu</p>
        </div>

        <!-- Error Content -->
        <div class="p-8 text-center">
            <div class="p-6 bg-rose-50 rounded-2xl border border-rose-100 text-rose-700 mb-6">
                <p class="font-extrabold text-sm leading-relaxed uppercase italic">
                    {{ $exception->getMessage() ?: 'Anda tidak memiliki hak akses untuk halaman ini.' }}
                </p>
            </div>
            
            <p class="text-slate-400 text-xs font-semibold leading-relaxed mb-8 px-4">
                Maaf, sesi Anda saat ini tidak memiliki otoritas sebagai <span class="text-slate-800 font-bold">Admin/Super Admin</span>. 
                Halaman verifikasi QR Code hanya dapat diakses oleh personil yang berwenang.
            </p>

            <div class="grid grid-cols-1 gap-3">
                <a href="/portal/login" class="flex items-center justify-center px-6 py-3 bg-slate-900 text-white rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-slate-800 transition-all shadow-lg shadow-slate-200">
                    Masuk Portal Admin
                </a>
                <a href="javascript:history.back()" class="flex items-center justify-center px-6 py-3 bg-white text-slate-500 border border-slate-200 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-slate-50 transition-all">
                    Kembali
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="p-6 bg-slate-50 text-center border-t border-slate-100">
            <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.3em]">&copy; 2026 PP. Riyadussalikin Padaherang</p>
        </div>
    </div>
</body>
</html>
