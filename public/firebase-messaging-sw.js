importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
   
firebase.initializeApp({
    apiKey: "AIzaSyB3UbArxJvs-eDcnq-dG5vk438-1kcx4jI",
    projectId: "notif-29ba1",
    messagingSenderId: "528841843805",
    appId: "1:528841843805:web:b6a4adfc2bfb3b5765d9b4"
});
  
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({data:{title,body,icon}}) {
    return self.registration.showNotification(title,{body,icon});
});