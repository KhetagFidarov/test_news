<?php

    require_once('../vendor/autoload.php');
//    require_once('header.php');

    $session = new \App\AuthCheck();
    $posts = new \App\Posts();
    $db = new \App\DBConnect();

    if(!empty($_GET['post_id'])){
        $post_id = $_GET['post_id'];

        $post_information = $posts->post($post_id);
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (!empty($_FILES['file']['name'])) {

            print_r($_FILES['file']);
            $file = $_FILES["file"];

            $posts->saveImage($file,$post_id);
        }

        if(!empty($_POST['new_post_name'])){
            $name = $_POST['new_post_name'];
        } else {
            $name = $post_information['name'];
        }

        if(!empty($_POST['is_view'])){
            $is_view = 0;
        } else {
            $is_view = 1;
        }

        $posts->update($name,$is_view,$post_id);

        header('Location: home.php');
    }



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
    <title>Редактирование поста</title>
</head>
<body>
<div class="card">
    <div class="card-header">

    </div>
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Новое название поста</label>
                <textarea class="form-control" name="new_post_name" id="exampleFormControlTextarea1" rows="3"><?= $post_information['name'] ?> </textarea>
            </div>
            <div class="form-file form-file-sm">
                <input type="file" name="file" id="customFileSm">
                <label class="form-file-label" for="customFileSm">
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" <?= $post_information['is_view'] == 0 ? 'checked' : '' ?> value="0" id="flexCheckChecked" name="is_view">
                <label class="form-check-label" for="flexCheckChecked">
                    Скрыть?
                </label>
            </div>
                <button type="submit" class="btn btn-primary" name="save">Submit</button>
        </form>
    </div>
</div>

</body>
</html>