<style>
    /* Global Sidebar Styling */
    .fi-sidebar-item {
        transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1);
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
        font-size: 0.7rem;
        margin-top: 1.5rem;
        background: linear-gradient(to right, #ccc, transparent);
        -webkit-background-clip: text;
        color: transparent;
        /* Gradient Text Effect */
        font-weight: 800;
        opacity: 0.7;
    }
</style>