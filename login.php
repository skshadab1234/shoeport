<?php include 'includes/session.php'; ?>
<?php
  if(isset($_SESSION['user'])){
    header('location: index.php');
  }
?>
<head><title>Login</title></head>
<?php include 'includes/header.php'; ?>
<body>

  <style type="text/css">
    @import url(https://fonts.googleapis.com/css?family=Roboto:300);

.login-page {
  width: 360px;
  padding: 0 0;
  margin: auto;
  background: rgb(0,0,0,0.4);
}
.form {
  position: relative;
  z-index: 1;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
.form input {
  font-family: "Roboto", sans-serif;
  outline: 0;
  width: 100%;
  background: none;
  border-bottom: 1px solid #6ac7cc;
  border-top: none;
  border-left: none;
  border-right: none;
  color: #6ac7cc;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
}
.form button {
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: none;
  border: 1px solid red;
  margin: 20px auto;
  width: 200px;
  padding: 10px;
    border: 1px solid #6ac7cc;

color: #6ac7cc;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}

.form button:hover{
  background: none;
  color: #6ac7cc;
    border: 1px solid #6ac7cc;
}
.form .message {
  margin: 15px 0 0;
  color: #b3b3b3;
  font-size: 12px;
}
.form .message a {
  color: #6ac7cc;
  text-decoration: none;
}
.form .register-form {
  display: none;
}
.container {
  position: relative;
  z-index: 1;
  max-width: 300px;
  margin: 0 auto;
}
.container:before, .container:after {
  content: "";
  display: block;
  clear: both;
}
.container .info {
  margin: 50px auto;
  text-align: center;
}
.container .info h1 {
  margin: 0 0 15px;
  padding: 0;
  font-size: 36px;
  font-weight: 300;
  color: #1a1a1a;
}
.container .info span {
  color: #4d4d4d;
  font-size: 12px;
}
.container .info span a {
  color: #000000;
  text-decoration: none;
}
.container .info span .fa {
  color: #EF3B3A;
}
body {
  background:url(images/login-bg.jpg); /* fallback for old browsers */
  background-repeat: no-repeat;

  /* Full height */
  height: 80%;

  /* Center and scale the image nicely */
  background-position: center;
  background-size: cover;
  font-family: "Roboto", sans-serif;
}
  </style>
  <body>
    
    <div class="login-box">
    <?php
      if(isset($_SESSION['error'])){
        echo "
          <div class='callout callout-danger text-center'>
            <p>".$_SESSION['error']."</p> 
          </div>
        ";
        unset($_SESSION['error']);
      }
      if(isset($_SESSION['success'])){
        echo "
          <div class='callout callout-success text-center'>
            <p>".$_SESSION['success']."</p> 
          </div>
        ";
        unset($_SESSION['success']);
      }
    ?>
    <div class="login-page">
      <h4 style="color: #6ac7cc;font-size: 30px;padding: 7px 10px;text-transform: uppercase;letter-spacing: 2px;font-weight: 700;margin: auto 110px;">Login</h4>
  <div class="form">
          <p class="login-box-msg" style="color: #6ac7cc">Sign in to start Shopping</p>

    <form class="login-form" action="verify.php" method="POST">
        <div class="form-group has-feedback" data-validate = "Username is required">
      <input type="email" class="form-control" name="email" placeholder="Email *" required>
            <span class="glyphicon glyphicon-envelope form-control-feedback" style="color: #6ac7cc"></span>
          </div>
<div class="form-group has-feedback" data-validate = "Password is required">
            <input type="password" class="form-control" name="password" placeholder="Password *" required>
            <span class="glyphicon glyphicon-lock form-control-feedback" style="color: #6ac7cc"></span>
          </div>
  <div class="row">
          <div class="col-xs-12">
                <button type="submit" class="btn btn-primary btn-block btn-flat" name="login"><i class="fa fa-sign-in"></i> Sign In</button>
            </div>
          </div>      
          <p class="message">Not registered? <a href="signup.php">Create an account</a></p>
           <p class="message"><a href="password_forgot.php">Forgot password</a></p>
          <p class="message"><a href="index.php"> SKIP Login</a></p>

    </form>
  </div>
</div>
  </body>
  <?php include 'includes/scripts.php' ?>
