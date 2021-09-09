// Add Firebase products that you want to use
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

// Firebase SDK
firebase.initializeApp({
   
    apiKey: "AIzaSyAXOEjCfj6qEKRi3Lm82j2DLMNIsXnJ0Nk",
    authDomain: "uniq-notifications.firebaseapp.com",
    databaseURL: 'https://uniq-notifications.firebaseio.com',
    projectId: "uniq-notifications",
    storageBucket: "uniq-notifications.appspot.com",
    messagingSenderId: "768896658565",
    appId: "1:768896658565:web:036b631c04c6d9c6280dec",
    measurementId: "G-8PJKZ9N25F"
});

const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function (payload) {
    console.log("Message has received : ", payload);
    const title = payload.data.title;
    
    const body = payload.data.body;
    const time = payload.data.time;
    const options = {
        body: payload.data.body,
        time: payload.data.time,
    };
    $('#recent_notify ').prepend($('<div class="d-flex flex-column bg-white mt-4 py-2 px-3 notify-block">' +
            '<p class="mb-0">' + title + '</p>' +
            '<span class="mb-2">' +
            '<i class="fa fa-star text-warning"></i>' +
            '<i class="fa fa-star text-warning"></i>' +
            '<i class="fa fa-star text-warning"></i>' +
            '<i class="fa fa-star text-light"></i>' +
            '<i class="fa fa-star text-light"></i>' +
            '</span>' +
            '<small>' + time + '</small>' +
            '</div>'));

    return self.registration.showNotification(
        title,
        options,
    );
});