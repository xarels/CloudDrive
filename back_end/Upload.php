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
}
	$errorMsg = " ";
if($_SERVER["REQUEST_METHOD"] == "POST") {	
	if (isset($_POST["uploadBtn"])) {
		$target_dir = "../uploads/" . $_SESSION["userid"] . "/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		// Check if file already exists
		if (file_exists($target_file)) {
			
			$errorMsg = "Sorry, file already exists.";
			echo $errorMsg;
			$uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
			
			$errorMsg = "Sorry, your file is too large.";
			echo $errorMsg;
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg"
		&& $fileType != "gif" && $fileType != "zip" ) {
			
			$errorMsg ="Sorry, only JPG, JPEG, PNG, GIF & ZIP files are allowed.";
			echo $errorMsg;
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			$errorMsg = "Sorry, your file was not uploaded.";
			echo $errorMsg;
			safe_redirect("https://localhost/cloudPage.php" , false);
		// if everything is ok, try to upload file
		} else {

			if (!file_exists($target_dir)) {
				mkdir($target_dir, 0777, true);
			}

			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				/*if (require_once "_dbCon.php") {
					//Database insert code		
					$stmt = $connection->prepare("INSERT INTO files (UserID, FileName,FileSize,LastModified,IsDeleted) VALUES (?,?,?,?,?,?)");
					$stmt->bind_param("issii", $userID, $fileName,$lastModified,$fileSize,$isDeleted);

					$userID = $_SESSION["userid"];
					$fileName = basename($_FILES["fileToUpload"]["name"].'.' .$fileType );	
					$lastModified =	date("Y/m/d");
					$fileSize =	$_FILES["fileToUpload"]["size"];
					$isDeleted = 0;
					
					if ($stmt->execute()) {

						$stmt->close();

						$findFile = "SELECT * FROM files WHERE UserID = '" . $_SESSION["userid"] . "' AND IsDeleted = 0";
						$result = $connection->query($findFile);

						if ($result->num_rows > 0) {

							$row = $result->fetch_assoc();
							$_SESSION["fileID"] = $row["FileID"];
							$_SESSION["fileName"] = $row["FileName"];
							$_SESSION["fileSize"] = $row["FileSize"];
							$_SESSION["lastModified"] = $row["LastModified"];
							$connection->close();
							echo "Database insert has been successfull";
							
						} else {
							$connection->query("DELETE FROM Files WHERE UserID = '" . $_SESSION["userid"] . "'");
							session_destroy();
							$connection->close();
							echo "Error has been encountered when inserting upload onto database";
						}
					}	
				}*/
				//Successfull Upload msg
				$errorMsg = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
				echo $errorMsg;
				safe_redirect("https://localhost/cloudPage.php" , false);
			} else {
				
				$errorMsg = "Sorry, there was an error uploading your file.";
				echo $errorMsg;
				safe_redirect("https://localhost/cloudPage.php" , false);
			}
		}
	}
}
?>