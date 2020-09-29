<?php
    class CryptoUtil {
        public static function generate_salt() {
            $bytes = random_bytes(8);
            return bin2hex($bytes);
        }
    }
?>