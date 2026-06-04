<!-- Background Gradient Overlay (Placed fixed on the entire screen) -->
<div class="fixed inset-0 bg-slate-950 overflow-hidden z-0 pointer-events-none">
    <div class="absolute -top-[20%] -left-[10%] w-[600px] h-[600px] md:w-[800px] md:h-[800px] bg-emerald-500/10 rounded-full blur-[130px] animate-pulse" style="animation-duration: 8s;"></div>
    <div class="absolute -bottom-[20%] -right-[10%] w-[600px] h-[600px] md:w-[800px] md:h-[800px] bg-teal-500/10 rounded-full blur-[130px] animate-pulse" style="animation-duration: 12s;"></div>
    <div class="absolute top-[30%] left-[20%] w-[350px] h-[350px] bg-emerald-600/5 rounded-full blur-[100px] animate-bounce" style="animation-duration: 25s;"></div>
</div>

<!-- Inner Page Content -->
<div class="relative z-10 w-full flex flex-col items-center">
    <!-- Logo and Heading -->
    <div class="mb-8 flex flex-col items-center text-center w-full">
        <div class="relative mb-4 group">
            <div class="absolute inset-0 bg-emerald-500/20 rounded-full blur-xl group-hover:bg-emerald-500/30 transition duration-500"></div>
            <img src="{{ asset('logo_pondok.png') }}" class="relative h-20 w-auto drop-shadow-[0_0_10px_rgba(16,185,129,0.3)] animate-pulse" style="animation-duration: 3s;" alt="Logo Pesantren">
        </div>
        <h2 class="text-2xl font-bold text-white tracking-wide">Pesantren Riyadussalikin</h2>
        <p class="text-emerald-400 font-medium text-xs tracking-wider uppercase mt-1">Portal Administrasi PPDB</p>
    </div>

    <!-- Form -->
    <div class="w-full">
        {{ $this->content }}
    </div>
</div>

<style>
    /* Styling for the outer Filament Simple Layout */
    .fi-simple-layout {
        background-color: #020617 !important; /* slate-950 */
        min-height: 100vh !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: center !important;
        align-items: center !important;
        padding: 1.5rem !important;
    }

    .fi-simple-main-ctn {
        background-color: transparent !important;
        border: none !important;
        box-shadow: none !important;
        ring: none !important;
        width: 100% !important;
        display: flex !important;
        justify-content: center !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    /* Style the main element as the glassmorphic card container */
    .fi-simple-main {
        background-color: rgba(255, 255, 255, 0.05) !important;
        backdrop-filter: blur(20px) !important;
        -webkit-backdrop-filter: blur(20px) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        border-radius: 24px !important;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5) !important;
        padding: 2.5rem 2rem !important;
        max-width: 440px !important;
        width: 100% !important;
        margin: 0 auto !important;
    }

    .fi-simple-page {
        background-color: transparent !important;
        border: none !important;
        box-shadow: none !important;
        padding: 0 !important;
        width: 100% !important;
    }

    .fi-simple-page-content {
        padding: 0 !important;
        width: 100% !important;
    }

    /* Hide default Filament branding, headers and footer */
    .fi-simple-header,
    .fi-simple-header-ctn,
    .fi-simple-page-content > header,
    .fi-simple-layout > footer {
        display: none !important;
    }
    
    /* Force body background matching theme */
    body {
        background-color: #020617 !important;
    }
    
    /* Form labels styling (fixed correct selector) */
    .fi-fo-field-wrp-label span {
        color: #cbd5e1 !important; /* slate-300 */
        font-weight: 500 !important;
        font-size: 0.85rem !important;
    }

    /* Input fields wrapper styling */
    .fi-input-wrp {
        background-color: rgba(255, 255, 255, 0.02) !important;
        border: 1px solid rgba(255, 255, 255, 0.08) !important;
        box-shadow: none !important;
        border-radius: 12px !important;
        transition: all 0.3s ease !important;
    }
    .fi-input-wrp:focus-within {
        background-color: rgba(255, 255, 255, 0.05) !important;
        border-color: #10b981 !important; /* Emerald-500 */
        box-shadow: 0 0 12px rgba(16, 185, 129, 0.15) !important;
    }

    /* Input text color and placeholder */
    .fi-input {
        color: #ffffff !important;
        font-size: 0.9rem !important;
    }
    .fi-input::placeholder {
        color: #94a3b8 !important; /* slate-400 - perfectly visible */
        opacity: 0.6 !important;
    }

    /* Eye Icon (Show/Hide Password) & Checkbox styling */
    .fi-input-wrp button, 
    .fi-input-wrp svg {
        color: #94a3b8 !important; /* slate-400 */
    }
    
    /* Remember me checkbox and links */
    .fi-checkbox {
        border: 1px solid rgba(255, 255, 255, 0.15) !important;
        background-color: rgba(0, 0, 0, 0.3) !important;
        border-radius: 4px !important;
    }
    .fi-checkbox:checked {
        background-color: #10b981 !important;
        border-color: #10b981 !important;
    }
    
    /* Links text (e.g. Forgot Password) */
    .fi-link {
        color: #34d399 !important; /* Emerald-400 */
        font-size: 0.825rem !important;
        font-weight: 500 !important;
        transition: color 0.2s ease !important;
    }
    .fi-link:hover {
        color: #6ee7b7 !important; /* Emerald-300 */
        text-decoration: underline !important;
    }

    /* Submit Button Styling */
    .fi-btn {
        background-color: #10b981 !important; /* Emerald-500 */
        color: #ffffff !important;
        border-radius: 12px !important;
        font-weight: 600 !important;
        padding: 10px 16px !important;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2) !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }
    .fi-btn:hover {
        background-color: #059669 !important; /* Emerald-600 */
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.35) !important;
        transform: translateY(-1.5px) !important;
    }
    .fi-btn:active {
        transform: translateY(0px) !important;
    }
</style>
