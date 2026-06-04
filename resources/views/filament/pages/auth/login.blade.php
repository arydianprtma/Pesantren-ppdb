<div>
    <!-- Background Gradient Overlay (Placed fixed on the entire screen) -->
    <div style="background-color: #020617 !important; position: fixed; inset: 0; overflow: hidden; z-index: 0; pointer-events: none;">
        <div class="bg-circle-1"></div>
        <div class="bg-circle-2"></div>
    </div>

    <!-- Inner Page Content -->
    <div style="position: relative; z-index: 10; width: 100%; display: flex; flex-direction: column; align-items: center;">
        <!-- Logo and Heading -->
        <div class="logo-wrapper">
            <div style="position: relative; margin-bottom: 1rem;">
                <div style="position: absolute; inset: -10px; background: rgba(16, 185, 129, 0.15); border-radius: 50%; filter: blur(20px);"></div>
                <img src="{{ asset('logo_pondok.png') }}" class="custom-logo" alt="Logo Pesantren">
            </div>
            <h2 class="custom-title">Pesantren Riyadussalikin</h2>
            <p class="custom-subtitle">Portal Administrasi PPDB</p>
        </div>

        <!-- Form -->
        <div style="width: 100%;">
            {{ $this->content }}
        </div>
    </div>

    <style>
        /* Background Elements */
        .bg-circle-1 {
            position: absolute;
            top: -150px;
            left: -100px;
            width: 600px;
            height: 600px;
            background: rgba(16, 185, 129, 0.07);
            border-radius: 50%;
            filter: blur(120px);
            pointer-events: none;
        }
        .bg-circle-2 {
            position: absolute;
            bottom: -150px;
            right: -100px;
            width: 600px;
            height: 600px;
            background: rgba(20, 184, 166, 0.07);
            border-radius: 50%;
            filter: blur(120px);
            pointer-events: none;
        }

        /* Custom Logo and Header */
        .logo-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-bottom: 1.5rem;
            width: 100%;
        }
        .custom-logo {
            height: 90px !important;
            width: auto !important;
            display: block !important;
            margin: 0 auto !important;
            filter: drop-shadow(0 0 12px rgba(16, 185, 129, 0.4)) !important;
        }
        .custom-title {
            color: #ffffff !important;
            font-size: 1.5rem !important;
            font-weight: 700 !important;
            letter-spacing: 0.025em !important;
            margin-top: 0.75rem !important;
            margin-bottom: 0px !important;
            font-family: 'Poppins', sans-serif !important;
        }
        .custom-subtitle {
            color: #34d399 !important;
            font-size: 0.75rem !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.1em !important;
            margin-top: 0.25rem !important;
            margin-bottom: 0px !important;
            font-family: 'Poppins', sans-serif !important;
        }

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
        
        /* Form labels styling - target all possible selector combinations */
        .fi-fo-field-label-content,
        .fi-fo-field-label,
        .fi-fo-field-label span,
        .fi-checkbox-label,
        .fi-checkbox-label span,
        label,
        label span {
            color: #cbd5e1 !important; /* slate-300 */
            font-weight: 500 !important;
            font-size: 0.85rem !important;
        }

        .fi-fo-field-label-required-mark {
            color: #ef4444 !important; /* red-500 */
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
</div>
