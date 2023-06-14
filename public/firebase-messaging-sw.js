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
    apiKey: "AIzaSyDP1zHKbPt0yGG-dDaSujYUBqMx6s64-bk",
    authDomain: "club-malwa-1525267023422.firebaseapp.com",
    databaseURL: "https://club-malwa-1525267023422.firebaseio.com",
    projectId: "club-malwa-1525267023422",
    storageBucket: "club-malwa-1525267023422.appspot.com",
    messagingSenderId: "971097863024",
    appId: "1:971097863024:web:d2ac1a6d65d2e15c2895b5",
    measurementId: "G-HEQPHCVCFQ"
});

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();

messaging.onBackgroundMessage(function (payload) {
   
    /* Customize notification here */
    const notificationTitle = payload.notification.title;;
    const notificationOptions = {
        body: payload.notification.body,
        icon: payload.notification.icon,  
    };

    self.registration.showNotification(
        notificationTitle,
        notificationOptions,
    );
    
    
});