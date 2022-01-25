// Add Firebase products that you want to use
importScripts('https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.10.0/firebase-messaging.js');

// Firebase SDK
firebase.initializeApp({
    apiKey: "AIzaSyB1_yyExr-EfBlGgRxa1N04mlTgHY_pakU",
    authDomain: "uniq-notifications-prod.firebaseapp.com",
    projectId: "uniq-notifications-prod",
    storageBucket: "uniq-notifications-prod.appspot.com",
    messagingSenderId: "363979513693",
    appId: "1:363979513693:web:5bf971e8c21159e1ffd2b4",
    measurementId: "G-SQHCXXVZY7"
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
