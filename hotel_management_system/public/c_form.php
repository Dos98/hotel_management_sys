<?php require_once("header.php"); ?>
<?php require_once("db_connection.php"); ?>
<?php require_once("functions.php"); ?>
<?php require_once("validation_functions.php"); ?>
<?php session_start(); ?>
<?php confirm_logged_in(); ?>
<?php
    $query  = "SELECT * from customer ORDER BY customer_id DESC";
    $result = mysqli_query($connection, $query);
    if(isset($result)){
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $cid=$row["customer_id"]+1;
        if($cid<1000000000) $cid=1000000001;
    }


    $_SESSION["cid"]=$cid;
    if (isset($_POST['submit'])) {
        // Process the form by post request
        //print_r($_POST);
        $fn = mysql_prep($_POST["fn"]);
        $mn = mysql_prep($_POST["mn"]);
        $ln = mysql_prep($_POST["ln"]);
        $em= mysql_prep($_POST["em"]);
        $pn =$_POST["pn"];
        $ms = mysql_prep($_POST["ms"]);
        $ci = mysql_prep($_POST["ci"]);
        $pi =$_POST["pi"];
        $co = mysql_prep($_POST["co"]);
        $va =$_POST["va"];

        // validations
        $required_fields = array("fn", "ln", "pn","ci","va");
        validate_presences($required_fields);

        $fields_with_max_lengths = array("fn" => 20 ,"ln" => 20 ,"pn" => 10 ,"va" => 16 );
        validate_max_lengths($fields_with_max_lengths);

        $fields_with_fixed_lengths = array("pn" => 10 ,"va" => 16 , "pi" => 6);
        validate_fixed_lengths($fields_with_fixed_lengths);

        $email_fields = array("em");
        validate_email($email_fields);

        $numeric_fields = array("pn","pi","va");
        validate_numeric($numeric_fields);

        if(empty($errors)){
            $_SESSION["fn"]=$fn;
            $_SESSION["mn"]=$mn;
            $_SESSION["ln"]=$ln;
            $_SESSION["em"]=$em;
            $_SESSION["pn"]=$pn;
            $_SESSION["ms"]=$ms;
            $_SESSION["ci"]=$ci;
            $_SESSION["pi"]=$pi;
            $_SESSION["co"]=$co;
            $_SESSION["va"]=$va;
            redirect_to("bookingdates.php");
        }
    }
    else
    {
        $fn = "";
        $mn = "";
        $ln = "";
        $em = "";
        $pn = NULL;
        $ms = "";
        $ci = "";
        $pi = NULL;
        $co = "";
        $va = NULL;
    }
?>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).on('click', '.notification > button.delete', function() {
        $(this).parent().addClass('is-hidden');
        return false;
    });
</script>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <title>Register - Coustomer</title>
</head>
<body>
<section class="hero is-fullheight is-dark is-bold">
    <div class="hero-body">
        <div class="container">
            <div class="columns is-vcentered">
                <div class="column is-6 is-offset-3"}>
                    <h1 class="title">
                        Register the Customer
                    </h1>
                    <div class="box">
                        <figure class="avatar">
                            <img src="images/DC128.png">
                            <figcaption><i>Travellers Home</i></figcaption>
                        </figure>
                        <form accept-charset="UTF-8" action="c_form.php" autocomplete="off" method="POST" target="_self">
                            <div class="field is-grouped is-grouped-multiline">
                                <div class="control">
                                    <div class="tags has-addons">
                                        <span class="tag is-primary is-medium">Customer ID</span>
                                        <span class="tag is-info is-medium"><?php echo $cid; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">First Name</label>
                                <div class="control">
                                    <input class="input" name="fn" type="text" value="<?php echo htmlspecialchars($fn); ?>" placeholder="Text input" maxlength="20">
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Middle Name</label>
                                <div class="control">
                                    <input class="input" type="text" name="mn" value="<?php echo htmlspecialchars($mn); ?>"placeholder="Text input" maxlength="1">
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Last Name</label>
                                <div class="control">
                                    <input class="input" type="text" name="ln" value="<?php echo htmlspecialchars($ln); ?>" placeholder="Text input" maxlength="20">
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Email</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input class="input is-info" type="email" name="em" value="<?php echo htmlspecialchars($em); ?>" placeholder="hello@someone.com">
                                    <span class="icon is-small is-left">
                                            <i class="fa fa-envelope"></i>
                                            </span>
                                    <span class="icon is-small is-right">
                                            <i class="fa fa-check"></i>
                                            </span>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Phone Number</label>
                                <div class="control">
                                    <input class="input" type="integer" name="pn" value="<?php echo $pn; ?>" placeholder="Text input" maxlength="10" size="10">
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Address</label>
                                <div class="control">
                                    <textarea class="textarea" name="ms" value="<?php echo htmlspecialchars($ms); ?>"   maxlength="100"></textarea>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">City</label>
                                <div class="control">
                                    <input class="input" type="text" name="ci" value="<?php echo htmlspecialchars($ci); ?>" placeholder="Text input" maxlength="10">
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Pincode</label>
                                <div class="control">
                                    <input class="input" type="integer" name="pi" value="<?php echo htmlspecialchars($pi); ?>" placeholder="Text input" maxlength="6" size="6">
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Country</label>
                                <div class="control">
                                    <input class="input" type="text" name="co" value="<?php echo htmlspecialchars($co); ?>" placeholder="Text input" maxlength="10">
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Aadhaar/Visa</label>
                                <div class="field">
                                    <div class="control">
                                        <input class="input" name="va" value="<?php echo $va; ?>" type="number" placeholder="●●●●●●●●●●●●●●●●" maxlength="16">
                                    </div>
                                </div>
                            </div>
                            <div class="field is-grouped is-grouped-centered">
                                <p class="control">
                                    <button class="button is-primary" type="submit" name="submit" value="Create Customer" >
                                        Submit
                                    </button>
                                </p>
                                <p class="control">
                                    <a href="admin.php" class="button is-light">
                                        Cancel
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
            //error printing
            if (!empty($errors)) {
                //print_r($errors);
                echo "<div class=\"column  is-one-quarter\">";
                foreach ($errors as $a => $b) {
                    echo "<div class=\"notification is-warning\"><button class=\"delete\"></button>";
                    echo "$b";
                    echo "</div>";
                }
                echo "</div>";
            }
        ?>
    </div>
</section>
</body>
<footer class="footer">
    <div class="container">
        <div class="content has-text-centered">
            <p>
                <strong>DC hotels</strong> by <a href="">Ayush Dosaj, Poorvit Jain, Medha Reddy</a>. The source code is licensed
                <a href="">VIT</a>. The website content
                is licensed.
            </p>
            <p>
                <a class="icon" href="https://github.com/">
                    <i class="fa fa-github"></i>
                </a>
            </p>
        </div>
    </div>
</footer>
</html>