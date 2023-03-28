<?php

namespace App;

session_start();

class AuthCheck
{
    public function sessionCheck():bool {
        return isset($_SESSION['user_id']);
    }

    public function writeDownSession($session) {
        $_SESSION['user_id'] = $session;
    }

    public function logOut() {
        session_unset();
        header('Location: login.php');
    }

    public function getId():string {

        return $_SESSION['user_id'];
    }

    public function adminRights(array $array):bool {

        $admin_rights = ['create','delete'];

        foreach ($admin_rights as $item=>$value){
            if (in_array($value,$array)) {
                return true;
            }
        }
        return false;
    }

    public function moderRights(array $array):bool {

        $moder_rights = 'update';

        foreach ($array as $item=>$value){
            if (in_array($moder_rights,$array)) {
                return true;
            }
        }
        return false;
    }

}