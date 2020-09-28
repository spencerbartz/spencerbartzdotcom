<?php
    include '../util/util.php';
    // echo UsersController::create('okyakusan', 'ichino08102020', 'admin@spencerbartz.com');
?>
<html>
    <head>
        <title>Register</title>

        <link rel="stylesheet" href="../css/BluePigment.css" type="text/css" />
        <link rel="shortcut icon" href="../images/favicon.ico" />
        <script type="text/javascript" src="../js/jquery-1.11.2.min.js"></script>
        <script type="text/javascript" src="../js/util.js"></script>
        <!-- <meta http-equiv="refresh" content="5; URL=https://www.spencerbartz.com/ichino/" /> -->
    </head>

    <!-- content-wrap starts here -->
    <div id="content-wrap">
        <div id="content">

            <!-- Left Side (Main Content)-->
            <div id="main">

                <div class="box">
                    <h1><span class="white">Register new user</span></h1>
                    
                    <form action="process_register.php" method="POST">

                        <div>
                            <label for="username">User Name:</label>
                            <input id="username" type="text" name="username" required>
                        </div>
            
                        <div>
                            <label for="email">Password: </label>
                            <input id="password" type="password" name="password" required>
                            <span> 8 characters long including 2 uppercase, 2 lowercase, 2 numbers, and 2 of the following special characters !@#$&*</span>
                        </div>

                        <div>
                            <label for="email">Confirm Password: </label>
                            <input id="conf_password" type="password" name="conf_password" required/>
                        </div>

                        <div>
                            <label for="email">Email: </label>
                            <input id="email" type="email" name="email" required/>
                        </div>

                        <br/>
                        <div>
                            <input type="submit" value="Register"/>
                            <input type="reset" value="Reset"><br/>
                            <a href="index.php">Return to Login</a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Left Side -->

        </div>
    </div>

</body>
</html>
