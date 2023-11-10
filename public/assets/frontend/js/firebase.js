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
firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();

function initFirebaseMessagingRegistration() {
    messaging.requestPermission().then(function() {
        return messaging.getToken();
    }).then(function(token) {

        let url = "{{ route('subscribe') }}";
        let data = {
            _method: "PATCH",
            token: token,
            _token: "{{ csrf_token() }}"
        };

        $.post(url, data, function(data) {
            console.log(data);
        });

    }).catch(function(err) {
        console.log(`Token Error :: ${err}`);
    });
}

initFirebaseMessagingRegistration();

messaging.onMessage(function(payload) {
    const title = payload.notification.title;
    const options = {
        body: payload.notification.body,
        icon: payload.notification.icon,
    };
    new Notification(title, options);
});