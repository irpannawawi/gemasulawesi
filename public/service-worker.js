// service-worker.js

self.addEventListener('install', function (event) {

});

self.addEventListener('fetch', function (event) {
    event.respondWith(
        caches.match(event.request).then(function (response) {
            return response || fetch(event.request);
        })
    );
});

self.addEventListener('notificationclick', function (event) {
    event.notification.close(); // Menutup notifikasi yang dipicu klik
    var urlToOpen = toOpenUrl; 
  
    event.waitUntil(
      clients.matchAll({
        type: 'window',
      })
      .then(function (windowClients) {
        for (var i = 0; i < windowClients.length; i++) {
          var client = windowClients[i];
          if (client.url === urlToOpen && 'focus' in client) {
            return client.focus();
          }
        }
  
        if (clients.openWindow) {
          return clients.openWindow(urlToOpen);
        }
      })
    );
  });
