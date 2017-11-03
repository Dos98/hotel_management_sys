<?php require_once("db_connection.php"); ?>
<?php require_once("header.php"); ?>
<?php require_once("functions.php"); ?>
<?php session_start(); ?>
<?php confirm_logged_in(); ?>
<!DOCTYPE html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    var fruits= [];
    function mySelect(x) {
        if(document.getElementById(x).innerHTML == "select"){
            document.getElementById(x).innerHTML = "SELECTED";
            document.getElementById(x).className="button is-primary is-small is-warning is-pulled-right";
            fruits.push(x);
        }
        else {
            document.getElementById(x).innerHTML = "select";
            document.getElementById(x).className="button is-primary is-small is-pulled-right" ;
            var index = fruits.indexOf(x);
            if (index > -1) {
                fruits.splice(index, 1);
            }
        }
    }
    function myFinalSelect() {
        if(fruits.length == 0)
        {
            alert("SELECT AT LEAST ONE ROOM");
        }
        else
        {
            fruits.sort();
            alert(fruits);
            var myJSON = JSON.stringify(fruits);
            window.location = "payment.php?rooms=" + myJSON;
        }
    }
    function Redirect() {
        window.location="bookingdates.php";
    }

</script>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ROOM TYPES</title>
    <link rel="stylesheet" type="text/css" href="css/grid-gallery.css">
</head>
<body>
<div class="container section">
    <div class="container is-fluid ">
        <figure class="image is-128x128 ">
            <img src="images/DC.png" alt="LOGO OF HOTEL WEBSITE">
            <figcaption><i>Travellers Home</i></figcaption>
        </figure>
    </div>
    <hr>
    <div class="columns section">
        <div class="column is-4">
            <div class="title">Rooms Available</div>
        </div>
    </div>
    <hr>
    <?php //print_r($_GET);
        $room_types=array();
        if(isset($_GET["room_types"])){
            $room_types=json_decode($_GET["room_types"]);
            $_SESSION["r_t"]=$room_types;
        }
        else redirect_to("room_select.php");
        $room_num=array();
        $nod_l=$_SESSION["nod_l"];
        $nod_b=$_SESSION["nod_b"];
        $q1 = "SELECT * from rooms where available = 0 ";
        $r1 = mysqli_query($connection, $q1);
        $q2 = "SELECT * from bookings";
        $r2 = mysqli_query($connection, $q2);
        if(isset($r1) && isset($r2)){
            foreach ($r1 as $x) {
                $R1 = $x["room_num"];
                foreach ($r2 as $y) {
                    $R2 = $y["room_num"];
                    if ($R1 == $R2) {
                        $sum = $nod_b + $nod_l;
                        if ($sum >= ($y["nod_left"])) {
                            array_push($room_num, $y["room_num"]);
                        }
                    }
                }
            }
        }
        //var_dump($r1);
        //var_dump($r2);
        //var_dump($room_num);
    ?>
    <?php
        $queryy  = "SELECT room_type_id,room_type_name,price from room_type";
        $results = mysqli_query($connection, $queryy);
        $count=0;
        foreach( $results as $a ) {
            $c = $a["room_type_id"];
            if (in_array($c, $room_types)){
                $query = "SELECT * from rooms where room_type_id = {$c}";
                $result = mysqli_query($connection, $query);
                if (($count % 4) == 0) {
                    echo "<div class=\"columns\">";
                }
                echo " <div class=\"column is-3\"><nav class=\"panel is-active\"><p class=\"panel-heading\">";
                echo "{$a["room_type_id"]} _ {$a["room_type_name"]} &commat; <i class=\"fa fa-inr\"></i> {$a["price"]}</p>";
                foreach ($result as $room) {
                    $rm = $room["room_num"];
                    if (in_array($rm, $room_num)) continue;
                    else {
                        echo "<a class=\"panel-block\" > <span class=\"panel-icon\"><i class=\"fa fa-bed\"></i></span>";
                        echo "$rm";
                        echo "<div class=\"control\"><button type=\"button\" class=\"button is-primary is-small is-pulled-right\" id=\"$rm\" onclick=\"mySelect('$rm')\">select</button></div></a>";
                    }
                }
                echo "</nav></div>";
                if (($count % 4) == 3) {
                    echo "</div>";
                }
                $count++;
                echo "\n";
            }
        }
        if((($count % 4) == 2) || ($count % 4) == 1 || ($count % 4) == 3){
            echo "</div>";
        }
        echo "\n";

    ?>
    <hr>
    <div class="field level-item is-grouped is-grouped-centered">
        <p class="control">
            <a href="room_select.php" class="button is-light">
                Back
            </a>
        </p>
        <a>      </a>
        <div class="control">
            <button class="button is-info" onclick="myFinalSelect()">SUBMIT</button>
        </div>
    </div>
    <hr>
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
    <script type="text/javascript" src="js/bulma.js"></script>
</body>
</html>