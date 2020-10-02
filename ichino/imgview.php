<?php
    include '../util/users_controller.php';
    include '../util/string_util.php';

    $username = $_POST["username"];
    $password = $_POST["password"];
    $email    = $_POST["email"];

    $logged_in = UsersController::login($username, $password, $email);

    if ($logged_in) {
        echo "<!doctype html>";
        echo "<html>";
        echo "<head><title>Ichino!</title>";
        echo "<link rel=\"stylesheet\" href=\"../css/BluePigment.css\" type=\"text/css\" />";
        echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"slideshow/slideshow_style.css\">";
        echo "<link rel=\"shortcut icon\" href=\"../images/favicon.ico\" />";
        echo "<script type=\"text/javascript\" src=\"../js/jquery-1.11.2.min.js\"></script>";
        echo "<script type=\"text/javascript\" src=\"../js/util.js\"></script>";
        echo "</head>";
        echo "<body>";

        echo "<div id=\"content-wrap\">";
        echo "<div id=\"content\">";

        echo "<div id=\"main\">";
        echo "<div class=\"box\">";

        echo "<span class=\"white\"><a href=\"shashin/952020.pdf\" class=\"white\"><h3>Download PDF</h3></a></span><br/>";
        echo "<span class=\"white\"><a href=\"index.php\" class=\"white\"><h3>Back to Login</h3></a></span><br/>";


        echo "<div class=\"slideshow-container\">";

        echo "<div class=\"container centered\">";
        echo "<div id=\"image-area\" class=\"imgcenter centered\">";
        echo "</div>";

        echo "<div class=\"centered\">";
        echo "<button id=\"play-button\"></button>";
        echo "<button id=\"pause-button\"></button>";
    
        echo "</div>";

        echo "</div>";

        echo "</div>";

        // Get a list of filenames from the "shashin" directory (remove ./ and ../)
        $filename_list = array_diff(scandir("shashin"), array('..', '.', '.htaccess', '952020.pdf'));

        $images = array_filter($filename_list, function($v, $k) {
            return ends_with(strtolower($v), ".jpeg") || ends_with(strtolower($v), ".jpg");
        }, ARRAY_FILTER_USE_BOTH);

        // Sort image filenames naturally. (Stupid default ordering is 1.jpg, 10.jpg, 11.jpg ... N.jpg, N0.jpg, N1.jpg)
        natsort($images);

        $videos = array_filter($filename_list, function($v, $k) {
            return ends_with(strtolower($v), ".mp4");
        }, ARRAY_FILTER_USE_BOTH);

        echo "<div class=\"vids\">";

        foreach ($videos as $vid) {
            echo "<video controls width=\"500\">";
            echo "<source src=\"shashin/" . $vid . "\" type=\"video/mp4\">";
            echo "<span class=\"white\"><a href=\"shashin/" . $vid . "\" class=\"white\"><h3>Download " . $vid . "</h3></a></span><br/>";
            echo "</video>";
        }

        echo "</div>";

        foreach ($images as $img) {
            echo "<img src=\"shashin/" . $img . "\" style=\"max-width: 1200px;\" /><br/><br/>";
        }

        echo "</div>";
        echo "</div>";

        echo "</div>";
        echo "</div>";
        
        echo "<script src=\"slideshow/slideshow.js\"></script>";

        echo "</body>";
        echo "</html>";

    } else {
        header('Location: index.php?errormsg=Invalid credentials, please try again.'); exit();
    }
?>