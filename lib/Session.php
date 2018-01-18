<?php

class Session {
    
    public static function is_connected(){
        return (!empty($_SESSION['login']));
    }

    public static function is_admin() {
        return (!empty($_SESSION['login']) && ($_SESSION['admin'] == '1'));
    }
    
    public static function is_user($login){
         return (!empty($_SESSION['login']) && ($_SESSION['login'] == $login));
    }
}

