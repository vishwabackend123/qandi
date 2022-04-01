<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 Custom Error Page Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        .btn.btn-backtopage {
        background-color: #e9e9e9;
        min-width: 180px;
        border: 0;
        font-size: 14px;
        padding: 10px;
        font-weight: 600;
        box-shadow: none!important;
    }
    </style>
</head>
<body>
    <div style="padding:20px 20px 10px;"> <img  src="{{URL::asset('public/images_new/QI_Logo.gif')}}" style="width: 50px;"> </div>
    <div class="error-page text-center">
        <img  src="{{URL::asset('public/after_login/new_ui/images/404-image.jpg')}}" style="max-width:400px;width:100%;">
        <div class="text-center" style="margin-top: -40px;">
            <p style="color: rgba(35,31,32,0.5);font-size: 18px;font-weight: 500;margin-bottom: 25px;">PAGE NOT FOUND</p>
            <a href="{{url('/dashboard')}}" class="btn btn-backtopage">Back To Dashboard</a>
        </div>
    </div>
</body>
</html>