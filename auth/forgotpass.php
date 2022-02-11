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
    <title>Login</title>
</head>


<body>
    <div class="form-box col-10 col-sm-8 col-md-6 col-lg-5">
        <h2>Forgot Password</h2>
        <form name="forgotpass" action="forgotpass.php" method="post" onsubmit="return(forgotvalidate())">
            <?php
            if (count($errors) > 0) {
            ?>
                <div class="alert alert-danger text-center">
                    <?php
                    foreach ($errors as $error) {
                        echo $error;
                    }
                    ?>
                </div>
            <?php
            }
            ?>
            <div class="user-box">
                <input type="text" name="email" required="">
                <label>Email</label>
                <p id="email" style="color:red;"></p>
            </div>
            
            <button type="submit" value="Continue" id="check-email" name="check-email" style="color:rgba(0, 0, 0, .5); width:100%; text-align:center">Continue</button></br></br>

            
        </form>

    </div>

    <script>
        // check email format
        document.forgotpass.email.addEventListener("change", emailvalid)

        function emailvalid() {

            let valid = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

            let email = document.forgotpass.email.value

            if (!email.match(valid)) {

                document.getElementById("email").innerHTML = "Invalid email address"

                return (false);


            } else {

                document.getElementById("email").innerHTML = ""

                return (true);

            }
        }

        function forgotvalidate() {

            if (!emailvalid()) {

                alert("Please enter a valid email address");

                return (false);

            }

        }
    </script>

</body>

</html>