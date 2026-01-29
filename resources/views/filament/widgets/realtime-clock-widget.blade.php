<x-filament-widgets::widget class="col-span-full">
    <div 
        x-data="{ 
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
        }"
        style="
            background: linear-gradient(135deg, #059669 0%, #0d9488 100%);
            border-radius: 0.75rem;
            padding: 2rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            color: white;
            position: relative;
            overflow: hidden;
        "
    >
        <!-- Background Decor (Manual CSS) -->
        <div style="position: absolute; top: -2.5rem; right: -2.5rem; width: 16rem; height: 16rem; border-radius: 9999px; background: white; opacity: 0.05; filter: blur(40px);"></div>
        <div style="position: absolute; bottom: -2.5rem; left: -2.5rem; width: 16rem; height: 16rem; border-radius: 9999px; background: white; opacity: 0.05; filter: blur(40px);"></div>

        <div style="position: relative; z-index: 10; display: flex; flex-direction: column; gap: 1.5rem;">
            <!-- Gunakan media query helper dari tailwind kalau bisa, tapi fallback ke flex-wrap -->
            <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 1.5rem;">
                
                <!-- Greeting Section -->
                <div>
                    <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.5rem;">
                        <div style="padding: 0.5rem; background-color: rgba(255,255,255,0.2); border-radius: 0.5rem;">
                            <!-- SVG dengan Explicit Size style -->
                            <svg style="width: 24px; height: 24px; color: #ecfdf5;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                        </div>
                        <span style="color: #d1fae5; font-weight: 500; text-transform: uppercase; font-size: 0.875rem; letter-spacing: 0.05em;">Dashboard Admin</span>
                    </div>
                    
                    <h2 style="font-size: 1.875rem; font-weight: 700; margin-bottom: 0.25rem;">
                        <span x-text="greeting"></span>, {{ auth()->user()->name }}
                    </h2>
                    <p style="color: #d1fae5; font-size: 1.125rem; opacity: 0.9;">
                        Selamat datang kembali di Portal Pesantren.
                    </p>
                </div>

                <!-- Time Section -->
                <div style="display: flex; flex-direction: column; align-items: flex-end;">
                    <div style="background-color: rgba(0,0,0,0.1); border-radius: 1rem; padding: 1rem; border: 1px solid rgba(255,255,255,0.1);">
                        <div x-text="time" style="font-family: monospace; font-size: 3rem; font-weight: 700; letter-spacing: 0.05em; line-height: 1; margin-bottom: 0.25rem;">
                            00:00:00
                        </div>
                        <div x-text="date" style="text-align: right; color: #d1fae5; font-weight: 500;">
                            Senin, 1 Januari 2024
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-filament-widgets::widget>