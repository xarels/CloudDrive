<?php
//index.php




?>
<!DOCTYPE html>
<html>
 <head>
  <title>Cloud</title>
  <!-- Link for Social Media Icons from font-awesome -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<!-- Link and JS related to Drop Down Login/Register form on Home Page -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
  <script type="text/javascript"></script>
  <link rel="stylesheet" href="Style/homestyle.css"> <?php // Needs changing to cloud page style css that will be created later on?>
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
      <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
      <li class="active"><i class="fa fa-unlock-alt"></i><a href="sSettingsPage.html" id="loginbtn">Settings</a></li>
      <li><i class="fa fa-unlock-alt"></i><a href="back_end/Signout.php" id="loginbtn">Sign Out</a></li>
  </ul>
</div>

<!-- End of NavBar -->
  </header>
  <div class="container">
   <div id="upload">
		<?php include("back_end/upload.php");?>
		<form action= "<?php $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data">
			Select image to upload:
			<input type="file" name="fileToUpload" id="fileToUpload">
			<span class="error"><?php echo $errorMsg;?></span>
			<input type="submit" value="Upload Image" name="uploadBtn">
		</form>
   </div>
  </div>
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
      <li><i class="fa fa-whatsapp"></i></li>
    </ul>
  </div>
</footer>
 </body>
</html>