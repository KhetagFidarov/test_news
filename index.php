<?php


 require_once('vendor/autoload.php');


 $db = new \App\DBConnect();
 $session = new \App\AuthCheck();

//header('Location: public/login.php');

 if(!$session->sessionCheck()){
    header('Location: public/login.php');
 }


 if(!empty($_POST['username']) || !empty($_POST['password'])){
     $username = $_POST['username'];
     $password = $_POST['password'];


     $stmt = $db->pdo()->prepare("SELECT * FROM users WHERE username = :username");

     $stmt->execute([':username' => $username]);

     if ($stmt->rowCount() > 0) {
         $session->writeDownSession(0);
         header('Location: public/register.php?busy=true');
         die;
     } else {
         $stmt = $db->pdo()->prepare("INSERT INTO users (username, password,rights) VALUES(:username,:password,:rights)");
         $stmt->execute([':username' => $username,':password'=>password_hash($_POST['password'],PASSWORD_DEFAULT),':rights'=>4]);
         header('Location: public/login.php');
     }

 }

 if(!empty($_POST['username_login']) || !empty($_POST['password_login'])){

     $username_login = $_POST['username_login'];
     $password_login = $_POST['password_login'];

     $stmt = $db->pdo()->prepare("SELECT * FROM `users` WHERE `username` = :username");
     $stmt->execute(['username' => $username_login]);

     if (!$stmt->rowCount()) {
         header('Location: public/login.php?present=true');
         die;
     }

     $user = $stmt->fetch(PDO::FETCH_ASSOC);


     if (password_verify($password_login, $user['password'])) {

         if (password_needs_rehash($user['password'], PASSWORD_DEFAULT)) {
             $newHash = password_hash($password_login, PASSWORD_DEFAULT);
             $stmt = pdo()->prepare('UPDATE `users` SET `password` = :password WHERE `username` = :username');
             $stmt->execute([
                 'username' => $username_login,
                 'password' => $newHash,
             ]);
         }

         $session->writeDownSession($user['id']);
         header('Location: public/home.php');
         die;
     }

     header('Location: public/login.php?wrong=true');
 }






?>