<?php
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

function safe_redirect($url, $permament=true)
{
    if (!headers_sent()) {

        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ' . $url);
        header("Connection: close");
    }
};

	///setting all error variables to empty
	$errorEmail = $errorPass = $errorCPass = $passThrough = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
///////////////////////////////Start of Validation///////////////////////////////////
        $passThrough = true;
		
		if(require_once("_dbCon.php")) {

//////Email Validation////////////////////
            if (empty($_POST["email"])) {

                $errorEmail = "Email is Required";
                $passThrough = false;

            } else if (!(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))) {

                $errorEmail = "Invalid Email";
                $passThrough = false;

            } else {
                $stmt = $connection->prepare("SELECT Email FROM USERS WHERE Email = ?");
                $stmt->bind_param("s", $email);
                $email = $_POST["email"];
                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows > 0) {

                    $stmt->close();
                    $connection->close();
                    $passThrough = false;
                    $errorEmail = "User Already Exists";

                } else {

                    $stmt->close();
                    $connection->close();
                    $_SESSION["email"] = $_POST["email"];

                }
            }

//////Password Validation////////////////////
            if (empty($_POST["password"])) {

                $errorPass = "Password is Required";
                $passThrough = false;

            } else if (strlen($_POST["password"]) < 8 || strlen($_POST["password"]) > 20) {

                $errorPass = "Password must be 8 to 20 characters";
                $passThrough = false;

            }

//////Confirm Password Validation////////////////////
            if (empty($_POST["cpass"])) {

                $errorCPass = "Confirm Password is Required";
                $passThrough = false;

            } else if (!($_POST["password"] === $_POST["cpass"])) {

                $errorCPass = "Passwords do not match";
                $passThrough = false;
            } else {

                $_SESSION["pass"] = password_hash($_POST["password"], PASSWORD_BCRYPT);
            }

//////Path decider////////////////////
            if ($passThrough) {

                safe_redirect("https://localhost/back_end/RegisterSession.php", false);

            }
        }
	}
///////////////////End of Validation////////////////////////////////////
?>

