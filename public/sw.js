const cacheName = "cache-v1";
const filesToCache = [
    "/",
    "/offline.html",
    "/assets/img/*.png",
    "/assets/img/*.jpg",
    "/assets/css/style.css",
    "/assets/js/script.js",
    "/assets/images/no_connection.png",
    "/assets/vendors/bootstrap/css/bootstrap.css",
    "/assets/vendors/bootstrap/js/bootstrap.bundle.min.js",
    "/assets/vendors/boxicons/css/boxicons.min.css",
    "https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css",
    "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css",
    "https://cdn.jsdelivr.net/npm/typed.js@2.0.12"
];

// Preload cache saat service worker diinstal
self.addEventListener("install", function (event) {
    event.waitUntil(
        caches.open(cacheName).then(function (cache) {
            return cache.addAll(filesToCache.map(url => new Request(url, {credentials: 'include'})));
        })
    );
});

// Menghapus cache lama saat service worker diperbarui
self.addEventListener("activate", function (event) {
    event.waitUntil(
        caches.keys().then(function (keyList) {
            return Promise.all(
                keyList.map(function (key) {
                    if (key !== cacheName) {
                        return caches.delete(key);
                    }
                })
            );
        })
    );
});

// Fetch event: mencoba mengambil dari jaringan, jika gagal ambil dari cache
self.addEventListener("fetch", function (event) {
    if (event.request.method !== "GET") return;

    event.respondWith(
        fetch(event.request)
            .then(function (response) {
                return response;
            })
            .catch(function () {
                return caches.open(cacheName).then(function (cache) {
                    if (event.request.mode === "navigate") {
                        return cache.match("/offline.html");
                    }
                    return cache.match(event.request);
                });
            })
    );
});
