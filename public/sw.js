const cacheName = "cache-v1";
const filesToCache = [
    "/",
    "/offline.html",
    "/assets/css/style.css",
    "/assets/css/auth.css",
    "/assets/css/dashboard.css",
    "/assets/js/script.js",
    "/assets/js/auth.js",
    "/assets/js/dashboard.js",
    "/assets/img/logo.png",
    "/assets/img/banner-profile.png",
    "/assets/img/banner-login.png",
    "/assets/img/no_connection.png",
    "/assets/vendors/bootstrap/css/bootstrap.css",
    "/assets/vendors/bootstrap/js/bootstrap.bundle.min.js",
    "/assets/vendors/boxicons/css/boxicons.min.css"
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
