<?php
    $dir = dirname(__FILE__);
    echo "<p>Full path to this dir: " . $dir . "</p>";
    echo "<p>Full path to a .htpasswd file in this dir: " . $dir . "/.htpasswd" . "</p>";

    echo "<div>";
    phpinfo();

    putenv('LANGUAGE=en_US');

    if (!function_exists("gettext")) {
        echo "gettext is not installed\n";
    }
    else {
        echo "gettext is supported\n";
    }
    echo "</div>"
?>


Full path to this dir: /hermes/bosnaweb23a/b2202/ipg.spencerbartzcom1

Full path to a .htpasswd file in this dir: /hermes/bosnaweb23a/b2202/ipg.spencerbartzcom1/.htpasswd
