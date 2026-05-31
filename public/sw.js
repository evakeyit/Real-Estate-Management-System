const CACHE_NAME = 'peace-realty-v2';
const STATIC_ASSETS = [
    '/manifest.json',
    '/icons/icon.svg',
];

self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then((cache) => cache.addAll(STATIC_ASSETS))
            .then(() => self.skipWaiting())
    );
});

self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((keys) =>
            Promise.all(keys.filter((key) => key !== CACHE_NAME).map((key) => caches.delete(key)))
        ).then(() => self.clients.claim())
    );
});

self.addEventListener('fetch', (event) => {
    if (event.request.method !== 'GET') {
        return;
    }

    const accept = event.request.headers.get('accept') || '';
    const isHtmlRequest = event.request.mode === 'navigate' || accept.includes('text/html');

    // HTML pages depend on auth/session state — always fetch from the network.
    if (isHtmlRequest) {
        event.respondWith(fetch(event.request));
        return;
    }

    const url = new URL(event.request.url);
    const isStaticAsset = url.pathname.startsWith('/build/')
        || STATIC_ASSETS.includes(url.pathname);

    if (!isStaticAsset) {
        return;
    }

    event.respondWith(
        caches.match(event.request).then((cached) =>
            fetch(event.request)
                .then((response) => {
                    if (response && response.status === 200) {
                        const clone = response.clone();
                        caches.open(CACHE_NAME).then((cache) => cache.put(event.request, clone));
                    }
                    return response;
                })
                .catch(() => cached)
        )
    );
});
