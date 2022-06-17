<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Q&I</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{URL::asset('public/images/favicon.ico')}}" type="{{URL::asset('public/image/x-icon')}}" />
</head>
<div class="upInfo">
    <form id="contact" action="" method="post">
        <div class="logo"> <img src="{{URL::asset('public/after_login/new_ui/images/QI_Logo_al.gif')}}"></div>
        <h3>Update Your Information</h3>
        <fieldset>
            <input placeholder="Your name" value="{{$lead_user_data['FirstName']}}" type="text" tabindex="1" required autofocus>
        </fieldset>
        <fieldset class="verify-field">
            <input placeholder="Your Phone Number" value="{{$lead_user_data['Mobile']}}" type="tel" tabindex="3" required>
            <input class="btn btn-default" value="verifed" type="button" tabindex="3" required>
            </span>
        </fieldset>
        <fieldset>
            <input placeholder="Your Email Address" value="{{$lead_user_data['EmailAddress']}}" type="email" tabindex="2" required>
        </fieldset>
        <fieldset>
            <input placeholder="Your City" value="{{$lead_user_data['mx_City']}}" type="text" tabindex="2" required>
        </fieldset>
        <fieldset>
            <input placeholder="Exam to prepare for" value="{{$lead_user_data['mx_Exam_to_prepare']}}" type="text" tabindex="2" required>
        </fieldset>
        <fieldset>
            <input placeholder="Your grade" value="{{$lead_user_data['mx_Grade']}}" type="text" tabindex="2" required>
        </fieldset>
        <fieldset>
            <button name="submit" type="submit" id="contact-submit">Start Free</button>
        </fieldset>
    </form>
</div>
<style>
.upInfo {
    max-width: 400px;
    width: 100%;
    margin: 0 auto;
    position: relative;
    background: white;
}

.upInfo .logo {
    text-align: center;
    margin: 15px;
}

.upInfo .verify-field {
    display: flex;
}

.upInfo .verify-field .btn {
    width: fit-content !important;
    color: #ffffff;
    background: #4caf50 !important;
    border: none !important;
    cursor: pointer;
}

.upInfo #contact {
    font-family: "Roboto", Helvetica, Arial, sans-serif;
    background: #4caf5014;
    padding: 25px;
    margin: 150px 0;
    box-shadow: 0 0 20px 0 rgb(0 0 0 / 20%), 0 5px 5px 0 rgb(0 0 0 / 24%);
    border-radius: 18px;
}

.upInfo #contact h3 {
    display: block;
    font-size: 30px;
    font-weight: 300;
    margin-bottom: 10px;
}

.upInfo fieldset {
    border: medium none !important;
    margin: 0 0 10px;
    min-width: 100%;
    padding: 0;
    width: 100%;
}

.upInfo #contact input[type="text"],
.upInfo #contact input[type="email"],
.upInfo #contact input[type="tel"],
.upInfo #contact input[type="button"] {
    width: 100%;
    border: 1px solid #ccc;
    background: #fff;
    margin: 0 0 5px;
    padding: 10px;
    font-size: 20px;
}

.upInfo #contact input[type="text"]:hover,
.upInfo #contact input[type="email"]:hover,
.upInfo #contact input[type="tel"]:hover {
    -webkit-transition: border-color 0.3s ease-in-out;
    -moz-transition: border-color 0.3s ease-in-out;
    transition: border-color 0.3s ease-in-out;
    border: 1px solid #aaa;
}

.upInfo #contact button[type="submit"] {
    cursor: pointer;
    width: 100%;
    border: none;
    background: #4caf50;
    color: #fff;
    margin: 0 0 5px;
    padding: 10px;
    font-size: 15px;
}

.upInfo #contact button[type="submit"]:hover {
    background: #43a047;
    -webkit-transition: background 0.3s ease-in-out;
    -moz-transition: background 0.3s ease-in-out;
    transition: background-color 0.3s ease-in-out;
}

.upInfo #contact button[type="submit"]:active {
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.5);
}

.upInfo #contact input:focus {
    outline: 0;
    border: 1px solid #aaa;
}

.upInfo::-webkit-input-placeholder {
    color: #888;
}

.upInfo:-moz-placeholder {
    color: #888;
}

.upInfo::-moz-placeholder {
    color: #888;
}

.upInfo:-ms-input-placeholder {
    color: #888;
}

</style>
<html>