<?php
	function safe_redirect($url, $permament=true)
	{
		if (!headers_sent()) {

			header('HTTP/1.1 301 Moved Permanently');
			header('Location: ' . $url);
			header("Connection: close");
		}
	}
	if (version_compare(phpversion(), '5.4.0', '<')) {
		
		if(session_id() == '') {
			
			session_start();
		}
	}
	else {
		
		if (session_status() == PHP_SESSION_NONE) {
			
			session_start();
		}
	}
	
	if (isset($_POST["email"])){
		
		$_SESSION["email"] = $_POST["email"];
	}
	
	if (isset($_POST["pass"])){
		
		$_SESSION["pass"] = password_hash($_POST["pass"], PASSWORD_BCRYPT);	
	}

    if(require_once("_dbCon.php")) {

        $stmt = $connection->prepare("INSERT INTO USERS (Email, Pass) VALUES (?,?)");
        $stmt->bind_param("ss", $email, $password);

        $email = $_SESSION["email"];
        $password = $_SESSION["pass"];

        if ($stmt->execute()) {

            $stmt->close();

            $findUser = "SELECT * FROM USERS WHERE Email = '" . $_SESSION["email"] . "'";
            $result = $connection->query($findUser);

            if ($result->num_rows >= 0) {

                $row = $result->fetch_assoc();
                $_SESSION["userid"] = $row["ID"];
                $connection->close();
                safe_redirect("https://localhost/cloudPage.php", false);
            } else {
                $connection->query("DELETE FROM USERS WHERE Email = '" . $_SESSION["email"] . "'");
                session_destroy();
                $connection->close();
                safe_redirect("https://localhost/RegisterPage.php", false);
            }
        } else {
            $stmt->close();
            $connection->query("DELETE FROM USERS WHERE Email = '" . $_SESSION["email"] . "'");
            session_destroy();
            $connection->close();
            safe_redirect("https://localhost/RegisterPage.php", false);
        }
    }
?>