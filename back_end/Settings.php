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
	
if(isset($_POST["newPassword"])) {

    updatePassword($_POST["oldPassword"],$_POST["newPassword"],$_POST["veriPassword"]);
}
else
{
    safe_redirect("https://localhost/sSettingsPage.html" , false);
}

if(isset($_POST["deleteAccount"])) {

    deleteUser($_POST["deleteAccount"]);
}
else
{
    safe_redirect("https://localhost/sSettingsPage.html" , false);
}

function safe_redirect($url, $permament=true)
{
    if (!headers_sent()) {

        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ' . $url);
        header("Connection: close");
    }
}

function toDatabase($query)
{
    if(require_once("_dbCon.php")) {

        $return = $connection->query($query);
        $connection->close();
        return $return;
    }
}
	
function updatePassword($currPass,$newPass,$repeatPass) {

	//verifies password  
	if ((password_verify($currPass,$_SESSION["pass"])) && $newPass === $repeatPass)
	{
	
			// hashes password
			$newPass = password_hash($newPass, PASSWORD_BCRYPT);
			
			//makes query
			$query = 'UPDATE USERS SET Pass = "'. $newPass  .'" WHERE USERID = '. $_SESSION["userid"];
				 
			//send query to be ran on the database	 
			if (toDatabase($query)) 
			{
						
						//sets session variables to new pass
						$_SESSION["pass"] = $newPass;
			}
	}

    safe_redirect("https://localhost/sSettingsPage.html" , false);
  }

function deleteUser($currPass) {

	//verifies password  
	if ((password_verify($currPass,$_SESSION["pass"])))	{

			//makes query
			$query = "DELETE FROM USERS WHERE Email = '" . $_SESSION["email"] . "'";
				 
			//send query to be ran on the database	 
			toDatabase($query);
	}

    safe_redirect("https://localhost/HomePage.html" , false);
  }
  
?>