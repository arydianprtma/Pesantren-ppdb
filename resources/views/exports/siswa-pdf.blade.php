<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Siswa / Santri</title>
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11px; color: #000; background: #fff;
            padding-top: 56px; line-height: 1.4;
        }

        .print-controls {
            position: fixed; top: 0; left: 0; right: 0; z-index: 999;
            background: #111; color: #fff;
            padding: 8px 16px;
            display: flex; align-items: center; gap: 8px; flex-wrap: wrap;
            box-shadow: 0 2px 6px rgba(0,0,0,.3);
        }
        .ctrl-label { font-family: sans-serif; font-size: 12px; font-weight: 700; }
        .divider { width: 1px; height: 24px; background: #444; margin: 0 4px; }
        .size-btn {
            font-family: sans-serif;
            padding: 5px 12px; border-radius: 4px;
            border: 1px solid #555; background: #222;
            color: #ccc; font-size: 11px; font-weight: 600;
            cursor: pointer; transition: all .15s;
        }
        .size-btn:hover { background: #333; color: #fff; border-color: #888; }
        .size-btn.active { background: #fff; color: #000; border-color: #fff; }
        .print-btn {
            font-family: sans-serif;
            margin-left: auto; background: #fff; color: #000; border: none;
            padding: 6px 16px; border-radius: 4px;
            font-size: 12px; font-weight: 700; cursor: pointer;
        }
        .print-btn:hover { background: #ddd; }

        /* ── Kop Surat ── */
        .kop {
            text-align: center;
            font-family: 'Times New Roman', Times, serif;
            color: #000;
            padding-bottom: 4px;
        }
        .kop-header {
            font-size: 14px;
            font-weight: bold;
            line-height: 1.3;
            text-transform: uppercase;
        }
        .kop-alamat {
            font-size: 10.5px;
            line-height: 1.3;
            margin-top: 4px;
            font-weight: normal;
        }
        .kop-border {
            border: none;
            border-top: 1px solid #000;
            margin-top: 6px;
            margin-bottom: 1px;
        }
        .kop-border-thick {
            border: none;
            border-top: 3px solid #000;
            margin-bottom: 12px;
        }

        .judul-laporan {
            text-align: center; font-size: 12px; font-weight: bold;
            text-transform: uppercase; text-decoration: underline;
            letter-spacing: .5px; margin-bottom: 12px;
        }

        .meta { margin-bottom: 8px; font-size: 10px; display: flex; gap: 16px; }

        table { width: 100%; border-collapse: collapse; }
        thead th {
            background: #000 !important; color: #fff !important;
            padding: 6px 6px; text-align: left;
            font-size: 10px; font-weight: 700; border: 1px solid #000;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact; print-color-adjust: exact;
        }
        tbody tr:nth-child(even) {
            background: #f2f2f2;
            -webkit-print-color-adjust: exact; print-color-adjust: exact;
        }
        tbody td { padding: 6px; border: 1px solid #999; font-size: 10px; }
        thead th:first-child, tbody td:first-child { text-align: center; width: 36px; }

        .ttd-section { margin-top: 32px; display: flex; justify-content: flex-end; page-break-inside: avoid; }
        .ttd-box { text-align: center; font-size: 10px; }
        .ttd-box .ttd-jabatan { margin-bottom: 56px; }
        .ttd-box .ttd-name { border-top: 1px solid #000; padding-top: 4px; font-weight: bold; min-width: 180px; }

        .footer {
            margin-top: 16px; display: flex; justify-content: space-between;
            font-size: 8px; color: #666; border-top: 1px solid #ccc; padding-top: 4px;
        }

        @media print {
            .print-controls { display: none !important; }
            body { padding-top: 0 !important; }
        }
    </style>
    <style id="page-style">@page { margin: 1.5cm; size: A4 portrait; }</style>
</head>
<body>

<div class="print-controls">
    <span class="ctrl-label">📄 Ukuran Kertas:</span>
    <button class="size-btn active" onclick="setSize('A4 portrait',  this)">A4 Portrait</button>
    <button class="size-btn"        onclick="setSize('A4 landscape', this)">A4 Landscape</button>
    <div class="divider"></div>
    <button class="size-btn" onclick="setSize('210mm 330mm', this)">F4 Portrait</button>
    <button class="size-btn" onclick="setSize('330mm 210mm', this)">F4 Landscape</button>
    <button class="print-btn" onclick="window.print()">🖨️ Cetak / Simpan PDF</button>
</div>

<div class="kop">
    @php
        $tingkat = isset($filter['tingkat']) ? strtoupper($filter['tingkat']) : 'SEMUA';
    @endphp

    @if($tingkat === 'SMA')
        <div class="kop-header">
            <div>PEMERINTAH PROVINSI JAWA BARAT</div>
            <div>DINAS PENDIDIKAN</div>
            <div>YAYASAN AL MASRUHIYAH</div>
            <div>SMA KSATRIA NUSANTARA</div>
        </div>
        <div class="kop-alamat">
            <div>No Izin Operasional : 421.3/0442-Disdikbudpora/2016 &nbsp; NPSN : 69935515</div>
            <div>Jalan Paledah Dusun Patinggen II RT 020 / RW 005 Desa Karangpawitan Kecamatan Padaherang</div>
            <div>Kabupaten Pangandaran Kode Pos 46384 No HP 087725807558</div>
            <div>Email: <span style="text-decoration: underline; color: #000;">smaksatrianusantara01@gmail.com</span></div>
        </div>
    @elseif($tingkat === 'SMP')
        <div class="kop-header">
            <div>PEMERINTAH KABUPATEN PANGANDARAN</div>
            <div>DINAS PENDIDIKAN KEPEMUDAAN DAN OLAHRAGA</div>
            <div>YAYASAN AL MASRUHIYAH</div>
            <div>SMP DHARMA KSATRIA</div>
        </div>
        <div class="kop-alamat">
            <div>No Izin Operasional : 421/3143/Disdikbudpora/2016 &nbsp; NPSN : 69950605</div>
            <div>Jalan Paledah Dusun Patinggen II RT 020 / RW 005 Desa Karangpawitan Kecamatan Padaherang</div>
            <div>Kabupaten Pangandaran Kode Pos 46384 No HP 087725807558</div>
            <div>Email: <span style="text-decoration: underline; color: #000;">smpdharmaksatria@gmail.com</span></div>
        </div>
    @else
        <div class="kop-header">
            <div>YAYASAN AL MASRUHIYAH</div>
            <div>PONDOK PESANTREN RIYADUSSALIKIN PADAHERANG</div>
            <div>SMP DHARMA KSATRIA &amp; SMA KSATRIA NUSANTARA</div>
        </div>
        <div class="kop-alamat">
            <div>Jalan Paledah Dusun Patinggen II RT 020 / RW 005 Desa Karangpawitan Kecamatan Padaherang</div>
            <div>Kabupaten Pangandaran Kode Pos 46384 No HP 087725807558</div>
            <div>Email: <span style="text-decoration: underline; color: #000;">smpdharmaksatria@gmail.com</span> / <span style="text-decoration: underline; color: #000;">smaksatrianusantara01@gmail.com</span></div>
        </div>
    @endif
</div>
<hr class="kop-border">
<hr class="kop-border-thick">

<div class="judul-laporan">Daftar Santri / Siswa Terdaftar {{ $tingkat !== 'SEMUA' ? '('.$tingkat.')' : '' }}</div>

<div class="meta">
    <span>Total: <strong>{{ count($data) }}</strong> santri {{ $tingkat !== 'SEMUA' ? $tingkat : '' }}</span>
    <span>Dicetak: <strong>{{ now()->translatedFormat('d F Y, H:i') }}</strong></span>
</div>

<table>
    <thead>
        <tr>
            <th style="width:5%;">No</th>
            <th style="width:35%;">Nama Lengkap</th>
            <th style="width:30%;">Email</th>
            <th style="width:15%;">No. WhatsApp</th>
            <th style="width:15%;">Tanggal Terdaftar</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $i => $row)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td><strong>{{ $row->name }}</strong></td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->whatsapp ?? '-' }}</td>
                <td>{{ $row->created_at ? $row->created_at->format('d/m/Y') : '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="text-align:center; padding:20px; color:#666; font-style:italic;">Tidak ada data siswa / santri.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="ttd-section">
    <div class="ttd-box">
        <div>Padaherang, {{ now()->translatedFormat('d F Y') }}</div>
        <div class="ttd-jabatan">Kepala Pesantren,</div>
        <div class="ttd-name">( __________________________ )</div>
    </div>
</div>

<div class="footer">
    <span>Dokumen dicetak dari Sistem Portal Admin &mdash; {{ config('app.name') }}</span>
    <span>{{ now()->format('d/m/Y H:i') }}</span>
</div>

<script>
function setSize(s, b) {
    document.getElementById('page-style').textContent = '@page { margin: 1.5cm; size: ' + s + '; }';
    document.querySelectorAll('.size-btn').forEach(function(e) { e.classList.remove('active'); });
    b.classList.add('active');
}
</script>
</body>
</html>
