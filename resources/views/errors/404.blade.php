<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 Custom Error Page Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        .btn.btn-backtopage {font-weight: 500;background-color: #00bdff;min-width: 190px;border-radius: 30px;font-size: 14px;padding: 12px;box-shadow: none!important;color:#fff;}
    </style>
</head>
<body>
    <div style="padding:20px;"> <img  src="{{URL::asset('public/images_new/QI_Logo.gif')}}" style="width: 50px;"> </div>
    <div class="error-page text-center" style="padding: 0 15px;">
        <img  src="{{URL::asset('public/after_login/new_ui/images/404-image.png')}}" style="max-width:500px;width:100%;margin-bottom:25px;">
        <div class="text-center">
            <p style="margin-bottom: 30px;font-size: 30px;color: #231f20;font-weight:bold;">SORRY! THIS PAGE WAS LOST</p>
            <a href="{{url('/dashboard')}}" class="btn btn-backtopage">Back To Dashboard</a>
        </div>
    </div>
</body>
</html>