<?php

    require_once('../vendor/autoload.php');


    $session = new \App\AuthCheck();
    $db = new \App\DBConnect();

    if(!empty($_GET['busy'])){
        $busy = boolval($_GET['busy']);
    } else {
        $busy = false;
    }

//    if($session->sessionCheck()){
//        header('Location: home.php');
//    }

?>


<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <title>Register</title>
</head>
<body>
    <div class="container text-center">
        <h1 class="h3 mb-3 font-weight-normal">Регистрация</h1>
        <form class="form-signin" method="post" action="../index.php">
            <div class="mb-3">
                <label for="username" class="sr-only">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="sr-only">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        <?php if($busy){?>
            <div>
                <h2 class="" style="color: red">
                    Это имя пользователя уже занято.
                </h2>
            </div>
        <?php } ?>
    </div>
</body>
</html>