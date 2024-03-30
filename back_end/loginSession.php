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

if (require_once "_dbCon.php") {

    $stmt = $connection->prepare("SELECT * FROM USERS WHERE Email = ?");
    $stmt->bind_param("s", $email);

    $email = $_SESSION["email"];
    $stmt->execute();
    $stmt->store_result();

    $stmt->bind_result($USERID, $EMAIL, $PASSWORD);


    $stmt->fetch();

    $_SESSION["pass"] = $PASSWORD;
    $_SESSION["userid"] = $USERID;

    $stmt->close();

	/*
    $query = "SELECT * FROM Events WHERE User_ID = " . $USERID;

    $result = $connection->query($query);

    if ($result->num_rows > 0) {
        // output
        while ($row = $result->fetch_assoc()) {
            //echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["location"]. "<br>"; <--- this was test to see if i can grab by with rest Api
            $data = array(
                'id' => $row['EventID'],
                'title' => $row['Subject'],
                'start' => $row['StartTime'],
                'end' => $row['endTime']);
        }
        Resposne::sendResposne($data);
        curl_setopt($header);
    }
    else {
        echo "error";
    }
*/ 
    $connection->close();
    //$result->close();
    safe_redirect("https://localhost/CloudPage.php", false);
}
