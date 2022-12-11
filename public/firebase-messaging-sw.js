/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({
    apiKey: "AIzaSyD-8_ImCOLUYVSa0hqok6JNLPF_qwZc7Zo",
    authDomain: "laravel-push-notificatio-86783.firebaseapp.com",
    databaseURL: "laravel-push-notificatio-86783.firebaseio.com",
    projectId: "laravel-push-notificatio-86783",
    storageBucket: "laravel-push-notificatio-86783.appspot.com",
    messagingSenderId: "83366480080",
    appId: "1:83366480080:web:87955c85b726ff6c6e76d5",
    measurementId: "G-LKG5WQSNCB"
});

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
    console.log("Message received:",payload)
    /* Customize notification here */
    const notificationTitle = "Background Message Title";
    const notificationOptions = {
        body: "Background Message body.",
    };

    return self.registration.showNotification(
        notificationTitle,
        notificationOptions,
    );
});
