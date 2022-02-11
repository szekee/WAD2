<?php
	require_once "controllerUserData.php";
	require("connection.php"); 
	require("countries.php"); 

			unset($_SESSION['info']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <title>Sign Up</title>
</head>

<body>
    <div class="form-box col-10 col-sm-8 col-md-6 col-lg-5">
        <h2>Sign Up</h2>
        <form name="registration" action="signup.php" method="post" onsubmit="return(regvalidate())">
            <?php
            if (count($errors) == 1) {
            ?>
                <div class="alert alert-danger text-center">
                    <?php
                    foreach ($errors as $showerror) {
                        echo $showerror;
                    }
                    ?>
                </div>
            <?php
            } elseif (count($errors) > 1) {
            ?>
                <div class="alert alert-danger">
                    <?php
                    foreach ($errors as $showerror) {
                    ?>
                        <li><?php echo $showerror; ?></li>
                    <?php
                    }
                    ?>
                </div>
            <?php
            }
            ?>
            <div class="user-box" id="fname">
                <input type="text" name="first_name" required="">
                <label>First Name</label>
            </div>
            <div class="user-box">
                <input type="text" name="last_name" required="">
                <label>Last Name</label>
            </div>
            <div class="user-box">
                <input type="text" name="email" required="">
                <label>Email</label>
                <p id="email" style="color:red;"></p>
            </div>
            <div class="user-box" id="password">
                <input type="password" name="password" required="">
                <label>Password</label>
                <p id="valid" style="color:red;"></p>
            </div>
            <div class="user-box" id="cpassword">
                <input type="password" name="confirm_password" required="">
                <label>Confirm Password</label>
                <p id="check" style="color:red;"></p>
            </div>
            <div class="user-box">
                <label>Country</label></br></br>
                <select class="col-12" name="countries" required="">
                    <?php

                    foreach ($countries as $key => $value) {

                    ?>
                        <option value="<?= $value ?>" title="<?= htmlspecialchars($value) ?>"><?= htmlspecialchars($value) ?></option>
                    <?php

                    }

                    ?>
                </select>


            </div></br>

            <div class="user-box" id="address">
                <input type="textarea" name="address" required="">
                <label>Address</label>
            </div>

            <div class="user-button">
                <div style="color:white">Gender</div>
                <input type="radio" name="gender" value="M" required="" checked>
                <label>Male</label>
                <input type="radio" name="gender" value="F" required="">
                <label>Female</label>
                <input type="radio" name="gender" value="O" required="">
                <label>Others</label>
            </div></br>

            <div class="user-box">
                <div style="color:white">Year of Birth</div>
                <input type="date" name="birthday" required="required">
                <p id="age" style="color:red;"></p>
            </div>

            <div class="user-box">
                <input type="text" name="phoneNo" required="required">
                <label>Contact Number</label>
                <p id="phoneNo" style="color:red;"></p>
            </div>
            <div>
                <button type="submit" value="submit" id="signup" name="signup" style="color:rgba(0, 0, 0, .5);">Sign up</button></br></br>
				 	<?php
				 	    echo "<a style='color:#03e9f4;' href=".$client->createAuthUrl().">Login with Google</a>"
				 	?>

            </div>
            <a href="login.php" style="color:#03e9f4;">Already have an account?</a></br>
        </form>

    </div>

</body>

<script src="./script/signupFormValidation.js"></script>

</html>
