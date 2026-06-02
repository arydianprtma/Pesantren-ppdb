<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Pendaftaran - {{ $no_reg }}</title>
    <link rel="stylesheet" href="{{ asset('css/verification.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-100">
        <!-- Header -->
        <div class="p-8 text-center border-b border-slate-50 bg-gradient-to-b from-slate-50 to-white">
            <img src="/Logo Riyad.png" alt="Logo" class="h-20 mx-auto mb-4 drop-shadow-md">
            <h1 class="text-xl font-extrabold text-slate-800 uppercase tracking-tight">E-Verification System</h1>
            <p class="text-slate-500 text-sm font-medium mt-1">PPDB Online PP. Riyadussalikin</p>
        </div>

        <!-- Status Badge -->
        <div class="px-8 py-6 text-center">
            @if($isValid)
                <div class="inline-flex items-center gap-2 px-6 py-2 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-700 mb-2">
                    <span class="relative flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                    </span>
                    <span class="font-extrabold text-sm tracking-widest">DATA VALID</span>
                </div>
                <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mt-2">Terverifikasi oleh Sistem</p>
            @else
                <div class="inline-flex items-center gap-2 px-6 py-2 rounded-full bg-rose-50 border border-rose-100 text-rose-700 mb-2">
                    <span class="relative flex h-3 w-3">
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-rose-500"></span>
                    </span>
                    <span class="font-extrabold text-sm tracking-widest">TIDAK VALID</span>
                </div>
                <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mt-2">Data Tidak Ditemukan</p>
            @endif
        </div>

        @if($isValid)
            <!-- Data Peserta -->
            <div class="px-8 pb-8 space-y-6">
                <!-- Foto & Nama Utama -->
                <div class="flex flex-col items-center gap-4 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                    <div class="w-24 h-32 rounded-xl overflow-hidden border-4 border-white shadow-md bg-white">
                        @php
                            $avatarUrl = null;
                            if ($pendaftaran->user && $pendaftaran->user->avatar) {
                                if (filter_var($pendaftaran->user->avatar, FILTER_VALIDATE_URL)) {
                                    $avatarUrl = $pendaftaran->user->avatar;
                                } else {
                                    $avatarPath = ltrim($pendaftaran->user->avatar, '/');
                                    if (\Illuminate\Support\Facades\Storage::disk('public')->exists($avatarPath)) {
                                        $avatarUrl = asset('storage/' . $avatarPath);
                                    } elseif (\Illuminate\Support\Facades\Storage::disk('ppdb')->exists($avatarPath)) {
                                        $avatarUrl = asset('ppdb-storage/' . $avatarPath);
                                    }
                                }
                            }
                        @endphp
                        @if($avatarUrl)
                            <img src="{{ $avatarUrl }}" class="w-full h-full object-cover" alt="Foto {{ $pendaftaran->siswa->nama_lengkap }}">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-slate-100 text-slate-300">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                        @endif
                    </div>
                    <div class="text-center">
                        <h2 class="text-lg font-extrabold text-slate-900 uppercase leading-tight">{{ $pendaftaran->siswa->nama_lengkap }}</h2>
                        <p class="text-emerald-600 font-bold text-sm mt-1 tracking-widest">{{ $pendaftaran->no_reg }}</p>
                    </div>
                </div>

                <!-- Detail Grid -->
                <div class="grid grid-cols-1 gap-4 text-sm">
                    <div class="flex justify-between items-center py-2 border-b border-slate-50">
                        <span class="text-slate-400 font-bold uppercase text-[10px] tracking-wider">Tempat, Tgl Lahir</span>
                        <span class="text-slate-700 font-bold">{{ $pendaftaran->siswa->tempat_lahir ?? '-' }}, {{ $pendaftaran->siswa->tanggal_lahir ? \Carbon\Carbon::parse($pendaftaran->siswa->tanggal_lahir)->translatedFormat('d F Y') : '-' }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-slate-50">
                        <span class="text-slate-400 font-bold uppercase text-[10px] tracking-wider">NISN / NIK</span>
                        <span class="text-slate-700 font-bold">{{ $pendaftaran->siswa->nisn ?? '-' }} / {{ $pendaftaran->siswa->nik ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-slate-50">
                        <span class="text-slate-400 font-bold uppercase text-[10px] tracking-wider">Asal Sekolah</span>
                        <span class="text-slate-700 font-bold uppercase">{{ $pendaftaran->siswa->asal_sekolah ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-slate-50">
                        <span class="text-slate-400 font-bold uppercase text-[10px] tracking-wider">Jenjang Pendidikan</span>
                        <span class="text-emerald-700 font-black uppercase">{{ $pendaftaran->tingkat }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-slate-50">
                        <span class="text-slate-400 font-bold uppercase text-[10px] tracking-wider">Status Akun</span>
                        <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-600 font-bold text-[10px] uppercase italic">
                            {{ $pendaftaran->status }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <span class="text-slate-400 font-bold uppercase text-[10px] tracking-wider">Tgl Pendaftaran</span>
                        <span class="text-slate-700 font-bold text-xs italic">{{ $pendaftaran->created_at->translatedFormat('d F Y') }}</span>
                    </div>
                </div>
            </div>
        @else
            <!-- Error Message -->
            <div class="px-8 pb-8 text-center">
                <div class="p-6 bg-rose-50 rounded-2xl border border-rose-100 text-rose-600">
                    <svg class="w-12 h-12 mx-auto mb-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <p class="font-bold text-sm leading-relaxed italic">
                        Maaf, data pendaftaran dengan nomor registrasi <strong>{{ $no_reg }}</strong> tidak ditemukan atau token verifikasi tidak valid.
                    </p>
                </div>
                <a href="/" class="inline-block mt-8 text-slate-400 font-bold text-xs uppercase tracking-widest hover:text-slate-600 transition-colors">
                    ← Kembali ke Beranda
                </a>
            </div>
        @endif

        <!-- Footer -->
        <div class="p-6 bg-slate-50 text-center border-t border-slate-100">
            <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.3em]">&copy; 2026 PP. Riyadussalikin Padaherang</p>
        </div>
    </div>
</body>
</html>
