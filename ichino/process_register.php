<?php
    include '../util/users_controller.php';

    $username      = $_POST["username"];
    $password      = $_POST["password"];
    $conf_password = $_POST["conf_password"];
    $email         = $_POST["email"];

    echo $username . "<br/>";
    echo $password . "<br/>";
    echo $conf_password . "<br/>";
    echo $email . "<br/>";

    $is_password_valid = UsersController::validate_password($password, $conf_password);
    
    if ($is_password_valid) {
        UsersController::create($username, $password, $email);
        echo "User created successfully<br/>";
    } else {
        echo "Password is not valid<br/>";
    }
?>