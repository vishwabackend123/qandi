<div class="upInfo" >
   <form id="contact" action="" method="post">
      <div class="logo"> <img src="https://app.thomsondigital2021.com/public/after_login/new_ui/images/QI_Logo_al.gif"></div>
      <h3>Update Your Information</h3>
      <fieldset>
         <input placeholder="Your name" value ="Mayank Baluni" type="text" tabindex="1" required autofocus>
      </fieldset>
      <fieldset class="verify-field">
         <input placeholder="Your Phone Number" value ="9873521107" type="tel" tabindex="3" required>
         <input class="btn btn-default" value ="verify" type="button" tabindex="3" required>
         </span>
      </fieldset>
      <fieldset>
         <input placeholder="Your Email Address"  value ="MayankBaluni@gmail.com" type="email" tabindex="2" required>
      </fieldset>
      <fieldset>
         <input placeholder="Your City"  value ="Delhi" type="text" tabindex="2" required>
      </fieldset>
      <fieldset>
         <input placeholder="Exam to prepare for"  value ="JEE-M" type="text" tabindex="2" required>
      </fieldset>
      <fieldset>
         <input placeholder="Your grade"  value ="12th standard" type="text" tabindex="2" required>
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