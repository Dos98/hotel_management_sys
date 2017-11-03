<?php require_once("db_connection.php"); ?>
<?php require_once("header.php"); ?>
<?php require_once("functions.php"); ?>
<?php require_once("validation_functions.php"); ?>
<?php session_start();
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Free Bulma template</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <!-- Bulma Version 0.6.0 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.0/css/bulma.min.css" integrity="sha256-HEtF7HLJZSC3Le1HcsWbz1hDYFPZCqDhZa9QsCgVUdw=" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<?php
    $username = "";
    $_SESSION["message"]="";
    if (isset($_POST['submit'])) {
        // Process the form
        // validations
        $required_fields = array("username", "password");
        validate_presences($required_fields);
        if (empty($errors)) {
            // Attempt Login
            $username = $_POST["username"];
            $password = $_POST["password"];

            $found_admin = attempt_login($username, $password);

            if ($found_admin) {
                // Success
                // Mark user as logged in
                $_SESSION["admin_id"] = $found_admin["username"]."DC";
                $_SESSION["username"] = $found_admin["username"];
                redirect_to("admin.php");
            } else {
                // Failure
                $_SESSION["message"] = "Username/password not found.";
            }
        }
    } else {
        // This is probably a GET request

    } // end: if (isset($_POST['submit']))
?>
<body>
<section class="hero is-success is-fullheight">
    <div class="hero-body">
        <div class="container has-text-centered">
            <div class="column is-4 is-offset-4">
                <h3 class="title has-text-grey">Login</h3>
                <p class="subtitle has-text-grey">Please login to proceed.</p>
                <div class="box">
                    <figure class="avatar">
                        <img src="images/DC64.png">
                    </figure>
                    <form action="login.php" method="post">
                        <p>DC HOTELS</p>
                        <br>
                        <div class="field">
                            <div class="control">
                                <input class="input is-large" type="text" name="username" placeholder="Your Email" autofocus="">
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <input class="input is-large" type="password" name="password" placeholder="Your Password">
                            </div>
                        </div>
                        <div class="field is-grouped is-grouped-centered">
                            <p class="control">
                                <button class="button is-primary" type="submit" name="submit" value="Submit" >
                                    Login
                                </button>
                            </p>
                            <p class="control">
                                <a href="admin.php" class="button is-light">
                                    Cancel
                                </a>
                            </p>
                            <br>
                            <p><?php echo $_SESSION["message"];?></p>
                        </div>
                    </form>
                </div>s
            </div>
        </div>
    </div>
</section>
<script async type="text/javascript" src="js/bulma.js"></script>
</body>
</html>