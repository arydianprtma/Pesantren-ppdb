<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Guru & Tenaga Pendidik</title>
    <style>
        /* ── Reset & Base ── */
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            font-size: 11px;
            color: #1e293b;
            background: #f1f5f9;
            padding-top: 64px;
            line-height: 1.5;
        }

        /* ── Print Toolbar (Glassmorphic) ── */
        .print-controls {
            position: fixed; top: 0; left: 0; right: 0; z-index: 999;
            background: linear-gradient(135deg, #0f172a 0%, #1e3a2f 50%, #14532d 100%);
            color: white;
            padding: 10px 20px;
            display: flex; align-items: center; gap: 10px; flex-wrap: wrap;
            box-shadow: 0 4px 24px rgba(0,0,0,0.3);
            border-bottom: 2px solid rgba(255,255,255,0.08);
        }
        .ctrl-label {
            font-size: 12px; font-weight: 700;
            letter-spacing: 0.3px;
            display: flex; align-items: center; gap: 6px;
        }
        .ctrl-label svg { width: 16px; height: 16px; }
        .divider { width: 1px; height: 28px; background: rgba(255,255,255,0.15); margin: 0 6px; }
        .size-btn {
            padding: 6px 14px; border-radius: 8px;
            border: 1.5px solid rgba(255,255,255,0.15);
            background: rgba(255,255,255,0.06);
            color: #94a3b8; font-size: 11px; font-weight: 600;
            cursor: pointer; transition: all .2s ease;
            backdrop-filter: blur(4px);
        }
        .size-btn:hover {
            border-color: #34d399; background: rgba(52,211,153,0.12);
            color: #fff; transform: translateY(-1px);
        }
        .size-btn.active {
            border-color: #10b981; background: linear-gradient(135deg, #059669, #047857);
            color: #fff; box-shadow: 0 2px 8px rgba(16,185,129,0.35);
        }
        .print-btn {
            margin-left: auto;
            background: linear-gradient(135deg, #059669, #047857);
            color: white; border: none;
            padding: 8px 22px; border-radius: 8px;
            font-size: 12px; font-weight: 700;
            cursor: pointer; transition: all .2s ease;
            box-shadow: 0 2px 12px rgba(5,150,105,0.3);
            display: flex; align-items: center; gap: 6px;
        }
        .print-btn:hover {
            background: linear-gradient(135deg, #047857, #065f46);
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(5,150,105,0.4);
        }
        .print-btn svg { width: 16px; height: 16px; }

        /* ── Page Container ── */
        .page-container {
            max-width: 100%;
            background: #fff;
            padding: 0;
        }

        /* ── Kop Surat ── */
        .kop {
            display: flex;
            align-items: center;
            gap: 16px;
            padding-bottom: 12px;
            margin-bottom: 0;
        }
        .kop img {
            width: 70px; height: 70px;
            object-fit: contain; flex-shrink: 0;
        }
        .kop-text { flex: 1; text-align: center; }
        .kop-text h1 {
            font-size: 16px; font-weight: 800;
            color: #14532d; letter-spacing: 1px;
            text-transform: uppercase;
        }
        .kop-text .alamat {
            font-size: 10px; color: #475569;
            margin-top: 2px; letter-spacing: 0.2px;
        }
        .kop-text .sub {
            font-size: 9.5px; color: #64748b;
            margin-top: 1px; font-style: italic;
        }
        .kop-spacer { width: 70px; flex-shrink: 0; }

        /* Double-line border */
        .kop-border {
            border: none;
            border-top: 3px solid #14532d;
            margin-bottom: 2px;
        }
        .kop-border-thin {
            border: none;
            border-top: 1px solid #14532d;
            margin-bottom: 14px;
        }

        /* ── Judul Laporan ── */
        .judul-laporan {
            text-align: center;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #14532d;
            margin: 0 0 16px;
            padding-bottom: 8px;
            position: relative;
        }
        .judul-laporan::after {
            content: '';
            position: absolute;
            bottom: 0; left: 50%;
            transform: translateX(-50%);
            width: 80px; height: 2px;
            background: linear-gradient(90deg, transparent, #14532d, transparent);
        }

        /* ── Meta Info Card ── */
        .meta-card {
            display: flex; gap: 16px; flex-wrap: wrap;
            margin-bottom: 16px;
            padding: 10px 14px;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            font-size: 10px; color: #166534;
        }
        .meta-item {
            display: flex; align-items: center; gap: 4px;
        }
        .meta-item strong { font-weight: 700; }

        /* ── Tabel ── */
        table {
            width: 100%; border-collapse: collapse;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            overflow: hidden;
        }
        thead tr {
            background: linear-gradient(135deg, #14532d, #166534) !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        thead th {
            padding: 8px 6px;
            text-align: left;
            font-size: 9px; font-weight: 700;
            color: #fff !important;
            border: 1px solid #15803d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        tbody tr { transition: background .15s; }
        tbody tr:nth-child(even) {
            background: #f8fafc;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        tbody tr:hover { background: #f0fdf4; }
        tbody td {
            padding: 6px;
            border: 1px solid #e2e8f0;
            font-size: 9.5px;
            color: #334155;
        }
        tbody td strong { color: #0f172a; font-weight: 600; }
        thead th:first-child,
        tbody td:first-child { text-align: center; width: 30px; }

        /* ── TTD ── */
        .ttd-section {
            margin-top: 36px;
            display: flex;
            justify-content: flex-end;
            page-break-inside: avoid;
        }
        .ttd-box {
            text-align: center;
            font-size: 10px;
            color: #334155;
        }
        .ttd-box .ttd-lokasi { font-size: 10px; margin-bottom: 2px; }
        .ttd-box .ttd-jabatan { font-size: 10px; font-weight: 600; margin-bottom: 56px; }
        .ttd-box .ttd-name {
            border-top: 1.5px solid #14532d;
            padding-top: 4px;
            font-weight: 700; font-size: 10px;
            min-width: 180px; color: #14532d;
        }

        /* ── Footer ── */
        .footer {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 8.5px;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
            padding-top: 8px;
        }

        /* ── Print Styles ── */
        @media print {
            .print-controls { display: none !important; }
            body {
                padding-top: 0 !important;
                font-size: 10px;
                background: #fff;
            }
            .meta-card {
                background: #f0fdf4 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            tbody tr:nth-child(even) {
                background: #f8fafc !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
    <style id="page-style">
        @page { margin: 1.5cm; size: A4 landscape; }
    </style>
</head>
<body>

{{-- ── Toolbar ── --}}
<div class="print-controls">
    <span class="ctrl-label">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
        Ukuran Kertas
    </span>
    <button class="size-btn active" onclick="setSize('A4 landscape',  this)">A4 Landscape</button>
    <button class="size-btn"        onclick="setSize('A4 portrait',   this)">A4 Portrait</button>
    <div class="divider"></div>
    <button class="size-btn" onclick="setSize('330mm 210mm', this)">F4 Landscape</button>
    <button class="size-btn" onclick="setSize('210mm 330mm', this)">F4 Portrait</button>
    <button class="print-btn" onclick="window.print()">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18.75 9H5.25" /></svg>
        Cetak / Simpan PDF
    </button>
</div>

<div class="page-container">

    {{-- ── Kop Surat ── --}}
    <div class="kop">
        <img src="/Logo Riyad.png" alt="Logo Pesantren" onerror="this.style.display='none'">
        <div class="kop-text">
            <h1>Pondok Pesantren Riyadussalikin Padaherang</h1>
            <p class="alamat">Jl. Raya Padaherang, Kab. Pangandaran, Jawa Barat</p>
            <p class="sub">Data Guru &amp; Tenaga Pendidik</p>
        </div>
        <div class="kop-spacer"></div>
    </div>
    <hr class="kop-border">
    <hr class="kop-border-thin">

    {{-- ── Judul Laporan ── --}}
    <div class="judul-laporan">Daftar Guru &amp; Tenaga Pendidik</div>

    {{-- ── Meta Info ── --}}
    <div class="meta-card">
        <div class="meta-item"><strong>Total Data:</strong> {{ count($data) }} guru</div>
        <div class="meta-item"><strong>Tanggal Cetak:</strong> {{ now()->translatedFormat('d F Y, H:i') }} WIB</div>
        <div class="meta-item"><strong>Sumber:</strong> Sistem Portal Admin</div>
    </div>

    {{-- ── Tabel Data ── --}}
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>NIP / NIK</th>
                <th>Jabatan</th>
                <th>Mata Pelajaran</th>
                <th>Pendidikan Terakhir</th>
                <th>No. HP</th>
                <th>Email</th>
                <th>Tgl Bergabung</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $i => $row)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><strong>{{ $row->nama }}</strong></td>
                    <td>{{ $row->nip ?? $row->nik ?? '-' }}</td>
                    <td>{{ $row->jabatan ?? '-' }}</td>
                    <td>{{ $row->mata_pelajaran ?? '-' }}</td>
                    <td>{{ $row->pendidikan_terakhir ?? '-' }}</td>
                    <td>{{ $row->no_hp ?? '-' }}</td>
                    <td>{{ $row->email ?? '-' }}</td>
                    <td>{{ $row->tanggal_bergabung ? \Carbon\Carbon::parse($row->tanggal_bergabung)->format('d/m/Y') : '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align:center; padding:24px; color:#94a3b8; font-style:italic;">
                        Tidak ada data guru yang dapat ditampilkan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- ── Tanda Tangan ── --}}
    <div class="ttd-section">
        <div class="ttd-box">
            <div class="ttd-lokasi">Padaherang, {{ now()->translatedFormat('d F Y') }}</div>
            <div class="ttd-jabatan">Kepala Pesantren,</div>
            <div class="ttd-name">( __________________________ )</div>
        </div>
    </div>

    {{-- ── Footer ── --}}
    <div class="footer">
        <span>Dokumen ini dicetak dari Sistem Portal Admin &mdash; {{ config('app.name') }}</span>
        <span>Halaman dicetak: {{ now()->format('d/m/Y H:i') }}</span>
    </div>

</div>

<script>
function setSize(pageSize, btn) {
    document.getElementById('page-style').textContent = '@page { margin: 1.5cm; size: ' + pageSize + '; }';
    document.querySelectorAll('.size-btn').forEach(function(b) { b.classList.remove('active'); });
    btn.classList.add('active');
}
</script>
</body>
</html>
