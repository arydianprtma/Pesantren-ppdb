<style>
    /* Logo & Header Styling */
    .fi-sidebar-header {
        padding: 1.25rem 1rem !important;
        border-bottom: 1px solid rgba(16, 185, 129, 0.1);
        background: linear-gradient(180deg, rgba(16, 185, 129, 0.05) 0%, transparent 100%);
        margin-bottom: 0.5rem;
    }

    .fi-sidebar-header img {
        filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.15));
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .fi-sidebar-header:hover img {
        transform: scale(1.08) rotate(2deg);
        filter: drop-shadow(0 6px 12px rgba(16, 185, 129, 0.25));
    }

    /* Global Sidebar Styling */
    .fi-sidebar-item {
        transition: transform 0.10s cubic-bezier(0.4, 0, 0.2, 1);
        margin-bottom: 4px;
    }

    /* Hover Effect: Glassmorphism & Slight Shift */
    .fi-sidebar-item:hover .fi-sidebar-item-button {
        background-color: rgba(16, 185, 129, 0.08);
        /* Emerald hint */
        transform: translateX(4px);
        border-radius: 0.75rem;
    }

    /* Badge Animation: Pulse when count > 0 */
    @keyframes badge-pulse {
        0% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
        }

        /* Red pulse based on existing badged color if any */
        70% {
            transform: scale(1.1);
            box-shadow: 0 0 0 6px rgba(239, 68, 68, 0);
        }

        100% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
        }
    }

    /* Specific Badge Animation for Warning/Success colors can be targeted if needed */
    .fi-sidebar-badge span {
        transition: all 0.3s ease;
        font-weight: 700 !important;
    }

    /* Make active item stand out */
    .fi-sidebar-item-active .fi-sidebar-item-button {
        background: linear-gradient(90deg, rgba(16, 185, 129, 0.15) 0%, rgba(16, 185, 129, 0.05) 100%);
        border-right: 3px solid rgb(16, 185, 129);
        border-radius: 0.5rem 0 0 0.5rem;
    }

    /* Enhance Group Labels */
    .fi-sidebar-group-label {
        letter-spacing: 0.05em;
        text-transform: uppercase;
        font-size: 0.75rem;
        margin-top: 1.5rem;
        font-weight: 800;
        padding-left: 0.5rem;
        border-left: 3px solid rgba(16, 185, 129, 0.5);
        
        /* Gradient Text Effect - Darker for Light Mode Visibility */
        background: linear-gradient(to right, #374151, #6b7280); /* Gray-700 to Gray-500 */
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        color: transparent;
    }

    /* Dark mode adjustment for labels - Lighter for Dark Mode Visibility */
    .dark .fi-sidebar-group-label {
        background: linear-gradient(to right, #d1d5db, #9ca3af); /* Gray-300 to Gray-400 */
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
</style>