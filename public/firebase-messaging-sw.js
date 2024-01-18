importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');


firebase.initializeApp({
  apiKey: "AIzaSyCHEcDVmlF_ni0fzzg6f4SULNeZGVfY1Ns",
  authDomain: "hybrid-chariot-348003.firebaseapp.com",
  projectId: "hybrid-chariot-348003",
  storageBucket: "hybrid-chariot-348003.appspot.com",
  messagingSenderId: "623989308125",
  appId: "1:623989308125:web:0615f108d18e5e1fceb934",
  measurementId: "G-W3HX3FLNHS"
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
      icon: '/firebase-logo.png',
      action: payload.data.click_action,
      data : {url: payload.data.click_action}
    };
    toOpenUrl = payload.data.click_action
    // notificationHandled = true;
    self.registration.showNotification(notificationTitle, notificationOptions);
});

self.addEventListener('notificationclick', function (event) {
    event.notification.close(); // Menutup notifikasi yang dipicu klik
    var urlToOpen = event.notification.data.url; 
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


