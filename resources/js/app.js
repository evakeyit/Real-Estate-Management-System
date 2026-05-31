import './bootstrap';

if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js').then((registration) => {
            registration.update();
        }).catch(() => {
            // Service worker registration failed silently in unsupported contexts
        });
    });
}
