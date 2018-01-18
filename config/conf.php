<?php

class Conf {

    static private $databases = array(
        // Le nom d'hote est infolimon a l'IUT

        'hostname' => 'infolimon',
        // A l'IUT, vous avez une BDD nommee comme votre login
        'database' => 'gonzalezblancor',
        // A l'IUT, c'est votre login
        'login' => 'gonzalezblancor',
        // A l'IUT, c'est votre mdp (INE par defaut)
        'password' => '1234'
    );

    static public function getHostname() {
        //en PHP l'indice d'un tableau n'est pas forcement un chiffre.
        return self::$databases['hostname'];
    }

    static public function getDatabase() {
        //en PHP l'indice d'un tableau n'est pas forcement un chiffre.
        return self::$databases['database'];
    }

    static public function getPassword() {
        //en PHP l'indice d'un tableau n'est pas forcement un chiffre.
        return self::$databases['password'];
    }

    static public function getLogin() {
        //en PHP l'indice d'un tableau n'est pas forcement un chiffre.
        return self::$databases['login'];
    }

    static private $debug = True;

    static public function getDebug() {
        return self::$debug;
    }

}