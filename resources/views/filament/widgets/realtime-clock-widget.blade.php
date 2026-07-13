<x-filament-widgets::widget class="col-span-full">
    <div x-data="{ 
            time: '',
            date: '',
            greeting: '',
            init() {
                this.updateTime();
                setInterval(() => this.updateTime(), 1000);
                this.setGreeting();
            },
            updateTime() {
                const now = new Date();
                this.time = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' }).replace(/\./g, ':');
                this.date = now.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
            },
            setGreeting() {
                const hour = new Date().getHours();
                if (hour < 12) this.greeting = 'Selamat Pagi';
                else if (hour < 15) this.greeting = 'Selamat Siang';
                else if (hour < 18) this.greeting = 'Selamat Sore';
                else this.greeting = 'Selamat Malam';
            }
        }" style="
            background: linear-gradient(135deg, #059669 0%, #047857 50%, #064e3b 100%);
            border-radius: 1.25rem;
            padding: 2.25rem 2.5rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            color: white;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        "
        onmouseover="this.style.boxShadow='0 25px 30px -5px rgba(4, 120, 87, 0.25), 0 10px 15px -5px rgba(0, 0, 0, 0.05)';"
        onmouseout="this.style.boxShadow='0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)';">
        <!-- Decorative Glow Orbs -->
        <div
            style="position: absolute; top: -4rem; right: -4rem; width: 20rem; height: 20rem; border-radius: 9999px; background: radial-gradient(circle, rgba(16,185,129,0.3) 0%, rgba(255,255,255,0) 70%); opacity: 0.6; filter: blur(50px); pointer-events: none;">
        </div>
        <div
            style="position: absolute; bottom: -4rem; left: -2rem; width: 16rem; height: 16rem; border-radius: 9999px; background: radial-gradient(circle, rgba(13,148,136,0.3) 0%, rgba(255,255,255,0) 70%); opacity: 0.5; filter: blur(40px); pointer-events: none;">
        </div>

        <div style="position: relative; z-index: 10;">
            <div
                style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 2rem;">

                <!-- Greeting Section -->
                <div style="flex: 1; min-width: 280px;">
                    <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.875rem;">
                        <div
                            style="padding: 0.625rem; background-color: rgba(255,255,255,0.12); border-radius: 0.75rem; border: 1px solid rgba(255,255,255,0.15); backdrop-filter: blur(4px);">
                            <svg style="width: 20px; height: 20px; color: #a7f3d0;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                                </path>
                            </svg>
                        </div>
                        <span
                            style="color: #a7f3d0; font-weight: 600; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.1em;">Dashboard
                            Admin SPMB</span>
                    </div>

                    <h2
                        style="font-size: 2.25rem; font-weight: 800; letter-spacing: -0.02em; margin-bottom: 0.5rem; line-height: 1.2;">
                        <span x-text="greeting"
                            style="background: linear-gradient(to right, #ffffff, #d1fae5); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></span>,
                        {{ auth()->user()->name }}
                    </h2>
                    <p style="color: #e6fcf5; font-size: 1.05rem; font-weight: 400; opacity: 0.9; max-width: 480px;">

                    </p>Selamat datang kembali. Kelola website, data pendaftar, dan proses penerimaan santri baru dengan
                    mudah, cepat, dan terorganisir.
                </div>

                <!-- Clock Section with Glassmorphic Card -->
                <div style="display: flex; flex-direction: column; align-items: flex-end; min-width: 220px;">
                    <div style="
                        background: rgba(255, 255, 255, 0.08); 
                        border-radius: 1.25rem; 
                        padding: 1.25rem 1.75rem; 
                        border: 1px solid rgba(255, 255, 255, 0.15); 
                        box-shadow: 0 8px 32px 0 rgba(4, 120, 87, 0.15); 
                        backdrop-filter: blur(12px);
                        -webkit-backdrop-filter: blur(12px);
                        transition: border-color 0.3s ease;
                    " onmouseover="this.style.borderColor='rgba(255, 255, 255, 0.35)';"
                        onmouseout="this.style.borderColor='rgba(255, 255, 255, 0.15)';">
                        <div x-text="time"
                            style="font-family: monospace; font-size: 3.25rem; font-weight: 800; letter-spacing: 0.05em; line-height: 1; margin-bottom: 0.375rem; text-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                            00:00:00
                        </div>
                        <div x-text="date"
                            style="text-align: right; color: #a7f3d0; font-size: 0.9rem; font-weight: 600; letter-spacing: 0.02em;">
                            Senin, 1 Januari 2024
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-filament-widgets::widget>