<?php
	require_once "controllerUserData.php";
	require("connection.php");
	
	// Google login redirecting page
if (isset($_GET['code'])) {
		$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
		$client->getAccessToken($token);

		//Getting User Profile
		$gauth = new Google_Service_Oauth2($client);
		$google_info = $gauth->userinfo->get();
		$fname = $google_info->givenName;
		$lname = $google_info->familyName;
		$name = $fname." ".$lname;
		$email = $google_info->email;
		$status = $google_info->verifiedEmail;
		$googleid = $google_info->id;
		$email_check = "SELECT * FROM user WHERE email = '$email'";
		$res = mysqli_query($con, $email_check);


		// User exists set user session
		if (mysqli_num_rows($res) > 0) {
			$_SESSION["email"] = $email;
			$rows = mysqli_fetch_row($res);
			$_SESSION['userid'] = $rows[0];        // $rows[0] - $userid

			if($rows[10] == "unfinised") {       // $rows[10] - $status
				header("Location: ./gmailsignup.php");
			}
			else {
				header("Location: ../home.php");
			}
		}
		// Register user
		else {
			if ($status) {
				$status = "unfinised";
				$_SESSION["status"] = $status;
			}
			$_SESSION["email"] = $email;

			$insert_data = "INSERT INTO user (name, password, email, code, status, googleid)
                        VALUES('$name', 'no','$email',0, '$status','$googleid')";

			$data_check = mysqli_query($con, $insert_data);

			if($data_check && $status == "unfinised") {
					header("Location: gmailsignup.php");
			}
		}
}


