// Scripts for firebase and firebase messaging
importScripts("https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/8.10.1/firebase-messaging.js");

const firebaseConfig = {
    apiKey: "AIzaSyB3UbArxJvs-eDcnq-dG5vk438-1kcx4jI",
    authDomain: "notif-29ba1.firebaseapp.com",
    databaseURL: "https://notif-29ba1.firebaseio.com",
    projectId: "notif-29ba1",
    storageBucket: "notif-29ba1.appspot.com",
    messagingSenderId: "528841843805",
    appId: "1:528841843805:web:b6a4adfc2bfb3b5765d9b4",
    measurementId: "G-XD29THY8S3"
  };

const app = firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging();


messaging.onBackgroundMessage(function (payload) {
  console.log("Received background message ", payload);
  self.registration.update();
  // Customize notification here
  if (!payload.notification && payload.data.title) {
    const notificationTitle = payload.data.title;

    // We have to convert message from firebase messaging to Web notification
    // All what is not body so, we have to added it into data.data
    self.registration.showNotification(notificationTitle, webOptions);
  }
});