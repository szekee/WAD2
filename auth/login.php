<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <link rel="stylesheet" href="style/main.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <title>Login</title>
</head>


<body>
	<div class="form-box col-10 col-sm-8 col-md-6 col-lg-5">
        <h2>Login</h2>
        <form name="login" action="login.php" method="post" onsubmit="return(logvalidate())">
            <?php
            if (count($errors) > 0) {
            ?>
                <div class="alert alert-danger text-center">
                    <?php
                    foreach ($errors as $showerror) {
                        echo $showerror;
                    }
                    ?>
                </div>
            <?php
            }
            ?>
            <?php

            if (isset($_SESSION['info'])) {
                echo '<div class="alert alert-success text-center">' . $_SESSION['info'] . '</div>';
            } ?>

            <?php

            if (isset($_SESSION['email_error']) && isset($_GET['code'])) {

                echo '<div class="alert alert-danger text-center">' . $_SESSION['email_error'] . '</div>';
            } ?>
            <div class="user-box">
                <input type="text" name="email" required="">
                <label>Email</label>
                <p id="email" style="color:red;"></p>
            </div>
            <div class="user-box" id="password">
                <input type="password" name="password" required="">
                <label>Password</label>
            <div class="d-flex justify-content-between">
				 	<?php
				 		echo "<a style='color:#03e9f4;' href=".$client->createAuthUrl().">Login with Google</a>"
				 	?>
                <a href="forgotpass.php" style="color:#03e9f4;">Forgot Password?</a>
            </div>
                <p id="valid" style="color:red;"></p>
            </div></br>

            <button type="submit" value="submit" id="login" name="login" style="color:rgba(0, 0, 0, .5); width:100%; text-align:center">Login</button></br></br>
            <a href="signup.php" style="color:#03e9f4;display:block; text-align:center;width:100%">Don't have an account?</a>
        </form>

    </div>

    <script src="./script/loginFormValidation.js">
    </script>

</body>

</html>
