<script>
    document.addEventListener('DOMContentLoaded', () => {
        const UPDATE_INTERVAL = 5000; // Cek setiap 5 detik agar tidak terlalu membebani

        async function fetchCounts() {
            try {
                // Gunakan path absolut agar tidak terpengaruh prefix URL panel admin
                const response = await fetch(window.location.origin + '/api/sidebar-counts');
                if (!response.ok) throw new Error('Network response was not ok');
                const data = await response.json();

                updateBadge('Pendaftar SPMB', data.Spmb);

            } catch (error) {
                // Silently fail to avoid console clutter
            }
        }

        function updateBadge(menuLabel, count) {
            // Target semua item sidebar Filament v3
            const sidebarItems = document.querySelectorAll('.fi-sidebar-item');

            sidebarItems.forEach(item => {
                const labelEl = item.querySelector('.fi-sidebar-item-label');
                if (!labelEl) return;

                // Cek apakah teks label mengandung menuLabel (Case insensitive)
                if (labelEl.textContent.trim().toLowerCase().includes(menuLabel.toLowerCase())) {
                    let badgeContainer = item.querySelector('.fi-badge');

                    if (count > 0) {
                        if (badgeContainer) {
                            // Update angka jika badge sudah ada
                            const countSpan = badgeContainer.querySelector('span');
                            if (countSpan) {
                                if (countSpan.textContent != count) {
                                    countSpan.textContent = count;
                                    triggerPulse(badgeContainer);
                                }
                            } else {
                                if (badgeContainer.textContent != count) {
                                    badgeContainer.textContent = count;
                                    triggerPulse(badgeContainer);
                                }
                            }
                            badgeContainer.style.display = 'flex';
                        } else {
                            // Jika badge belum ada, inject HTML badge standar Filament V3
                            const badgeHtml = `
                                <div class="fi-badge fi-color-custom fi-size-sm flex items-center justify-center gap-x-1 rounded-md px-2 py-0.5 text-xs font-medium bg-emerald-50 text-emerald-600 dark:bg-emerald-400/10 dark:text-emerald-400 ring-1 ring-inset ring-emerald-600/10 dark:ring-emerald-400/20 shadow-sm" style="margin-left: auto;">
                                    <span>${count}</span>
                                </div>
                            `;
                            // Cari button/link di dalam item untuk menempelkan badge
                            const linkEl = item.querySelector('a, button');
                            if (linkEl) {
                                linkEl.insertAdjacentHTML('beforeend', badgeHtml);
                            }
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

        function triggerPulse(el) {
            el.style.transition = 'transform 0.2s ease-in-out';
            el.style.transform = 'scale(1.2)';
            setTimeout(() => {
                el.style.transform = 'scale(1)';
            }, 200);
        }

        // Jalankan polling
        fetchCounts();
        setInterval(fetchCounts, UPDATE_INTERVAL);

        // Tambahan: Refresh saat ada event notification dari Livewire
        const userId = "{{ auth()->id() ?? 0 }}";
        window.addEventListener('echo:private-App.Models.User.' + userId + ',.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', () => {
            setTimeout(fetchCounts, 1000);
        });
    });
</script>