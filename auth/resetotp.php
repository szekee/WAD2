<?php require_once "controllerUserData.php"; ?>
<?php
$email = $_SESSION['email'];
if ($email == false) {
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
        <h2>Code Verification</h2>
        <form name="resetotp" action="resetotp.php" method="post">
            <?php
            if (isset($_SESSION['info'])) {
            ?>
                <div class="alert alert-success text-center" style="padding: 0.4rem 0.4rem">
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
            <div class="user-box">
                <input type="number" name="otp" required="">
                <label>Code</label>
                
            </div>
</br>
            <button type="submit" value="submit" id="check-reset-otp" name="check-reset-otp" style="color:rgba(0, 0, 0, .5); width:100%; text-align:center">Submit</button></br></br>


        </form>

    </div>

    
    </script> -->

</body>

</html>
