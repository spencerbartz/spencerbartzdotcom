<?php
    include '../util/users_controller.php';
    include '../util/string_util.php';

    $username = $_POST["username"];
    $password = $_POST["password"];
    $email    = $_POST["email"];

    // HTML5 forms should save us from this but just in case, check that user entered all fields
    if (is_null($username) || is_null($password) || is_null($email)) {
        header('Location: index.php?errormsg=Please fill out all fields'); exit();
    }

    $logged_in = UsersController::login($username, $password, $email);

    if ($logged_in) {
        echo "<!doctype html>";
        echo "<html>";
        echo "<head><title>Tyrone Jones Raps</title>";
    }

?>
