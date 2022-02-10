<!doctype html>
<html>
    <head>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- Vue Use CDN Library -->
        <script src="https://unpkg.com/vue@next"></script>
    </head>
    <body>
        <?php

        if (isset($_POST["update"])){
            $applyid = $_POST["applyid"];
            $status = $_POST["status"];
            $sql3 = "update applylisting set applicationstatus = :status where applyid = :applyid";
            $stmt3=$pdo->prepare($sql3);
            $stmt3->bindParam(':status', $status);
            $stmt3->bindParam(':applyid', $applyid);
            

            // Run SQL Statement
            // $stmt3->execute();
            if ($stmt3->execute()){
                echo("<script>location.href = 'poster_view_applications.php?id=$id&updateStatus=successful';</script>");
            }
            else{
                echo("<script>location.href = 'poster_view_applications.php?id=$id&updateStatus=unsuccessful';</script>");
            }
        }

        ?>
</body>
</html>