<?php require_once "controllerUserData.php"; ?>
<?php 
$email = $_SESSION['email'];
if($email == false){
  header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <link rel="stylesheet" href="style/main.css">
    <title>Login</title>
</head>


<body>
    <div class="form-box col-10 col-sm-8 col-md-6 col-lg-5">
        <h2>Create a New Password</h2>
        <form name="newpassword" action="newpassword.php" method="post" onsubmit="return(passvalidate())">
            <?php
            if (isset($_SESSION['info'])) {
            ?>
                <div class="alert alert-success text-center">
                    <?php echo $_SESSION['info']; ?>
                </div>
            <?php
            }
            ?>
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

            <div class="user-box" id="password">
                <input type="password" name="password" required="">
                <label>New Password</label>
                <p id="valid" style="color:red;"></p>
            </div>
            <div class="user-box" id="cpassword">
                <input type="password" name="confirm_password" required="">
                <label>Confirm Password</label>
                <p id="check" style="color:red;"></p>
            </div>

            <button type="submit" value="Change" id="change-password" name="change-password" style="color:rgba(0, 0, 0, .5); width:100%; text-align:center">Update Password</button></br></br>

            <!-- <a href="signup.php" style="color:#03e9f4;display:block; text-align:center;width:100%">Don't have an account?</a> -->
        </form>

    </div>

    <script>
         // check password format
         document.newpassword.password.addEventListener("change", passwordvalid)

function passwordvalid() {

    let valid = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;

    let password = document.newpassword.password.value

    if (!password.match(valid)) {

        document.getElementById("valid").innerHTML = "The password must contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character"

        return (false);

    } else {

        document.getElementById("valid").innerHTML = ""

        return (true);

    }
}


// check password and confirm password
document.newpassword.confirm_password.addEventListener("change", checkpassword)

function checkpassword() {

    let password = document.newpassword.password.value
    let cpassword = document.newpassword.confirm_password.value

    if (password !== cpassword) {

        document.getElementById("check").innerHTML = "The password confirmation does not match"

        return (false);

    } else {

        document.getElementById("check").innerHTML = ""

        return (true);

    }


}

        function passvalidate() {

            if (!passwordvalid() || !checkpassword()) {

                alert("Please make sure all inputs are correct.");

                return (false);

            }

        }
    </script>

</body>

</html>