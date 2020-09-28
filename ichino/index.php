<?php
    include '../util/util.php';
    $error_msg = isset($_GET["errormsg"]) ? $_GET["errormsg"] : "";
?>
<!doctype html>
<html>
    <head>
        <title>Sign In</title>

        <link rel="stylesheet" href="../css/BluePigment.css" type="text/css" />
        <link rel="shortcut icon" href="../images/favicon.ico" />
        <script type="text/javascript" src="../js/jquery-1.11.2.min.js"></script>
        <script type="text/javascript" src="../js/util.js"></script>
    </head>

    <!-- content-wrap starts here -->
    <div id="content-wrap">
        <div id="content">

            <!-- Right side search box area -->
            <!-- <div id="sidebar">
                <div class="sidebox">
                    <h1><span class="white">Not registered?</span></h1>
                    <h1><a href="register.php">Request an account</a></h1>
                </div>
            </div> -->
            <!-- End Right Side -->

            <!-- Left Side (Main Content)-->
            <div id="main">

                <div class="box">
                    <h1><span class="white">Sign in</span></h1>
                    <h3><span><?php echo $error_msg; ?></h3>
                    <form action="imgview.php" method="POST">

                        <div>
                            <label for="username">User Name:</label>
                            <input type="text" name="username" id="username" required>
                        </div>
            
                        <div>
                            <label for="password">Password: </label>
                            <input type="password" name="password" id="password" required>
                        </div>

                        <div>
                            <label for="email">Email: </label>
                            <input type="email" name="email" id="email" required>
                        </div>
                        <br/>
                        <div>
                            <input type="submit" value="Sign in">
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Left Side -->

        </div>
    </div>

    </body>
</html>
