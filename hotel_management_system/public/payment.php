<?php require_once("db_connection.php"); ?>
<?php require_once("header.php"); ?>
<?php require_once("functions.php"); ?>
<?php session_start(); ?>
<?php confirm_logged_in(); ?>
<script>
    function Select() {
        window.location = "book.php";
    }
</script>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog - Free Bulma template</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <!-- Bulma Version 0.6.0 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.0/css/bulma.min.css" integrity="sha256-HEtF7HLJZSC3Le1HcsWbz1hDYFPZCqDhZa9QsCgVUdw=" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="css/blog.css">
</head>
<body>

<div class="container">
    <!-- START NAV -->
    <nav class="navbar is-white">
        <div class="navbar-brand">
            <a class="navbar-item brand-text" href="">
                DC HOTELS
            </a>
            <div class="navbar-burger burger" data-target="navMenu">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div id="navMenu" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="#">
                    Home
                </a>
                <a class="navbar-item" href="#">
                    LOGOUT
                </a>
            </div>
        </div>
    </nav>
    <!-- END NAV -->

    <!-- START ARTICLE FEED -->
    <section class="articles">
        <div class="column is-8 is-offset-2">

            <!-- START PROMO BLOCK -->
            <section class="hero is-info is-bold is-small promo-block">
                <div class="hero-body">
                    <div class="container">
                        <h1 class="title">
                            DC HOTELS
                        </h1>
                        <h2 class="subtitle">
                            Travellers Home
                        </h2>
                    </div>
                </div>
            </section>
            <!-- END PROMO BLOCK -->

            <!-- START ARTICLE -->
            <div class="card article">
                <div class="card-content">
                    <div class="media">
                        <div class="media-center">
                            <img src="images/DC128.png" class="author-image" alt="Placeholder image">
                        </div>
                        <div class="media-content has-text-centered">
                            <p class="title article-title">PAYMENT DETAILS</p>
                            <p class="subtitle is-6 article-subtitle">
                                DATE: <?php echo $_SESSION["today"]; ?>
                            </p>
                        </div>
                    </div>
                    <?php
                    $query  = "SELECT * from customer where customer_id='{$_SESSION["cid"]}'";
                    $result = mysqli_query($connection, $query);
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $rooms=array();
                    if(isset($_GET["rooms"])) {
                        $rooms = json_decode($_GET["rooms"]);
                        $_SESSION["rooms"]=$rooms;
                        //var_dump($rooms);
                    }
                    $pay=0;
                    $roomTypes=array();
                    $query1  = "SELECT * from rooms";
                    $res = mysqli_query($connection, $query1);
                    foreach($res as $r) {
                        if(in_array($r["room_num"],$rooms))
                        {
                            array_push($roomTypes,$r["room_type_id"]);
                        }
                    }
                    //var_dump($roomTypes);
                    $query2  = "SELECT * from room_type";
                    $resu = mysqli_query($connection, $query2);
                    foreach($resu as $r) {
                        if(in_array($r["room_type_id"],$roomTypes))
                        {
                            $count=0;
                            foreach($roomTypes as $e)
                            {
                                if($e==$r["room_type_id"])
                                    $count+=1;

                            }
                            if($count==0)
                                $pay+=((int)$r["price"]);
                            else
                                $pay+=((int)$r["price"])*$count;
                        }
                    }
                    $_SESSION["pay"]=$pay;
                    ?>
                    <div class="content article-body">
                        <table>
                            <caption>BOOKING DETAILS</caption>
                            <tr>
                                <td>CUSTOMER ID: </td>
                                <td><?php echo $_SESSION["cid"]; ?></td>
                            </tr>
                            <tr>
                                <td>NAME : </td>
                                <td><?php echo ucfirst($_SESSION["fn"])." ".ucfirst($_SESSION["ln"]); ?></td>
                            </tr>
                            <tr>
                                <td>CHECK IN DATE: </td>
                                <td><?php echo $_SESSION["cin"]; ?></td>
                            </tr>
                            <tr>
                                <td>CHECK OUT DATE:</td>
                                <td><?php echo $_SESSION["cout"]; ?></td>
                            </tr>
                            <tr>
                                <td>ROOM NUM:</td>
                                <td><?php foreach ($rooms as $x) {echo $x.", " ; }?></td>
                            </tr>
                            <tr>
                                <td>TOTAL AMOUNT :</td>
                                <td><?php echo $pay; ?></td>
                            </tr>
                            <tr>
                                <td>AMOUNT TO BE PAID FOR BOOKING :</td>
                                <td><?php echo $pay/10; ?></td>
                            </tr>
                            <tr>
                                <td>AMOUNT TO BE PAID AT CHECK OUT (Inclusive of GST) :</td>
                                <td><?php echo $pay*9/10; ?></td>
                            </tr>
                        </table>
                        <p></p>
                        <h3 class="has-text-centered"></h3>
                        <p>
                            <b>NOTE:</b> This is a computer Generated Receipt and does not require physical signature.
                        </p>
                    </div>
                    <div class="field level-item is-grouped is-grouped-centered">
                        <p class="control">
                            <a href="room_no_select.php" class="button is-light">
                                Back
                            </a>
                        </p>
                        <a>      </a>
                        <div class="control">
                            <button class="button is-primary" onclick="Select()">BOOK</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END ARTICLE -->
    </section>
    <!-- END ARTICLE FEED -->
</div>
<script async type="text/javascript" src="js/bulma.js"></script>
</body>
</html>