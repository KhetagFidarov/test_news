<?php

    require_once('../vendor/autoload.php');

    $session = new \App\AuthCheck();
    $posts = new \App\Posts();
    $db = new \App\DBConnect();

    $page = 1;

    if(!$session->sessionCheck()){
        header('Location: login.php');
    }

    if(!empty($_POST['log_out'])){
        $session->logOut();
    }

    if(!empty($_POST['delete'])){
        $post_id = intval($_POST['delete']);
        $posts->destroy($post_id);
    }

    if(!empty($_POST['update'])){
        $post_id = intval($_POST['update']);
        header('Location: redact.php?post_id='.$post_id);
    }


    if(!empty($_GET['category'])){
        $category = array(intval($_GET['category']));
    } else {
        $category = [1,2,4];
    }

    if(!empty($_GET['page'])){
        $page = intval($_GET['page']);
    }

    if(!empty($_GET['showPosts'])){
        $showPosts = intval($_GET['showPosts']);
    } else {
        $showPosts = 3;
    }


    if ($session->sessionCheck()) {
        // Получим данные пользователя по сохранённому идентификатору
        $stmt = $db->pdo()->prepare("SELECT * FROM users as u 
                                           JOIN user_rights as ur ON u.rights = ur.id
                                            WHERE u.id = :id");

        $stmt->execute(['id' => $session->getId()]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" src="style/headers.css">
    <title>Home</title>
</head>

<body class="container">
<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
    <div class="col-md-3 mb-2 mb-md-0">
        <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
            <svg class="bi" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
        </a>
    </div>

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="home.php" class="nav-link px-2 link-secondary">Home</a></li>
        <li><a href="home.php?category=1" class="nav-link px-2">Health</a></li>
        <li><a href="home.php?category=2" class="nav-link px-2">Fitness</a></li>
        <li><a href="home.php?category=4" class="nav-link px-2">Food</a></li>
    </ul>
</header>
<div class="card">
    <form method="post" action="">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h4>Добро пожаловать <?php
                if(!empty($user['username'])){
                    echo $user['username'] . "! Ваши права: " . $user['name'];
                }
                ?></h4>
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <?php if(!empty($user['rights_name'])) {
                $rights = explode(',',$user['rights_name']);
                if($session->adminRights($rights)){ ?>
                    <a href="create.php" class="btn btn-success">Добавить пост</a>
                <?php }?>
            <?php }?>
            <input type="submit" class="btn btn-danger" name="log_out" value="Выйти">
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="mb-2">
            <select id="select" class="form-select" aria-label="Default select example">
                <option <?= $showPosts == 1 ? 'selected' : ''?> value="1">Одно</option>
                <option <?= $showPosts == 2 ? 'selected' : ''?> value="2">Два</option>
                <option <?= $showPosts == 3 ? 'selected' : ''?> value="3">Три</option>
            </select>
        </div>
        <div class="d-flex justify-content-between align-items-stretch">
                <?php  foreach ($posts->index($category,$page,$showPosts) as $item=>$value){ ?>
<!--                        --><?php //if($value['is_view'] == 1) {?>
                        <div class="col mb-2" style="width: 20rem;">
                            <div class="card p-2 text-center justify-content-center align-content-between h-100 " >
                                <div class="h-100">
                                    <img src="<?= '../' . $value['directory'] ?>" class="card-img-top" alt="...>">
                                </div>

                                <div class="card-body p-4">
                                    <span><?php echo'#'.$value['category_name']?></span>
                                    <?php if($value['is_view'] == 0) {?>
                                        <span style="color: red"><?= '- (Черновик)'?></span>
                                    <?php }?>
                                    <h5 class="card-title"><?= $value['name'] ?>  </h5>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <?php if(!empty($user['rights_name'])) {
                                        $rights = explode(',',$user['rights_name']);
                                        if($session->adminRights($rights)){ ?>
                                            <button type="submit" class="btn btn-danger" value="<?= $value['id']?>" name="delete">Удалить</button>
                                        <?php } elseif ($session->moderRights($rights)){?>
                                            <button type="submit" class="btn btn-danger" value="<?= $value['id']?>" name="update">Редактировать</button>
                                        <?php }?>
                                    <?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>
<!--                    --><?php //} elseif ($value['is_view'] == 0) continue ?>
               <?php }?>
            </form>
        </div>
        <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php for($i=1; $i <= $posts->total_pages($category,$showPosts);$i++){?>
                        <?php if(count($category) > 1){?>
                            <li class="page-item"><a class="page-link" href="home.php?page=<?= $i?><?php echo !empty($showPosts) ? '&showPosts=' . $showPosts : '' ?>"><?= $i?></a></li>
                        <?php } else {?>
                            <li class="page-item"><a class="page-link" href="home.php?category=<?= $category[0]?>&page=<?= $i?><?php echo !empty($showPosts) ? '&showPosts=' . $showPosts : '' ?>"><?= $i?></a></li>
                        <?php }?>
                    <?php }?>
                </ul>
            </nav>
        </div>
    </div>
</div>
<script>
    let currentUrl = window.location.href;

    let newUrl = currentUrl + '&param=value';


    const select = document.getElementById('select')

    function getParamValue(paramName) {
        let regex = new RegExp('[?&]' + paramName + '=([^&#]*)');
        let match = regex.exec(currentUrl);
        return match ? decodeURIComponent(match[1].replace(/\+/g, ' ')) : null;
    }

    select.addEventListener('change', function(){

        let showPosts = this.value;

        let currentUrl = window.location.href;

        let existingValue = getParamValue('showPosts');

        if (existingValue !== null) {
            let url = window.location.href;

            let paramName = 'showPosts';

            let regex = new RegExp(`([?&])${paramName}=([^&#]*)`);

            if (regex.test(url)) {
                url = url.replace(regex, `$1showPosts=${showPosts}`);
            } else {
                url += `&showPosts=${showPosts}`;
            }

            url = new URL(url);

            let page = url.searchParams.get("page");

            if (page) {
                url.searchParams.set("page", "1");

                window.location.href = url.toString();
            } else {
                window.location.href = url.toString()
            }

        } else {

            let hasParams = currentUrl.indexOf('?') !== -1;

            let newParam = 'showPosts=' + showPosts;

            let newUrl = hasParams ? currentUrl + '&' + newParam : currentUrl + '?' + newParam;

            let url = new URL(newUrl);

            let page = url.searchParams.get("page");

            if (page) {
                url.searchParams.set("page", "1");

                window.location.href = url.toString();
            } else {
                window.location.href = url.toString();
            }
        }

    });



</script>

</body>
</html>


