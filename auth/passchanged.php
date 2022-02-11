<?php require_once "controllerUserData.php"; ?>
<?php
if($_SESSION['info'] == false){
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
        <h2>Login</h2>
        <form name="passchanged" action="login.php" method="post">
        <?php 
            if(isset($_SESSION['info'])){
                ?>
                <div class="alert alert-success text-center">
                <?php echo $_SESSION['info']; ?>
                </div>
                <?php
            }
            ?>
            <button type="submit" class="w-100 text-center" value="Login Now" id="login-now" name="login-now" style="color:rgba(0, 0, 0, .5);">Login Now</button></br></br>

        </form>

    </div>

</body>

<script src="./script/loginFormValidation.js"></script>

</html>
