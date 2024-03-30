<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Login</title>
    <!-- Link for Social Media Icons from font-awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
    <script type="text/javascript"></script>
  <link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css'>
    <link rel="stylesheet" href="Style/loginstyle.css">

</head>
<body>
    <header>
        <div class="navBar">
            <!-- Place holder for our logo -->
            <div class="logo">
                <img src="Logo.png" alt="">
            </div>
            <!-- End of Logo  -->

            <!-- navigation Bar -->
            <ul class="main-nav">
                <li class="active"><i class="fa fa-home"></i><a href="index.html">Home</a></li>
            </ul>
        </div>
        <!-- End of NavBar -->
    </header>

	<?php include("back_end/LoginValidation.php");?>
    <div class="wrapper">
    <form class="form-signin" id="login" action= "<?php $_SERVER["PHP_SELF"];?>" method="post">
      <h2 class="form-signin-heading">Please login</h2>
      <input type="text" class="form-control" name="email" placeholder="Email Address"/>
	  <span class="error"><?php echo $errorEmail;?></span>
      <input type="password" class="form-control" name="password" placeholder="Password"/>
	  <span class="error"><?php echo $errorPass;?></span>
        <input type="submit" name="submit"  value="Submit" />

      <div class="recover">
        <p><a href="RegisterPage.php" class="link"><strong>Register</strong></a>?</p>
      </div>
    </form>
  </div>

    <!-- Footer -->
    <footer class="site-footer">

        <div class="copyright">
            <p>&copy All Rights Reserved 2018 Pawel Stencel</p>
        </div>

        <div class="socialIcons">
            <p>Find us on Social Media!</p>
            <ul>
                <li><i class="fa fa-facebook"></i></li>
                <li><i class="fa fa-twitter"></i></li>
                <li><i class="fa fa-instagram"></i></li>
                <li><i class="fa fa-google"></i></li>
            </ul>
        </div>
    </footer>
</body>
</html>
