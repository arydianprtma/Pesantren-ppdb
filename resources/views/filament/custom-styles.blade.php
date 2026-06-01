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
    @media (max-width: 768px) {
        .fi-topbar-header {
            padding-left: 0.75rem !important;
            padding-right: 0.75rem !important;
            gap: 0.75rem !important;
        }

        /* Styling for the Global Search input on mobile */
        .fi-global-search input,
        .fi-topbar-header input[type="search"] {
            border-radius: 9999px !important; /* Pill style */
            border: 1px solid rgba(16, 185, 129, 0.3) !important; /* Subtle emerald border */
            background-color: rgba(255, 255, 255, 0.08) !important; /* Light transparent background */
            font-size: 0.85rem !important;
            height: 2.25rem !important;
            padding-left: 2.5rem !important;
            color: #ffffff !important;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.1) !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }

        /* Focus state for search bar */
        .fi-global-search input:focus,
        .fi-topbar-header input[type="search"]:focus {
            border-color: #10b981 !important;
            background-color: rgba(255, 255, 255, 0.15) !important;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2), inset 0 2px 4px rgba(0,0,0,0.05) !important;
        }

        /* Adjust placeholder visibility on dark search background */
        .fi-global-search input::placeholder,
        .fi-topbar-header input[type="search"]::placeholder {
            color: rgba(255, 255, 255, 0.4) !important;
        }

        /* Hamburger menu and user menu icons spacing */
        .fi-topbar-header nav {
            gap: 0.75rem !important;
        }
    }
</style>
