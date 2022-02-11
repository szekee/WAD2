<?php
session_start();
require("connection.php");
require("config.php");

require_once 'vendor/autoload.php';
require_once 'vendor/google/apiclient-services/autoload.php';

$email = "";
$name = "";
$errors = array();

//if user click signup button
if (isset($_POST['signup'])) {

    // retrieve user input
    $fname = htmlentities(mysqli_real_escape_string($con, $_POST['first_name']));
    $lname = htmlentities(mysqli_real_escape_string($con, $_POST['last_name']));
    $email = htmlentities(mysqli_real_escape_string($con, $_POST['email']));
    $password = htmlentities(mysqli_real_escape_string($con, $_POST['password']));
    $country = htmlentities(mysqli_real_escape_string($con, $_POST['countries']));
    $address = htmlentities(mysqli_real_escape_string($con, $_POST['address']));
    $gender = htmlentities(mysqli_real_escape_string($con, $_POST['gender']));
    $dob = htmlentities(mysqli_real_escape_string($con, $_POST['birthday']));
    $phoneNo = htmlentities(mysqli_real_escape_string($con, $_POST['phoneNo']));

    $email_check = "SELECT * FROM user WHERE email = '$email'";
    $res = mysqli_query($con, $email_check);
    if(mysqli_num_rows($res) > 0){
        $errors['email'] = "Email that you have entered is already exist!";
    }
    if(count($errors) === 0){
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "not_verified";
        $name = $fname." ".$lname;
        
        $insert_data = "INSERT INTO user (name, password, email, address, country, gender, phone, dob, code, status)
                        VALUES('$name', '$encpass','$email', '$address', '$country',  '$gender', '$phoneNo', '$dob', '$code', '$status')";

        $data_check = mysqli_query($con, $insert_data);

        if($data_check){
            $subject = "Email Verification Code";
            $message = "Your verification code is $code";
            $sender = "From: carmenlee086@gmail.com";
            if(mail($email, $subject, $message, $sender)){
                $info = "We've sent a verification code to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
				


                header('location: userotp.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while sending code!";
            }
        }else{
            $errors['db-error'] = "Failed while inserting data into database!";
        }
    }

}

//If user click verification code submit button
if(isset($_POST['check'])){
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $check_code = "SELECT * FROM user WHERE code = $otp_code";
    $code_res = mysqli_query($con, $check_code);

    if(mysqli_num_rows($code_res) > 0){
        $fetch_data = mysqli_fetch_assoc($code_res);
        $fetch_code = $fetch_data['code'];
        $email = $fetch_data['email'];
		$userid = $fetch_data['userid'];
        $code = 0;
        $status = "verified";

        $update_otp = "UPDATE user SET code = $code, status = '$status' WHERE code = $fetch_code";
        $update_res = mysqli_query($con, $update_otp);
        if($update_res){
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
			$_SESSION['userid'] = $userid;

						// Successfully checked user will be redirect to index
            header('location: ../home.php');
            exit();
        }else{
            $errors['otp-error'] = "Failed while updating code!";
        }
    }else{
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}


//If user click login button
if(isset($_POST['login'])){
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$check_email = "SELECT * FROM user WHERE email = '$email'";
	$res = mysqli_query($con, $check_email);
	if(mysqli_num_rows($res) > 0){
			$fetch = mysqli_fetch_assoc($res);
			$fetch_pass = $fetch['password'];
			$userid = $fetch['userid'];
			if(password_verify($password, $fetch_pass)){
					$_SESSION['email'] = $email;
					$status = $fetch['status'];
					if($status == 'verified'){
						$_SESSION['email'] = $email;
						$_SESSION['password'] = $password;
						$_SESSION['userid'] = $userid;
						header('location:../home.php');
					}else{
							$info = "It's look like you haven't verify your email - $email";
							$_SESSION['info'] = $info;

							header('location: userotp.php');
					}
			}else if(!password_verify($password, $fetch_pass) && $fetch_pass != "no"){
					$errors['email'] = "Incorrect email or password!";
			} else {
					$errors['email'] = "You are registered with a third party account, click forgot password to set password.";
			}
	}else{
			$errors['email'] = "It's look like you're not yet a member! Click on the bottom link to signup.";
	}
}

//if user click continue button in forgot password form
if(isset($_POST['check-email'])){
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$check_email = "SELECT * FROM user WHERE email='$email'";
	$run_sql = mysqli_query($con, $check_email);
	if(mysqli_num_rows($run_sql) > 0){
			$code = rand(999999, 111111);

			$insert_code = "UPDATE user SET code = $code WHERE email = '$email'";
			$run_query =  mysqli_query($con, $insert_code);
			if($run_query){
					$subject = "Password Reset Code";
					$message = "Your password reset code is $code";
					$sender = "From: carmenlee086@gmail.com";
					if(mail($email, $subject, $message, $sender)){
							$info = "We've sent a passwrod reset otp to your email - $email";
							$_SESSION['info'] = $info;
							$_SESSION['email'] = $email;
							header('location: resetotp.php');
							exit();
					}else{
							$errors['otp-error'] = "Failed while sending code!";
					}
			}else{
					$errors['db-error'] = "Something went wrong!";
			}
	}else{
			$errors['email'] = "This email address does not exist!";
	}
}

//if user click check reset otp button
if(isset($_POST['check-reset-otp'])){
	$_SESSION['info'] = "";
	$otp_code = mysqli_real_escape_string($con, $_POST['otp']);
	$check_code = "SELECT * FROM user WHERE code = $otp_code";
	$code_res = mysqli_query($con, $check_code);
	if(mysqli_num_rows($code_res) > 0){
			$fetch_data = mysqli_fetch_assoc($code_res);
			$email = $fetch_data['email'];
			$_SESSION['email'] = $email;
			$_SESSION['info'] = $info;
			header('location: newpassword.php');
			exit();
	}else{
			unset($_SESSION['info']);
			$errors['otp-error'] = "You've entered incorrect code!";
	}
}

//If user click change password button
if(isset($_POST['change-password'])){
	$_SESSION['info'] = "";
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$code = 0;
	$email = $_SESSION['email']; //getting this email using session
	$encpass = password_hash($password, PASSWORD_BCRYPT);
	$update_pass = "UPDATE user SET code = $code, password = '$encpass' WHERE email = '$email'";
	$run_query = mysqli_query($con, $update_pass);
	if($run_query){
			$info = "Your password changed. Now you can login with your new password.";
			$_SESSION['info'] = $info;
			header('Location: ./login.php');
	}else{
			$errors['db-error'] = "Failed to change your password!";
	}
}

//if login now button click
if(isset($_POST['login-now'])){
	header('Location: ../home.php');
}

if(isset($_POST['gmail'])) {
    $email = $_SESSION['email'];

		$email_check = "SELECT * FROM user WHERE email = '$email'";
		$res = mysqli_query($con, $email_check);

		$rows = mysqli_fetch_row($res);
		$_SESSION['userid'] = $rows['0'];


    $country = htmlentities(mysqli_real_escape_string($con, $_POST['countries']));
    $address = htmlentities(mysqli_real_escape_string($con, $_POST['address']));
    $gender = htmlentities(mysqli_real_escape_string($con, $_POST['gender']));
    $dob = htmlentities(mysqli_real_escape_string($con, $_POST['birthday']));
    $phoneNo = htmlentities(mysqli_real_escape_string($con, $_POST['phoneNo']));

		$update_info = "UPDATE user SET country='$country', address='$address', gender='$gender', dob='$dob', phone='$phoneNo', status='verified' WHERE email='$email'";

		$data_check = mysqli_query($con, $update_info);

		if($data_check) {
			header("Location: ../home.php");
		}else {
			$errors['db-error'] ="Something went wrong.";
		}
}

// Google login logic

// creating client request to google
 $client = new Google_Client();
 $client->setClientId($clientID);
 $client->setClientSecret($clientSecret);
 $client->setRedirectUri($redirectUrl);

 $client->addScope('profile');
 $client->addScope('email');

?>
