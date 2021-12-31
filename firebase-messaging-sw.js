// Add Firebase products that you want to use
importScripts('https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.10.0/firebase-messaging.js');

// Firebase SDK
firebase.initializeApp({
    apiKey: "AIzaSyAWZZkXXuTHAyNqO2EHqi5nudL40exTmmc",
    authDomain: "uniq-notifications-9891c.firebaseapp.com",
    projectId: "uniq-notifications-9891c",
    storageBucket: "uniq-notifications-9891c.appspot.com",
    messagingSenderId: "426474366022",
    appId: "1:426474366022:web:0a94e98859fedd92bd9647",
    measurementId: "G-9QGWSEL82D"
});

const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function (payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload,
    );
    const title = payload.data.title;

    const options = {
        body: payload.data.body,
        time: payload.data.time,
    };
    console.log("body",payload.data.body);
    return self.registration.showNotification(
        title,
        options,
    );
    
});
