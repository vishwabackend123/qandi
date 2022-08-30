<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 Page Not Found</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    @if(env('MINIFY_STATIC_ASSETS') == 'true')
    <link rel="stylesheet" href="{{URL::asset('public/after_login/current_ui/css/style.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/after_login/current_ui/css/mobile.min.css')}}">
    @else
    <link rel="stylesheet" href="{{URL::asset('public/after_login/current_ui/css/style.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/after_login/current_ui/css/mobile.css')}}">
    @endif
</head>
<body>
    <div class="error-page-wrapper">
        <div class="error-page-block text-center">
            <img  src="{{URL::asset('public/after_login/current_ui/images/404-image.svg')}}" class="w-100">
            <div class="error-page-content">
                <h2>Page Not Found</h2>
                <p>Sorry, the page you’re looking for cannot be accessed or was removed!</p>
                <a href="{{url('/dashboard')}}" class="btn btn-common-transparent">Go back</a>
            </div>
        </div>
    </div>
</body>
</html>