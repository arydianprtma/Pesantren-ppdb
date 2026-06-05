<!-- Load Pusher and Laravel Echo from CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pusher/8.3.0/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.16.0/dist/echo.iife.js"></script>
<script>
    (function() {
        try {
            window.Pusher = Pusher;
            
            const reverbKey = "{{ env('VITE_REVERB_APP_KEY') ?? config('broadcasting.connections.reverb.key') ?? env('REVERB_APP_KEY') }}";
            const reverbHost = "{{ env('VITE_REVERB_HOST') ?? config('broadcasting.connections.reverb.options.host') ?? env('REVERB_HOST') }}";
            const reverbPort = "{{ env('VITE_REVERB_PORT') ?? config('broadcasting.connections.reverb.options.port') ?? env('REVERB_PORT') ?? 80 }}";
            const reverbScheme = "{{ env('VITE_REVERB_SCHEME') ?? config('broadcasting.connections.reverb.options.scheme') ?? env('REVERB_SCHEME') ?? 'https' }}";
            
            if (reverbKey && reverbHost) {
                window.Echo = new window.Echo({
                    broadcaster: 'reverb',
                    key: reverbKey,
                    wsHost: reverbHost,
                    wsPort: reverbPort,
                    wssPort: reverbPort,
                    forceTLS: reverbScheme === 'https',
                    enabledTransports: ['ws', 'wss'],
                });
                console.log("Laravel Echo initialized successfully with Reverb!");
            } else {
                console.warn("Laravel Echo could not be initialized: Reverb credentials missing.");
            }
        } catch (e) {
            console.error("Failed to initialize Laravel Echo:", e);
        }
    })();
</script>
