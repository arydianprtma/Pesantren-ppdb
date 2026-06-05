<!-- Load Pusher and Laravel Echo from CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pusher/8.3.0/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.16.0/dist/echo.iife.js"></script>
<script>
    (function() {
        try {
            window.Pusher = Pusher;
            
            const reverbKey = "{{ config('broadcasting.connections.reverb.key') ?? env('REVERB_APP_KEY') }}";
            const reverbHost = "{{ config('broadcasting.connections.reverb.options.host') ?? env('REVERB_HOST') }}";
            const reverbPort = "{{ config('broadcasting.connections.reverb.options.port') ?? env('REVERB_PORT') ?? 80 }}";
            const reverbScheme = "{{ config('broadcasting.connections.reverb.options.scheme') ?? env('REVERB_SCHEME') ?? 'https' }}";
            
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
