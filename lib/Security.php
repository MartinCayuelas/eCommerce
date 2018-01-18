<?php

class Security {

    private static $seed = 'shield';

    public function chiffrer($texte_en_clair) {
        $concat = $texte_en_clair . Security::getSeed();
        $texte_chiffre = hash('sha256', $concat);

        return $texte_chiffre;
    }

    static public function getSeed() {
        return self::$seed;
    }

    function generateRandomHex() {
        // Generate a 32 digits hexadecimal number
        $numbytes = 16; // Because 32 digits hexadecimal = 16 bytes
        $bytes = openssl_random_pseudo_bytes($numbytes);
        $hex = bin2hex($bytes);
        return $hex;
    }

}
