<!DOCTYPE html>

<html lang="en" >
    <head>
        <meta charset="UTF-8">

         <title>Register Page</title>
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
        <script type="text/javascript"></script>
         <link rel="stylesheet" href="Style/registerstyle.css">
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
                    <li><i class="fa fa-unlock-alt"></i><a href="LoginPage.php" id="loginbtn">Login</a></li>
                </ul>
            </div>
            <!-- End of NavBar -->
        </header>

            <?php include("back_end/registerValidation.php");?>
             <!--  form -->
        <div class="wrapper">
            <form class="form-register" id="login" action= "<?php $_SERVER["PHP_SELF"];?>" method="post">
                <h2 class="form-register-heading">Please login</h2>
                <input type="text" class="form-control" name="email" placeholder="Email Address"/>
                <span class="error"><?php echo $errorEmail;?></span>
                <input type="password" class="form-control" name="password" placeholder="Password"/>
                <span class="error"><?php echo $errorPass;?></span>
                <input type="password" class="form-control" name="cpass" placeholder="Confirm Password" />
                <span class="error"><?php echo $errorCPass;?></span>
                <input type="submit" name="submit"  value="Submit" />

                <div class="recover">
                    <p><a href="LoginPage.php" class="link"><strong>Login</strong></a>?</p>
                </div>
            </form>
        </div>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
            <script  src="js/index.js"></script>
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

