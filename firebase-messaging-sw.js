importScripts("https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/8.10.0/firebase-messaging.js",
);
// For an optimal experience using Cloud Messaging, also add the Firebase SDK for Analytics.
importScripts("https://www.gstatic.com/firebasejs/8.10.0/firebase-analytics.js",
);

// Initialize the Firebase app in the service worker by passing in the
// messagingSenderId.
firebase.initializeApp({
    apiKey: "AIzaSyAWZZkXXuTHAyNqO2EHqi5nudL40exTmmc",
    authDomain: "uniq-notifications-9891c.firebaseapp.com",
    projectId: "uniq-notifications-9891c",
    storageBucket: "uniq-notifications-9891c.appspot.com",
    messagingSenderId: "426474366022",
    appId: "1:426474366022:web:0a94e98859fedd92bd9647",
    measurementId: "G-9QGWSEL82D"
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload,
    );
    // Customize notification here
    const notificationTitle = "Background Message Title";
    const notificationOptions = {
        body: "Background Message body.",
        icon: "/itwonders-web-logo.png",
    };

    return self.registration.showNotification(
        notificationTitle,
        notificationOptions,
    );
});