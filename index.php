<!doctype html>

<html>
    <head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <style>
        body {
            background-color: black;
            }

        .like {
            background-color: black;
            color: #ffff00;
            outline-color: #ffff00;
            outline-width : thin ;
            outline-style : solid ;
        }

        .like:hover{
            background-color: #ffff00;
            color: black;
            outline-color: #ffff00;
            outline-width : thin ;
            outline-style : solid ;
        }

    </style>

    <body>
        <div class = 'container mt-10' style = 'left: 50%;top: 50%;'>
            <div class = 'row'>
                <img class = 'img-fluid' style = 'margin:auto;' src ='starlight1.png'>
                <div class = 'col'>
                    <a href="./auth/signup.php" class="btn my-2 like" style="float: right;">Sign Up</a>
                </div>
                <div class = 'col text-centre'>
                    <a href="./auth/login.php" class="btn my-2 like" style="float: left;">Log In</a>
                </div>
            </div>
        </div>

    </body>
</html>
