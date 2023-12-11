importScripts('https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.10.1/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyB3UbArxJvs-eDcnq-dG5vk438-1kcx4jI",
    projectId: "notif-29ba1",
    messagingSenderId: "528841843805",
    appId: "1:528841843805:web:b6a4adfc2bfb3b5765d9b4"
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage((payload) => {
  console.log(
    '[firebase-messaging-sw.js] Received background ',
    payload
    );
    // Customize notification here
    const notificationTitle = payload.data.title;
    const notificationOptions = {
      title: payload.data.title,
      body: payload.data.body,
      icon: '/firebase-logo.png'
    };
    toOpenUrl = payload.data.click_action
    // notificationHandled = true;
    self.registration.showNotification(notificationTitle, notificationOptions);
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


