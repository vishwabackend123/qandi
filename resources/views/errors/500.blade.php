<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>500 Internal Server Error</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <!-- @if(env('MINIFY_STATIC_ASSETS') == 'true')
    <link rel="stylesheet" href="https://app.thomsondigital2021.com/public/after_login/current_ui/css/style.min.css">
    <link rel="stylesheet" href="https://app.thomsondigital2021.com/public/after_login/current_ui/css/mobile.min.css">
    @else
    <link rel="stylesheet" href="{{URL::asset('public/after_login/current_ui/css/style.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/after_login/current_ui/css/mobile.css')}}">
    @endif -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap">
    <style>
        *,
        html {
            padding: 0;
            margin: 0;
            box-sizing: border-box;

        }
        html {
            min-height: 100%;
            width: 100%;
        }
        body {
            min-height: 100%;
            width: 100%;
            margin: 0;
            padding: 0;
            font-family: "Manrope", sans-serif !important;
            overflow-x: hidden;
            font-feature-settings: "liga" 0;
            background-color: #e0f6e3; 
        }
        a{outline: none !important;text-decoration: none;}
        .btn.btn-common-transparent {
            padding: 8px 16px;
            border-radius: 8px;
            border: solid 1px #56b663;
            background-color: #f5faf6;
            color: #56b663;
            font-size: 14px;
            font-weight: 800;
        }
        .error-page-content h2{font-size: 28px;font-weight: 800; line-height: 1.3;color: #363c4f;margin: 20px 0 18px;}
        .error-page-content p{ font-size: 16px;font-weight: 500; line-height: 1.3; color: #363c4f;margin:0 0 60px;}
        .error-page-content a.btn.btn-common-transparent {
            width: 194px;
            height: 44px;
            background-color: #e0f6e3;
            line-height: 26px;
        }
        .error-page-content{max-width: 322px;margin:0 auto;}
        .error-page-wrapper{
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content:center;
            padding: 0 16px;
        }
        @media(max-width:767px){
            .mobile_hide{display:none!important}
            .error-page-content h2{font-size:24px;margin:40px 0 18px;}
            .error-page-content p{margin:0 0 40px;}
        }
        @media(min-width:768px){
            .mobile_block{display:none!important;}
        }
        @media only screen and (max-height: 700px) {
            .error-page-content p{margin:0 0 20px;}
            .error-page-content h2{margin:-30px 0 10px;}
            .error-page-block img {margin-top: -20px;}
        }
    </style>
</head>
<body>
    <div class="error-page-wrapper">
        <div class="error-page-block text-center">
            <img  src="{{URL::asset('public/after_login/current_ui/images/500-image.svg')}}" class="w-100 mobile_hide">
            <img  src="{{URL::asset('public/after_login/current_ui/images/500-image-mobile.svg')}}" class="w-100 mobile_block">
            <div class="error-page-content">
                <h2>Internal Server Error</h2>
                <p>We are having some issues at the moment. 
                    We will have it fixed in no time!</p>
                <a  id="reloadPage" class="btn btn-common-transparent">Reload 
                    <svg style="margin-left:8px;" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16.562 7.084h-3.75a.833.833 0 0 1 0-1.667h2.917V2.5a.833.833 0 1 1 1.667 0v3.75a.833.833 0 0 1-.834.834z" fill="#56B663"/>
                        <path d="M10 18.334a8.334 8.334 0 1 1 7.21-12.501.833.833 0 0 1-1.442.835A6.658 6.658 0 1 0 16.667 10a.833.833 0 0 1 1.667 0A8.343 8.343 0 0 1 10 18.334z" fill="#56B663"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{URL::asset('public/js/jquery-3.6.0.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#reloadPage").click(function () {
                location.reload();
            });
        });
    </script>
</body>
</html>