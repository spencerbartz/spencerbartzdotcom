<?php
    include 'crypto_util.php';

    class UsersController {
        const USER_EXISTS      = 1000;
        const INVALID_PASSWORD = 1001;
        const INVALID_EMAIL    = 1002;

        /**
         * CONSTRUCTOR
         */
        public function __construct() {
            $user = NULL;
        }

        /**
         * FUNCTION: create()
         * Creates a new user. If user already exists or if the database is temporarily 
         * unavailable, no action is taken and the function returns.
         */
        public static function create($username, $password, $email) {

            // Check if user exists in DB
            include 'dbconnect.php';

            // Get mysql connection. Exit if we cannot connect.
            $mysqli_conn = get_mysqli_connection("sitedbmain");

            $count = self::find_count_by_email($email, $mysqli_conn);

            // If user not found, create user
            if ($count === 0) {            
                // User does not exist, get a salt
                $salt = CryptoUtil::generate_salt();

                // Create password from encrypt(user_input + salt)
                $encrypted_password = crypt($password, $salt);

                // Insert record into DB
                $sql_str2 = "INSERT INTO users VALUES (NULL, '$username', '$encrypted_password', '$email', '', '$salt', '', 'guest')";

                if (!$mysqli_conn->query($sql_str2)) {
                    echo "Record Insertion Failed: (" . $mysqli_conn->errno . ") " . $mysqli_conn->error;
                }

            } else {
                echo "User already exists";
            }
        
            $mysqli_conn->close();
        }

        /**
         * FUNCTION: find_by_email()
         * Searches database for a user
         */
        public static function find_count_by_email($email, $mysqli_conn) {

            if ($mysqli_conn->connect_errno) {
                echo "Failed to connect to MySQL: (" . $mysqli_conn->connect_errno . ") " . $mysqli_conn->connect_error;
                $mysqli_conn->close();
                return;
            }

            // Fetch number of records for this email (should only be 1 or 0)
            $sql_str1 = "SELECT COUNT(*) AS count FROM users WHERE email = '$email'";
            $count = 0;

            $result = $mysqli_conn->query($sql_str1);

            if (!$result) {
                echo "Could not search users: (" . $mysqli_conn->errno . ") " . $mysqli_conn->error;
                return -1;
            } else {
                $count = $result->fetch_array()["count"];
                return intval($count);
            }
        }


        /**
         * FUNCITON: login()
         * Searches for the user supplied email in the database. If not found, return false.
         * If found, use the salt belonging to that record to recreate the password by passint the 
         * user supplied password string + salt to the crypt() function 
         */
        public static function login($username, $password, $email) {
            include 'dbconnect.php';
                        
            // Get mysql connection. Exit if we cannot connect.
            $mysqli_conn = get_mysqli_connection("sitedbmain");

            if ($mysqli_conn->connect_errno) {
                echo "Failed to connect to MySQL: (" . $mysqli_conn->connect_errno . ") " . $mysqli_conn->connect_error;
                $mysqli_conn->close();
                return false;
            }

            // Fetch number of records for this email (should only be 1 or 0)
            $sql_str1 = "SELECT COUNT(*) AS count FROM users WHERE email = '$email'";
            $count = 0;

            $result = $mysqli_conn->query($sql_str1);

            if (!$result) {
                echo "Could not search users: (" . $mysqli_conn->errno . ") " . $mysqli_conn->error;
                $mysqli_conn->close();
                return false;
            } else {
                $count = $result->fetch_array()["count"];
            }

            // If we find a record in the 1st query
            if ($count === "1") {

                // Look up record fields by username and email
                $sql_str2 = "SELECT username, password, email, salt FROM users WHERE username = '$username' AND email = '$email'";
                $salt;

                $result2 = $mysqli_conn->query($sql_str2);

                if (!$result2) {
                    echo "Record lookup Failed: (" . $mysqli_conn->errno . ") " . $mysqli_conn->error;
                } else {
                    // Get salt from database query result set
                    $rs = $result2->fetch_array();
                    $salt = $rs["salt"];
                    $dbpassword = $rs["password"];

                    // Create password from encrypt(user_input + salt)
                    $encrypted_password = crypt($password, $salt);

                    if ($encrypted_password === $dbpassword) {
                        return true;
                    }
                }
            }

            return false;

        }

        /**
         * FUNCTION: validatePassword()
         * 
         * https://stackoverflow.com/questions/5142103/regex-to-validate-password-strength
         * 
         * Minimum Criteria:
         * 8 characters in length
         * 2 Upper Case letters
         * 2 Lower Case letters
         * 1 of the following characters !@#$&*
         * 2 numerals (0-9)
         */
        public static function validate_password($password, $conf_password) {
            
            if (empty($password) || strpos('password', $password) !== false || $password !== $conf_password) {
                return false;
            }

            $regex_str = "/^(?=.*[A-Z].*[A-Z])(?=.*[!@#$&*].*[!@#$&*])(?=.*[0-9].*[0-9])(?=.*[a-z].*[a-z]).{8}$/";
            $result = preg_match($regex_str, $password);
            
            echo "result: " . $result . "<br/>";
            return $result;
        }
    }
?>