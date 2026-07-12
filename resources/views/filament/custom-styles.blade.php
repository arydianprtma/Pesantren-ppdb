<style>
    /* RichEditor - Make links appear green */
    .fi-fo-rich-editor .tiptap a,
    .tiptap a,
    .ProseMirror a {
        color: #059669 !important;
        text-decoration: underline !important;
    }

    .fi-fo-rich-editor .tiptap a:hover,
    .tiptap a:hover,
    .ProseMirror a:hover {
        color: #047857 !important;
    }

    /* Content preview links */
    .prose a {
        color: #059669 !important;
        text-decoration: underline !important;
    }

    .prose a:hover {
        color: #047857 !important;
    }

    /* Mobile Topbar & Global Search Improvements */
    @media (max-width: 1024px) {
        .fi-topbar-header {
            padding-left: 0.75rem !important;
            padding-right: 0.75rem !important;
            gap: 0.5rem !important;
        }

        /* Ensure hamburger, database notifications, and user menu triggers are clickable and positioned on top of search */
        .fi-topbar-trigger,
        .fi-topbar-database-notifications-btn,
        .fi-user-menu {
            z-index: 20 !important;
            position: relative !important;
            cursor: pointer !important;
        }

        .fi-topbar-trigger {
            padding: 0.5rem !important;
        }

        /* Prevent global search from overlapping other elements */
        html .fi-global-search,
        html.dark .fi-global-search {
            margin-left: 0.5rem !important;
            margin-right: 0.5rem !important;
            flex-grow: 1 !important;
            max-width: calc(100% - 7.5rem) !important;
            z-index: 10 !important;
            position: relative !important;
        }

        /* Remove default Filament outer search container styling (gray border, dark rectangle) */
        html .fi-global-search,
        html.dark .fi-global-search,
        html .fi-global-search > div,
        html.dark .fi-global-search > div,
        html .fi-global-search-field,
        html.dark .fi-global-search-field,
        html .fi-global-search-input-container,
        html.dark .fi-global-search-input-container {
            border: none !important;
            background: transparent !important;
            background-color: transparent !important;
            box-shadow: none !important;
            --tw-ring-color: transparent !important;
            --tw-ring-shadow: none !important;
            --tw-shadow: none !important;
            outline: none !important;
            ring: none !important;
        }

        /* Styling for the Global Search input on mobile - beautiful pill design */
        html .fi-global-search input,
        html .fi-topbar-header input[type="search"],
        html .fi-global-search-input,
        html.dark .fi-global-search input,
        html.dark .fi-topbar-header input[type="search"],
        html.dark .fi-global-search-input {
            border-radius: 9999px !important; /* Beautiful pill design */
            border: 1px solid rgba(16, 185, 129, 0.25) !important; /* Soft emerald accent border */
            background-color: rgba(243, 244, 246, 0.8) !important; /* Soft light grey in light mode */
            color: #1f2937 !important; /* Dark text in light mode */
            font-size: 0.85rem !important;
            height: 2.25rem !important;
            padding-left: 2.5rem !important;
            padding-right: 1rem !important;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.05) !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            backdrop-filter: blur(8px) !important;
            width: 100% !important;
        }

        /* Dark mode overrides for search input */
        html.dark .fi-global-search input,
        html.dark .fi-topbar-header input[type="search"],
        html.dark .fi-global-search-input {
            background-color: rgba(15, 23, 42, 0.5) !important; /* Slate 900 transparent background */
            border: 1px solid rgba(16, 185, 129, 0.35) !important;
            color: #f9fafb !important; /* White text */
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.2) !important;
        }

        /* Focus state for both modes */
        html .fi-global-search input:focus,
        html .fi-topbar-header input[type="search"]:focus,
        html .fi-global-search-input:focus,
        html.dark .fi-global-search input:focus,
        html.dark .fi-topbar-header input[type="search"]:focus,
        html.dark .fi-global-search-input:focus {
            border-color: rgb(16, 185, 129) !important; /* Glowing emerald */
            background-color: #ffffff !important;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.25), inset 0 1px 2px rgba(0,0,0,0.05) !important;
            outline: none !important;
        }

        html.dark .fi-global-search input:focus,
        html.dark .fi-topbar-header input[type="search"]:focus,
        html.dark .fi-global-search-input:focus {
            background-color: rgba(15, 23, 42, 0.75) !important;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.35), inset 0 1px 2px rgba(0,0,0,0.1) !important;
        }

        /* Adjust placeholder visibility on both light/dark backgrounds */
        html .fi-global-search input::placeholder,
        html .fi-topbar-header input[type="search"]::placeholder,
        html .fi-global-search-input::placeholder,
        html.dark .fi-global-search input::placeholder,
        html.dark .fi-topbar-header input[type="search"]::placeholder,
        html.dark .fi-global-search-input::placeholder {
            color: #9ca3af !important;
            opacity: 0.8 !important;
        }

        /* Hamburger menu and user menu icons spacing */
        .fi-topbar-header nav {
            gap: 0.75rem !important;
        }

        /* Spacing and placement of search icon inside input on mobile */
        .fi-global-search .absolute,
        .fi-global-search-input-container .absolute,
        .fi-global-search svg,
        .fi-global-search-input-container svg {
            color: rgba(16, 185, 129, 0.6) !important;
            transition: all 0.2s ease !important;
        }

        /* Active micro-animations for triggers on tap - target buttons only to avoid aborting dropdown item clicks */
        .fi-topbar-trigger:active,
        .fi-topbar-database-notifications-btn:active,
        .fi-user-menu-trigger:active {
            transform: scale(0.92) !important;
            transition: transform 0.15s ease !important;
        }
    }

    /* --- Premium Dashboard Enhancements --- */
    
    /* 1. Stats Cards Styling */
    .fi-wi-stats-overview-stat-card {
        border-radius: 1rem !important;
        border: 1px solid rgba(229, 231, 235, 0.7) !important;
        background-color: rgba(255, 255, 255, 0.75) !important;
        backdrop-filter: blur(12px) !important;
        -webkit-backdrop-filter: blur(12px) !important;
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1) !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03), 0 2px 4px -1px rgba(0, 0, 0, 0.02) !important;
    }

    html.dark .fi-wi-stats-overview-stat-card {
        border: 1px solid rgba(255, 255, 255, 0.06) !important;
        background-color: rgba(30, 41, 59, 0.6) !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
    }

    /* Stats Cards Hover Effect */
    .fi-wi-stats-overview-stat-card:hover {
        transform: translateY(-5px) !important;
        border-color: rgba(16, 185, 129, 0.45) !important;
        box-shadow: 0 20px 25px -5px rgba(16, 185, 129, 0.08), 0 10px 10px -5px rgba(0, 0, 0, 0.03) !important;
    }

    html.dark .fi-wi-stats-overview-stat-card:hover {
        border-color: rgba(16, 185, 129, 0.45) !important;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.25), 0 10px 10px -5px rgba(0, 0, 0, 0.15) !important;
    }

    /* 2. Table Widget Styling */
    .fi-ta-ctn {
        border-radius: 1.25rem !important;
        border: 1px solid rgba(229, 231, 235, 0.7) !important;
        background-color: rgba(255, 255, 255, 0.75) !important;
        backdrop-filter: blur(12px) !important;
        -webkit-backdrop-filter: blur(12px) !important;
        overflow: hidden !important;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.02) !important;
        transition: all 0.3s ease !important;
    }

    html.dark .fi-ta-ctn {
        border: 1px solid rgba(255, 255, 255, 0.06) !important;
        background-color: rgba(30, 41, 59, 0.6) !important;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.15) !important;
    }

    /* Clean spacing in table rows */
    .fi-ta-table th {
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        font-size: 0.75rem !important;
        letter-spacing: 0.05em !important;
    }

    .fi-ta-table td {
        padding-top: 1.125rem !important;
        padding-bottom: 1.125rem !important;
    }

    /* Ensure dropdown panels are always on top of all other elements to receive clicks/taps */
    .fi-dropdown-panel {
        z-index: 9999 !important;
    }

    /* ===== Slide-over: Checkbox List Scrollable Area ===== */
    /* Make only the options list scroll, while search bar and action buttons stay fixed */
    .fi-modal-slide-over .fi-fo-checkbox-list-options {
        max-height: calc(100vh - 320px) !important;
        overflow-y: auto !important;
        overflow-x: hidden !important;
        display: grid !important;
        grid-template-columns: repeat(1, minmax(0, 1fr)) !important;
        padding-left: 2px !important;
    }
</style>

