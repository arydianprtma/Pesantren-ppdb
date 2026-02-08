<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Polling interval 2 detik (sesuai request user)
        const UPDATE_INTERVAL = 2000;

        async function fetchCounts() {
            try {
                const response = await fetch('/api/sidebar-counts');
                if (!response.ok) throw new Error('Network response was not ok');
                const data = await response.json();

                updateBadge('Pesan Masuk', data.messages);
                updateBadge('Pendaftar PPDB', data.ppdb);

            } catch (error) {
                console.warn('Realtime Sidebar Error:', error.message);
            }
        }

        function updateBadge(menuLabel, count) {
            // Target semua item sidebar
            // Filament v3 classes: fi-sidebar-item-button, fi-sidebar-item-label
            const buttons = document.querySelectorAll('.fi-sidebar-item-button');

            buttons.forEach(btn => {
                const labelEl = btn.querySelector('.fi-sidebar-item-label');
                if (!labelEl) return;

                // Jika label sesuai
                if (labelEl.textContent.trim().includes(menuLabel)) {
                    // Cari badge existing
                    let badgeContainer = btn.querySelector('.fi-badge');

                    if (count > 0) {
                        if (badgeContainer) {
                            // Update existing badge
                            const countSpan = badgeContainer.querySelector('span'); // usually nested
                            if (countSpan) countSpan.textContent = count;
                            else badgeContainer.textContent = count;

                            // Tambah pulse animation
                            badgeContainer.style.animation = 'badge-pulse 1.5s infinite';
                        } else {
                            // Jika badge belum ada, ini agak sulit di Filament karena struktur kompleks.
                            // TAPI bisa kita inject manual.
                            // Filament Badge HTML Structure simplified:
                            const badgeHtml = `
                                <div class="fi-badge fi-color-custom fi-size-sm flex items-center justify-center gap-x-1 rounded-md px-2 py-0.5 text-xs font-medium bg-red-50 text-red-600 dark:bg-red-400/10 dark:text-red-400 ring-1 ring-inset ring-red-600/10 dark:ring-red-400/20" style="margin-left: auto;">
                                    <span style="font-weight:bold;">${count}</span>
                                </div>
                            `;
                            // Append sebelum icon chevron (jika ada) atau di akhir button content
                            btn.insertAdjacentHTML('beforeend', badgeHtml);
                        }
                    } else {
                        // Jika count 0, sembunyikan badge
                        if (badgeContainer) {
                            badgeContainer.style.display = 'none';
                        }
                    }
                }
            });
        }

        // Start Polling
        fetchCounts(); // First run immediately
        setInterval(fetchCounts, UPDATE_INTERVAL);
    });
</script>