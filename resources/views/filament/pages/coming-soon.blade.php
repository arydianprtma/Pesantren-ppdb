<x-filament-panels::page>
    {{-- Container Menggunakan Inline Flexbox untuk menjamin Rata Tengah --}}
    <div style="
        display: flex; 
        flex-direction: column; 
        align-items: center; 
        justify-content: center; 
        min-height: 60vh; 
        text-align: center; 
        padding: 20px;
    ">

        {{-- Decorative Icon Wrapper --}}
        <div style="
            background-color: #ecfdf5; 
            border-radius: 9999px; 
            padding: 40px; 
            margin-bottom: 24px; 
            display: inline-flex;
            border: 1px solid #d1fae5;
        ">
            {{-- Menggunakan ikon jam/waktu yang lebih relevan untuk 'Coming Soon' --}}
            <x-heroicon-o-clock style="width: 64px; height: 64px; color: #059669;" />
        </div>

        {{-- Subtitle "COMING SOON" --}}
        <h2 style="
            font-size: 24px; 
            font-weight: 700; 
            color: #1f2937; 
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 2px;
        ">
            Coming Soon
        </h2>

        {{-- Description --}}
        <p style="
            font-size: 16px; 
            color: #6b7280; 
            max-width: 480px; 
            line-height: 1.6; 
            margin-bottom: 32px;
        ">
            Modul <strong>{{ $this->getTitle() }}</strong> saat ini sedang dalam tahap pengembangan oleh Developer.
            Fitur ini akan segera tersedia untuk digunakan.
        </p>

        {{-- Action Button --}}
        <div style="margin-top: 10px;">
            <x-filament::button tag="a" href="/portal" size="lg" color="success">
                Kembali ke Dashboard
            </x-filament::button>
        </div>

    </div>
</x-filament-panels::page>