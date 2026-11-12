@if (config('broadcasting.default') === 'reverb')
<!-- Load Pusher and Laravel Echo locally -->
<script data-navigate-once src="{{ asset('js/pusher.min.js') }}"></script>
<script data-navigate-once src="{{ asset('js/echo.iife.js') }}"></script>
<script data-navigate-once>
    (function() {
        try {
            window.Pusher = Pusher;
            
            const reverbKey = "{{ env('VITE_REVERB_APP_KEY') ?? config('broadcasting.connections.reverb.key') ?? env('REVERB_APP_KEY') }}";
            const reverbHost = "{{ env('VITE_REVERB_HOST') ?? config('broadcasting.connections.reverb.options.host') ?? env('REVERB_HOST') }}";
            const reverbPort = "{{ env('VITE_REVERB_PORT') ?? config('broadcasting.connections.reverb.options.port') ?? env('REVERB_PORT') ?? 80 }}";
            const reverbScheme = "{{ env('VITE_REVERB_SCHEME') ?? config('broadcasting.connections.reverb.options.scheme') ?? env('REVERB_SCHEME') ?? 'https' }}";
            
            if (reverbKey && reverbHost) {
                const EchoConstructor = window.Echo.default || window.Echo;
                window.Echo = new EchoConstructor({
                    broadcaster: 'reverb',
                    key: reverbKey,
                    wsHost: reverbHost,
                    wsPort: reverbPort,
                    wssPort: reverbPort,
                    forceTLS: reverbScheme === 'https',
                    enabledTransports: ['ws', 'wss'],
                });
            } else {
                console.warn("Laravel Echo could not be initialized: Reverb credentials missing.");
            }
        } catch (e) {
            console.error("Failed to initialize Laravel Echo:", e);
        }
    })();
</script>
@endif
