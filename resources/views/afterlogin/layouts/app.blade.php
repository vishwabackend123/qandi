<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>UNIQ</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{URL::asset('public/images/favicon.ico')}}" type="{{URL::asset('public/image/x-icon')}}" />
    <script src="https://kit.fontawesome.com/5880030aeb.js" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/b2f98ca74c.js"></script>

    <link href="{{URL::asset('public/css/bootstrap.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="{{URL::asset('public/after_login/css/style.css')}}">
    <link href='{{URL::asset("public/after_login/css/style-slider.css")}}' rel='stylesheet' />

    <script src="{{URL::asset('public/after_login/js/touchslider.js')}}"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
    https://firebase.google.com/docs/web/setup#available-libraries -->
    <script>
        // Your web app's Firebase configuration
        /*  const firebaseConfig = {
             apiKey: "BA4Jhm824U8n2-c5HXWiLeCLSXWVwTOuixpQekWmqMDb6nmCOvE7uOo9dBRvNhjDrPPvZnH_iMEtZnkB1wFPWQ0",
             authDomain: "uniq-notifications.firebaseapp.com",
             projectId: "uniq-notifications",
             storageBucket: "uniq-notifications.appspot.com",
             messagingSenderId: "768896658565",
             appId: "1:768896658565:web:036b631c04c6d9c6280dec",
             measurementId: "G-8PJKZ9N25F"
         };
         // Initialize Firebase
         firebase.initializeApp(firebaseConfig);

         const messaging = firebase.messaging();

         function initFirebaseMessagingRegistration() {
             alert("hi");

             messaging.getToken({
                 vapidKey: 'BA4Jhm824U8n2-c5HXWiLeCLSXWVwTOuixpQekWmqMDb6nmCOvE7uOo9dBRvNhjDrPPvZnH_iMEtZnkB1wFPWQ0'
             }).then((currentToken) => {
                 if (currentToken) {
                     alert(currentToken);
                     $.post("https://api.uniqtoday.com/api/update_student_token", {
                         token: currentToken,
                         user_id: "{{Auth::user()->id}}"
                     });
                 } else {
                     alert('no');
                     // Show permission request UI
                     console.log('No registration token available. Request permission to generate one.');
                     // ...
                 }
             }).catch((err) => {
                 console.log('An error occurred while retrieving token. ', err);
                 // ...
             });
         }

         initFirebaseMessagingRegistration();

         messaging.onMessage(function({
             data: {
                 body,
                 title
             }
         }) {
             new Notification(title, {
                 body
             });
         }); */
        // Your web app's Firebase configuration
    </script>


    <style>
        #overlay {
            background: #ffffff;
            color: #666666;
            position: fixed;
            height: 100%;
            width: 100%;
            z-index: 5000;
            top: 0;
            left: 0;
            float: left;
            text-align: center;
            padding-top: 25%;
            opacity: .80;
        }



        .spinner {
            margin: 0 auto;
            height: 64px;
            width: 64px;
            animation: rotate 0.8s infinite linear;
            border: 5px solid firebrick;
            border-right-color: transparent;
            border-radius: 50%;
        }

        @keyframes rotate {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class="login-body-bg  h-100" id="main-body">

    <div id="overlay" style="display:none;">
        <div class="spinner"></div>
        <br />
        Loading...
    </div>
    @yield('content')


</body>

</html>