<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pendaftar SPMB</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 11px; color: #111; background: #fff; padding-top: 56px; }

        /* ── Toolbar ── */
        .print-controls {
            position: fixed; top: 0; left: 0; right: 0; z-index: 999;
            background: #1e293b; color: white;
            padding: 8px 16px;
            display: flex; align-items: center; gap: 8px; flex-wrap: wrap;
            box-shadow: 0 2px 10px rgba(0,0,0,0.4);
        }
        .ctrl-label { font-size: 12px; font-weight: 700; }
        .divider { width: 1px; height: 24px; background: #475569; margin: 0 4px; }
        .size-btn {
            padding: 5px 12px; border-radius: 6px; border: 1.5px solid #475569;
            background: #334155; color: #cbd5e1; font-size: 11px; font-weight: 600;
            cursor: pointer; transition: all .15s;
        }
        .size-btn:hover  { border-color: #93c5fd; background: #1d4ed8; color: #fff; }
        .size-btn.active { border-color: #3b82f6; background: #2563eb; color: #fff; }
        .print-btn {
            margin-left: auto; background: #16a34a; color: white; border: none;
            padding: 7px 18px; border-radius: 7px; font-size: 12px; font-weight: 700; cursor: pointer;
        }
        .print-btn:hover { background: #15803d; }

        /* ── Kop Surat ── */
        .kop {
            display: flex;
            align-items: center;
            gap: 16px;
            border-bottom: 3px solid #111;
            padding-bottom: 10px;
            margin-bottom: 4px;
        }
        .kop img { width: 64px; height: 64px; object-fit: contain; flex-shrink: 0; }
        .kop-text { flex: 1; text-align: center; }
        .kop-text h1 { font-size: 15px; font-weight: bold; color: #111; letter-spacing: .3px; }
        .kop-text p  { font-size: 10px; color: #333; margin-top: 2px; }
        .kop-spacer  { width: 64px; } /* balancer kiri-kanan agar teks tetap center */

        .judul-laporan {
            text-align: center;
            font-size: 12px;
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin: 8px 0 4px;
            color: #111;
        }

        /* ── Meta info ── */
        .meta { margin: 6px 0 10px; font-size: 10px; color: #333; display: flex; gap: 12px; }
        .meta span::before { content: "• "; }

        /* ── Tabel ── */
        table { width: 100%; border-collapse: collapse; }
        thead tr {
            background: #222 !important;
            color: #fff !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        thead th { padding: 6px 5px; text-align: left; font-size: 9.5px; font-weight: 700; border: 1px solid #000; color: #fff !important; }
        tbody tr:nth-child(even) { background: #f5f5f5; }
        tbody td { padding: 5px; border: 1px solid #bbb; font-size: 9.5px; vertical-align: top; }

        .badge {
            display: inline-block; padding: 1px 6px; border-radius: 3px;
            font-size: 8.5px; font-weight: 700;
            border: 1px solid #aaa; background: #f0f0f0; color: #111;
        }
        .badge-diterima { background: #e8e8e8; border-color: #555; }
        .badge-ditolak  { background: #fff; border-color: #333; font-style: italic; }

        /* ── Footer ── */
        .footer {
            margin-top: 16px;
            display: flex; justify-content: space-between;
            font-size: 9px; color: #555;
            border-top: 1px solid #bbb;
            padding-top: 6px;
        }
        .ttd {
            margin-top: 40px;
            display: flex;
            justify-content: flex-end;
        }
        .ttd-box {
            display: inline-block;
            text-align: center;
            font-size: 10px;
        }
        .ttd-box .ttd-label { font-size: 10px; margin-bottom: 60px; }
        .ttd-box .ttd-name  { border-top: 1px solid #111; padding-top: 4px; font-weight: bold; font-size: 10px; min-width: 160px; }

        @media print {
            .print-controls { display: none !important; }
            body { padding-top: 0 !important; font-size: 10px; }
        }
    </style>
    <style id="page-style">
        @page { margin: 1.5cm; size: A4 landscape; }
    </style>
</head>
<body>

{{-- ── Toolbar ── --}}
<div class="print-controls">
    <span class="ctrl-label">📄 Ukuran Kertas:</span>
    <button class="size-btn active" onclick="setSize('A4 landscape',    this)">A4 Landscape</button>
    <button class="size-btn"        onclick="setSize('A4 portrait',     this)">A4 Portrait</button>
    <div class="divider"></div>
    <button class="size-btn" onclick="setSize('330mm 210mm', this)">F4 Landscape</button>
    <button class="size-btn" onclick="setSize('210mm 330mm', this)">F4 Portrait</button>
    <button class="print-btn" onclick="window.print()">🖨️ Cetak / Simpan PDF</button>
</div>

{{-- ── Kop Surat ── --}}
<div class="kop">
    <img src="/Logo Riyad.png" alt="Logo Pesantren" onerror="this.style.display='none'">
    <div class="kop-text">
        <h1>PONDOK PESANTREN RIYADUSSALIKIN PADAHERANG</h1>
        <p>Jl. Raya Padaherang, Kab. Pangandaran, Jawa Barat</p>
        <p>Portal SPMB — Penerimaan Santri Baru</p>
    </div>
    <div class="kop-spacer"></div>
</div>

<div class="judul-laporan">Laporan Data Pendaftar SPMB</div>


<table>
    <thead>
        <tr>
            <th>No</th>
            <th>No. Registrasi</th>
            <th>Nama Calon Santri</th>
            <th>L/P</th>
            <th>Tingkat</th>
            <th>NIK</th>
            <th>NISN</th>
            <th>Tgl Lahir</th>
            <th>No. WA</th>
            <th>Email</th>
            <th>Status</th>
            <th>Tgl Daftar</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $i => $row)
            @php
                $siswa = $row->siswa;
                $statusBadge = match($row->status) {
                    'diterima_ula', 'diterima_wustho', 'diterima_ulya' => 'badge-diterima',
                    'ditolak' => 'badge-ditolak',
                    default   => '',
                };
                $statusLabel = match($row->status) {
                    'pending'         => 'Menunggu',
                    'jadwal_tes'      => 'Jadwal Tes',
                    'tes_berlangsung' => 'Tes Berlangsung',
                    'wawancara'       => 'Wawancara',
                    'diterima_ula'    => 'Diterima - Ula',
                    'diterima_wustho' => 'Diterima - Wustho',
                    'diterima_ulya'   => 'Diterima - Ulya',
                    'ditolak'         => 'Tidak Diterima',
                    default           => ucfirst($row->status),
                };
            @endphp
            <tr>
                <td>{{ $i + 1 }}</td>
                <td><strong>{{ $row->no_reg }}</strong></td>
                <td>{{ $siswa?->nama_lengkap ?? '-' }}</td>
                <td>{{ $siswa?->jenis_kelamin ?? '-' }}</td>
                <td><strong>{{ strtoupper($row->tingkat) }}</strong></td>
                <td>{{ $siswa?->nik ?? '-' }}</td>
                <td>{{ $siswa?->nisn ?? '-' }}</td>
                <td>{{ $siswa?->tanggal_lahir ? \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d/m/Y') : '-' }}</td>
                <td>{{ $siswa?->no_hp ?? '-' }}</td>
                <td>{{ $row->user?->email ?? '-' }}</td>
                <td><span class="badge {{ $statusBadge }}">{{ $statusLabel }}</span></td>
                <td>{{ \Carbon\Carbon::parse($row->tanggal_daftar)->format('d/m/Y') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="12" style="text-align:center; padding:20px; color:#666;">Tidak ada data pendaftar.</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- ── TTD & Footer ── --}}
<div class="ttd">
    <div class="ttd-box">
        <div class="ttd-label">Padaherang, {{ now()->format('d F Y') }}<br>Kepala Pesantren,</div>
        <div class="ttd-name">( __________________________ )</div>
    </div>
</div>

<div class="footer">
    <span>Dokumen ini dicetak dari Sistem Portal Admin SPMB — {{ config('app.name') }}</span>
    <span>Halaman dicetak: {{ now()->format('d/m/Y H:i') }}</span>
</div>

<script>
function setSize(pageSize, btn) {
    document.getElementById('page-style').textContent = `@page { margin: 1.5cm; size: ${pageSize}; }`;
    document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
}
</script>
</body>
</html>
