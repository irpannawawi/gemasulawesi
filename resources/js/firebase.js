import { initializeApp } from "firebase/app";
import { getMessaging, getToken, onMessage } from "firebase/messaging";

// Your web app's Firebase configuration
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

// Initialize Firebase
const app =initializeApp(firebaseConfig);
const messaging = getMessaging();

getToken(messaging, {vapidKey: "BHy_76o9PFjPojL5x3lwjnSWpiMuz7grdyX4w8l0OEv7f2DC4xmz3BAwpr0kBP-6Vihu6rQgrvFsNbzxWMAA_D0"})
.then(async (currentToken)=>{
    if (currentToken) {
        // Send the token to your server and update the UI if necessary
        let url = "https://gemasulawesi.test/subscribe";
        let data = {
            _method: "PATCH",
            token: currentToken,
            _token: csrf_token
        };

        $.post(url, data, function (data) {
            console.log(data);
        });
      } else {
        // Show permission request UI
        console.log('No registration token available. Request permission to generate one.');
        requestPermission();
      }

      await onMessage((payload) => {
        console.log(payload)
      }, e => {
        console.log(e)
      })
})


function requestPermission() {
    console.log('Requesting permission...');
    Notification.requestPermission().then((permission) => {
      if (permission === 'granted') {
        console.log('Notification permission granted.');
      }
    });
}

// function initFirebaseMessagingRegistration() {
//     messaging.requestPermission().then(function () {
//         return messaging.getToken();
//     }).then(function (token) {

//         let url = "{{ route('subscribe') }}";
//         let data = {
//             _method: "PATCH",
//             token: token,
//             _token: "{{ csrf_token() }}"
//         };

//         $.post(url, data, function (data) {
//             console.log(data);
//         });

//     }).catch(function (err) {
//         console.log(`Token Error :: ${err}`);
//     });
// }

// initFirebaseMessagingRegistration();
