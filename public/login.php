<?php


    require_once('../vendor/autoload.php');


    $session = new \App\AuthCheck();

    if($session->sessionCheck()){
        header('Location: home.php');
    }

    if(!empty($_GET['wrong'])){
        $wrong = boolval($_GET['wrong']);
    } else {
        $wrong = false;
    }



?>




<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <title>Login</title>
</head>
<body class="container text-center">
    <div class="">
        <form class="form-signin" method="post" action="../index.php">
        <h1 class="h3 mb-3 font-weight-normal">Пожалуйста войдите</h1>
                <label for="username" class="sr-only">Username</label>
                <input type="text" class="form-control" id="username" name="username_login" required>
                <label for="password" class="sr-only">Password</label>
                <input type="password" class="form-control" id="password" name="password_login" required>
                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Запомнить меня
                    </label>
                </div>
                <button type="submit" class="btn btn-lg btn-primary btn-block">Login</button>
                <a class="btn btn-lg btn-light btn-secondary" href="register.php">Register</a>
        </form>
    </div>
    <?php if($wrong){?>
        <div>
            <h2 class="" style="color: red">
                Неверный логин или пароль.
            </h2>
        </div>
    <?php } ?>
</body>
</html>