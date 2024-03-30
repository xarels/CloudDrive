<?php

function safe_redirect($url, $permament=true)
{
    if (!headers_sent()) {

        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ' . $url);
        header("Connection: close");
    }
}

	$errorEmail= $errorPass= "";

	
	if($_SERVER["REQUEST_METHOD"] == "POST") {

        if (version_compare(phpversion(), '5.4.0', '<')) {
            if(session_id() == '') {
                session_start();
            }
        }
        else
        {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        }
		
		$passThrough = true;

		if(empty($_POST["email"])) {
            
            $errorEmail = "Email is Required";
            $passThrough = false;
         }
		else if (!(filter_var($_POST["email"],FILTER_VALIDATE_EMAIL))) {
        
       	    $errorEmail = "Invalid Email";
       	    $passThrough = false;
		}
		else {
            if (require_once "_dbCon.php") {

                $stmt = $connection->prepare("SELECT Email, Pass FROM USERS WHERE Email = ?");
                $stmt->bind_param("s", $email);
                $email = $_POST["email"];
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($email, $pass);

                if ($stmt->num_rows < 1)
                {
                    $stmt->close();
                    $connection->close();
                    $passThrough = false;
                    $errorEmail = "User does not Exist";
                }
                $stmt->fetch();

                if (empty($_POST["password"]))
                {
                    $passThrough = false;
                    $errorPass = "Password is Required";
                }
                else if (!(password_verify($_POST["password"], $pass)))
                {
                    $stmt->close();
                    $connection->close();
                    $errorPass = "Incorrect Password";
                    $passThrough = false;
                }
                else
                {
                    $stmt->close();
                    $connection->close();
                    $_SESSION["email"] = $_POST["email"];
                }
            }
        }

		if($passThrough) {

            safe_redirect("https://localhost/back_end/loginSession.php" , false);
		}
	}
?>