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
            gap: 0.75rem !important;
        }

        /* Styling for the Global Search input on mobile - high specificity overrides */
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
            height: 2.35rem !important;
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

        /* Active micro-animations for triggers on tap */
        .fi-topbar-trigger:active,
        .fi-database-notifications-trigger:active,
        .fi-user-menu:active {
            transform: scale(0.92) !important;
            transition: transform 0.15s ease !important;
        }
    }
</style>

