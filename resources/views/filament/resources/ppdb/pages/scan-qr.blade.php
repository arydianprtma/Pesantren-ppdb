<x-filament-panels::page>

<style>
    /* ── Keyframes ── */
    @keyframes scan-line {
        0%   { top: 10%; opacity: 0; }
        15%  { opacity: 1; }
        85%  { opacity: 1; }
        100% { top: 90%; opacity: 0; }
    }
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(8px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ── Layout ── */
    .sqr-wrap {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
        animation: fadeIn .4s ease both;
    }
    .sqr-card {
        width: 100%;
        max-width: 420px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 1.5rem;
        box-shadow: 0 20px 60px -10px rgba(0,0,0,.12);
        overflow: hidden;
    }
    .dark .sqr-card {
        background: #111827;
        border-color: #1f2937;
    }

    /* ── Header ── */
    .sqr-header {
        padding: 2rem;
        text-align: center;
        background: linear-gradient(180deg, #f8fafc 0%, #fff 100%);
        border-bottom: 1px solid #f1f5f9;
    }
    .dark .sqr-header {
        background: linear-gradient(180deg, rgba(31,41,55,.6) 0%, #111827 100%);
        border-bottom-color: #1f2937;
    }
    .sqr-icon-wrap {
        display: inline-flex;
        padding: 1rem;
        margin-bottom: 1rem;
        background: #ecfdf5;
        border-radius: 1rem;
        box-shadow: 0 0 0 1px #d1fae5;
    }
    .sqr-icon-wrap svg {
        width: 2.5rem;
        height: 2.5rem;
        color: #059669;
        stroke: #059669;
    }
    .sqr-title {
        font-size: 1.4rem;
        font-weight: 900;
        letter-spacing: -.02em;
        color: #0f172a;
        margin: 0 0 .4rem;
    }
    .dark .sqr-title { color: #f9fafb; }
    .sqr-subtitle {
        font-size: .85rem;
        font-weight: 500;
        color: #64748b;
        margin: 0;
    }

    /* ── Body ── */
    .sqr-body { padding: 1.75rem; }

    /* ── Scanner viewport ── */
    .sqr-viewport {
        position: relative;
        width: 100%;
        max-width: 300px;
        aspect-ratio: 1 / 1;
        margin: 0 auto;
        border-radius: 1.25rem;
        background: #0f172a;
        border: 2px solid #e2e8f0;
        overflow: hidden;
    }
    #sqr-reader {
        width: 100% !important;
        height: 100% !important;
        border: none !important;
        padding: 0 !important;
    }
    #sqr-reader video {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        border-radius: 1.2rem !important;
        display: block !important;
    }
    /* Hide all auto-generated UI from html5-qrcode */
    #sqr-reader canvas,
    #sqr-reader img,
    #sqr-reader__header_message,
    #sqr-reader__dashboard,
    #sqr-reader__status_span { display: none !important; }

    /* ── Scan overlay (corners + line) ── */
    .sqr-overlay {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        pointer-events: none;
        z-index: 10;
    }
    .sqr-frame {
        position: relative;
        width: 75%;
        height: 75%;
    }
    .sqr-corner {
        position: absolute;
        width: 1.4rem;
        height: 1.4rem;
        border-color: #34d399;
        border-style: solid;
        border-width: 0;
    }
    .sqr-corner.tl { top:0; left:0;  border-top-width:3px;    border-left-width:3px;   border-radius: .4rem 0 0 0; }
    .sqr-corner.tr { top:0; right:0; border-top-width:3px;    border-right-width:3px;  border-radius: 0 .4rem 0 0; }
    .sqr-corner.bl { bottom:0; left:0;  border-bottom-width:3px; border-left-width:3px;   border-radius: 0 0 0 .4rem; }
    .sqr-corner.br { bottom:0; right:0; border-bottom-width:3px; border-right-width:3px;  border-radius: 0 0 .4rem 0; }
    .sqr-scanline {
        position: absolute;
        left: 8%;
        right: 8%;
        height: 2px;
        background: rgba(52,211,153,.7);
        box-shadow: 0 0 8px rgba(52,211,153,.6);
        animation: scan-line 2s ease-in-out infinite;
    }

    /* ── Start overlay ── */
    .sqr-start-overlay {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        z-index: 20;
        background: rgba(15,23,42,.88);
        border-radius: 1.2rem;
        gap: .75rem;
    }
    .sqr-cam-icon {
        display: inline-flex;
        padding: 1rem;
        background: rgba(52,211,153,.15);
        border-radius: 1rem;
        box-shadow: 0 0 0 1px rgba(52,211,153,.25);
    }
    .sqr-cam-icon svg { width: 2.25rem; height: 2.25rem; stroke: #34d399; }
    .sqr-start-label {
        font-size: .65rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .12em;
        color: #f1f5f9;
        margin: 0;
    }
    .sqr-btn {
        padding: .55rem 1.4rem;
        background: #059669;
        color: #fff;
        font-size: .7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .1em;
        border: none;
        border-radius: .75rem;
        cursor: pointer;
        transition: background .15s, transform .1s;
        box-shadow: 0 4px 14px rgba(5,150,105,.35);
    }
    .sqr-btn:hover  { background: #047857; }
    .sqr-btn:active { transform: scale(.96); }
    .sqr-btn.danger { background: #dc2626; box-shadow: 0 4px 14px rgba(220,38,38,.3); }
    .sqr-btn.danger:hover { background: #b91c1c; }

    /* ── Loading ── */
    .sqr-loading {
        display: none;
        margin-top: 1.25rem;
        padding: 1rem;
        border-radius: 1rem;
        background: #ecfdf5;
        border: 1px solid #d1fae5;
        align-items: center;
        justify-content: center;
        gap: .75rem;
    }
    .sqr-loading.show { display: flex; }
    .sqr-spinner {
        width: 1.25rem;
        height: 1.25rem;
        border: 3px solid rgba(5,150,105,.2);
        border-top-color: #059669;
        border-radius: 50%;
        animation: spin .7s linear infinite;
        flex-shrink: 0;
    }
    .sqr-loading-text {
        font-size: .8rem;
        font-weight: 700;
        color: #065f46;
    }

    /* ── HTTPS Warning Banner ── */
    .sqr-https-warn {
        display: none;
        width: 100%;
        max-width: 420px;
        margin-bottom: 1rem;
        background: #fff7ed;
        border: 1.5px solid #fed7aa;
        border-radius: 1.25rem;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(234,88,12,.1);
        animation: fadeIn .4s ease both;
    }
    .sqr-https-warn.show { display: block; }
    .sqr-https-warn-head {
        display: flex;
        align-items: center;
        gap: .6rem;
        padding: .9rem 1rem .6rem;
        border-bottom: 1px solid #fed7aa;
    }
    .sqr-https-warn-head svg { width:1.3rem; height:1.3rem; stroke:#ea580c; flex-shrink:0; }
    .sqr-https-warn-title {
        font-size: .75rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: .07em;
        color: #9a3412;
        margin: 0;
    }
    .sqr-https-warn-body {
        padding: .75rem 1rem 1rem;
    }
    .sqr-https-warn-body p {
        font-size: .78rem;
        color: #7c2d12;
        line-height: 1.55;
        margin: 0 0 .75rem;
    }
    .sqr-https-warn-steps {
        background: #fff;
        border: 1px solid #fed7aa;
        border-radius: .75rem;
        padding: .75rem 1rem;
        margin: 0;
        list-style: none;
    }
    .sqr-https-warn-steps li {
        font-size: .72rem;
        color: #431407;
        font-weight: 600;
        padding: .2rem 0;
        display: flex;
        gap: .5rem;
        align-items: flex-start;
    }
    .sqr-https-warn-steps li::before {
        content: '→';
        color: #ea580c;
        font-weight: 900;
        flex-shrink: 0;
    }
    .sqr-https-current-url {
        margin-top: .6rem;
        padding: .4rem .7rem;
        background: #ffedd5;
        border-radius: .5rem;
        font-size: .68rem;
        font-family: monospace;
        color: #9a3412;
        word-break: break-all;
    }

    /* ── Error box ── */
    .sqr-error {
        display: none;
        margin-top: 1.25rem;
        padding: 1rem;
        border-radius: 1rem;
        background: #fef2f2;
        border: 1px solid #fecaca;
    }
    .sqr-error.show { display: block; }
    .sqr-error-head {
        font-size: .7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .08em;
        color: #991b1b;
        margin: 0 0 .2rem;
    }
    .sqr-error-msg {
        font-size: .72rem;
        color: #b91c1c;
        margin: 0 0 .75rem;
    }

    /* ── Info strip ── */
    .sqr-info {
        display: flex;
        align-items: flex-start;
        gap: .75rem;
        padding: 1rem;
        margin-top: 1.25rem;
        border-radius: 1rem;
        background: #f8fafc;
        border: 1px solid #f1f5f9;
    }
    .dark .sqr-info { background: rgba(31,41,55,.5); border-color: #374151; }
    .sqr-info-icon {
        flex-shrink: 0;
        padding: .5rem;
        background: #d1fae5;
        border-radius: .6rem;
    }
    .sqr-info-icon svg { width: 1.1rem; height: 1.1rem; stroke: #059669; fill: #059669; display: block; }
    .sqr-info-title {
        font-size: .65rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .08em;
        color: #374151;
        margin: 0 0 .25rem;
    }
    .dark .sqr-info-title { color: #f3f4f6; }
    .sqr-info-text {
        font-size: .7rem;
        font-weight: 500;
        font-style: italic;
        line-height: 1.5;
        color: #64748b;
        margin: 0;
    }
</style>

<div class="sqr-wrap">

    {{-- HTTPS Warning Banner --}}
    <div class="sqr-https-warn" id="sqr-https-warn">
        <div class="sqr-https-warn-head">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
            </svg>
            <p class="sqr-https-warn-title">⚠ Kamera Butuh HTTPS</p>
        </div>
        <div class="sqr-https-warn-body">
            <p>Browser memblokir akses kamera karena halaman ini dibuka via <strong>HTTP</strong> (tidak terenkripsi). Kamera hanya bisa diakses melalui <strong>HTTPS</strong>.</p>
            <ul class="sqr-https-warn-steps">
                <li>Buka <strong>Laragon</strong> → klik kanan tray icon → <strong>Laragon → SSL → Enable SSL</strong></li>
                <li>Atau buka menu <strong>Apache → SSL → laragon.test</strong> dan aktifkan untuk domain Anda</li>
                <li>Akses menggunakan <code>https://</code> bukan <code>http://</code></li>
                <li>Di HP: pastikan mengakses lewat HTTPS dan izinkan sertifikat jika diminta</li>
            </ul>
            <div class="sqr-https-current-url" id="sqr-current-url"></div>
        </div>
    </div>

    <div class="sqr-card">

        {{-- Header --}}
        <div class="sqr-header">
            <div class="sqr-icon-wrap">
                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M6.75 6.75h.75v.75h-.75v-.75zM6.75 16.5h.75v.75h-.75V16.5zM16.5 6.75h.75v.75h-.75v-.75zM13.5 13.5h.75v.75h-.75v-.75zM13.5 18.75h.75v.75h-.75v-.75zM18.75 13.5h.75v.75h-.75v-.75zM18.75 18.75h.75v.75h-.75v-.75zM16.5 16.5h.75v.75h-.75V16.5z"/>
                </svg>
            </div>
            <h3 class="sqr-title">SCAN VERIFIKASI</h3>
            <p class="sqr-subtitle">Arahkan kamera ke QR Code pada kartu</p>
        </div>

        {{-- Body --}}
        <div class="sqr-body">

            {{-- Viewport --}}
            <div class="sqr-viewport">
                <div id="sqr-reader"></div>

                {{-- Corner overlay --}}
                <div class="sqr-overlay" id="sqr-overlay">
                    <div class="sqr-frame">
                        <div class="sqr-corner tl"></div>
                        <div class="sqr-corner tr"></div>
                        <div class="sqr-corner bl"></div>
                        <div class="sqr-corner br"></div>
                        <div class="sqr-scanline" id="sqr-scanline"></div>
                    </div>
                </div>

                {{-- Start button --}}
                <div class="sqr-start-overlay" id="sqr-start-overlay">
                    <div class="sqr-cam-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.776 48.776 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z"/>
                        </svg>
                    </div>
                    <p class="sqr-start-label">Klik untuk mulai scan</p>
                    <button id="sqr-start-btn" class="sqr-btn">Aktifkan Kamera</button>
                </div>
            </div>

            {{-- Loading --}}
            <div class="sqr-loading" id="sqr-loading">
                <div class="sqr-spinner"></div>
                <span class="sqr-loading-text">Memverifikasi Data...</span>
            </div>

            {{-- Error --}}
            <div class="sqr-error" id="sqr-error">
                <p class="sqr-error-head">Kamera tidak bisa diakses</p>
                <p class="sqr-error-msg" id="sqr-error-msg">Izin kamera ditolak atau tidak tersedia.</p>
                <button id="sqr-retry-btn" class="sqr-btn danger" style="width:100%;">Coba Lagi</button>
            </div>

            {{-- Info strip --}}
            <div class="sqr-info">
                <div class="sqr-info-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                    </svg>
                </div>
                <div>
                    <p class="sqr-info-title">Keamanan Sistem</p>
                    <p class="sqr-info-text">Hanya Admin &amp; Super Admin yang dapat mengakses data pendaftaran melalui pemindaian ini.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/html5-qrcode.min.js') }}"></script>
<script>
(function () {

    /* ── 1. Deteksi HTTPS ── */
    var isSecure = window.location.protocol === 'https:' || window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1';

    if (!isSecure) {
        var warnBanner  = document.getElementById('sqr-https-warn');
        var currentUrl  = document.getElementById('sqr-current-url');
        var startBtn    = document.getElementById('sqr-start-btn');

        if (warnBanner) {
            warnBanner.classList.add('show');
        }
        if (currentUrl) {
            var httpsUrl = window.location.href.replace('http://', 'https://');
            currentUrl.innerHTML = 'URL sekarang: <strong>' + window.location.href + '</strong><br>Coba akses: <strong>' + httpsUrl + '</strong>';
        }
        /* Disable tombol start jika tidak HTTPS */
        if (startBtn) {
            startBtn.disabled = true;
            startBtn.style.opacity = '0.4';
            startBtn.style.cursor  = 'not-allowed';
            startBtn.textContent   = 'Butuh HTTPS';
        }
        return; /* Hentikan init scanner */
    }

    /* ── 2. Cek apakah getUserMedia tersedia ── */
    if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
        var startBtn = document.getElementById('sqr-start-btn');
        var errorBox = document.getElementById('sqr-error');
        var errorMsg = document.getElementById('sqr-error-msg');
        if (startBtn) {
            startBtn.disabled = true;
            startBtn.style.opacity = '0.4';
            startBtn.style.cursor  = 'not-allowed';
            startBtn.textContent   = 'Kamera Tidak Didukung';
        }
        if (errorBox && errorMsg) {
            errorMsg.textContent = 'Browser tidak mendukung akses kamera. Gunakan Chrome atau Edge versi terbaru.';
            errorBox.classList.add('show');
        }
        return;
    }

    /* ── 3. Init scanner ── */
    function waitForLib(cb) {
        if (typeof Html5Qrcode !== 'undefined') { cb(); }
        else { setTimeout(function(){ waitForLib(cb); }, 100); }
    }

    function initScanner() {
        var startOverlay = document.getElementById('sqr-start-overlay');
        var scanLine     = document.getElementById('sqr-scanline');
        var loading      = document.getElementById('sqr-loading');
        var errorBox     = document.getElementById('sqr-error');
        var errorMsg     = document.getElementById('sqr-error-msg');
        var startBtn     = document.getElementById('sqr-start-btn');
        var retryBtn     = document.getElementById('sqr-retry-btn');

        if (!startBtn) return;

        var scanner       = null;
        var isRedirecting = false;

        function showError(msg) {
            startOverlay.style.display = 'flex';
            errorBox.classList.add('show');
            /* Terjemahkan pesan error umum */
            if (!msg || msg.toLowerCase().includes('not supported')) {
                msg = 'Browser tidak mendukung akses kamera. Pastikan menggunakan HTTPS dan browser terbaru.';
            } else if (msg.toLowerCase().includes('permission') || msg.toLowerCase().includes('denied') || msg.toLowerCase().includes('notallowed')) {
                msg = 'Izin kamera ditolak. Klik ikon kunci/kamera di address bar lalu izinkan akses kamera.';
            } else if (msg.toLowerCase().includes('notfound') || msg.toLowerCase().includes('no camera')) {
                msg = 'Kamera tidak ditemukan. Pastikan perangkat memiliki kamera yang terhubung.';
            }
            errorMsg.textContent = msg;
        }

        function hideError() {
            errorBox.classList.remove('show');
        }

        function startScan() {
            hideError();
            startOverlay.style.display = 'none';

            if (!scanner) {
                scanner = new Html5Qrcode('sqr-reader');
            }

            scanner.start(
                { facingMode: 'environment' },
                { fps: 15, qrbox: { width: 200, height: 200 }, aspectRatio: 1.0 },
                function (decodedText) {
                    if (isRedirecting) return;
                    if (!decodedText.includes('/verifikasi/')) return;
                    isRedirecting = true;
                    loading.classList.add('show');
                    scanLine.style.display = 'none';
                    scanner.stop().finally(function () {
                        window.location.href = decodedText;
                    });
                },
                function () { /* silent per-frame failure */ }
            ).catch(function (err) {
                startOverlay.style.display = 'flex';
                showError(err && err.message ? err.message : String(err));
            });
        }

        function retryScan() {
            isRedirecting = false;
            scanLine.style.display = '';
            if (scanner) {
                scanner.stop().catch(function(){}).finally(function () {
                    scanner = null;
                    startScan();
                });
            } else {
                startScan();
            }
        }

        startBtn.addEventListener('click', startScan);
        retryBtn.addEventListener('click', retryScan);
    }

    waitForLib(initScanner);
})();
</script>

</x-filament-panels::page>