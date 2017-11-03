<?php require_once("db_connection.php"); ?>
<?php require_once("functions.php"); ?>
<?php require_once("header.php"); ?>
<?php session_start(); ?>
<!DOCTYPE html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    var room_type= [];
    function myfunc(x) {
        if(document.getElementById(x).innerHTML == "select"){
            document.getElementById(x).innerHTML = "SELECTED";
            document.getElementById(x).className="button is-primary is-small is-warning is-inverted" ;
            room_type.push(x);
        }
        else if(document.getElementById(x).innerHTML == "SELECTED" ){
            document.getElementById(x).className="button is-primary is-inverted is-small";
            document.getElementById(x).innerHTML = "select";
            var index = room_type.indexOf(x);
            if (index > -1) {
                room_type.splice(index, 1);
            }
        }
    }
    function myFinalSelect() {
        window.location = "admin.php";
    }

</script>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ROOM TYPES</title>
    <link rel="stylesheet" type="text/css" href="css/grid-gallery.css">
    <link rel="stylesheet" type="text/css" href="css/bulma.css">
    <link rel="stylesheet" type="text/css" href="css/better.css">
</head>
<body>
<div class="container section">
    <div class="container is-fluid ">
        <figure class="image is-128x128 ">
            <img src="images/DC.png" alt="LOGO OF HOTEL WEBSITE">
            <figcaption><i>Travellers Home</i></figcaption>
        </figure
    </div>
    <hr>
    <div class="columns section">
        <div class="column is-4">
            <div class="title">Room Types</div>
        </div>
    </div>

    <hr>

    <?php
        $query  = "SELECT * from room_type where available_count >= 0";
        $result = mysqli_query($connection, $query);
        //echo ($result);
        $count=0;
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "\n";
            if(($count % 3) == 0){
                echo "<div class=\"columns\">";
            }
            $n   = $row['room_type_id'];
            echo "<div class=\"column is-4\"><div class=\"card\" onclick=\"myfunc({$n})\"><header class=\"card-header\"><p class=\"card-header-title\"><img src=\"images/DC64.png\" class=\"avatara\">";
            $a = ucwords($row['room_type_name']);
            echo " $n &commat; $a";
            echo "\n";
            echo "</p></header><div class=\"card-image\"><figure class=\"image is-4by3\"><img src=\"https://placehold.it/1280x960\" alt=\"Image\"></figure></div><div class=\"card-content\"><div class=\"panel-block-item\"><span class=\"price\"><span class=\"icon\">  <i class=\"fa fa-inr\"></i></span>";
            $c = $row['price'];
            echo "<b>$c</b>&nbsp&nbsp";
            $d=$row['available_count'];
            echo "<div class=\"field is-grouped is-grouped-multiline is-pulled-right\"><div class=\"control\"><div class=\"tags has-addons\">";
            echo "<span class=\"tag \">Available: </span>";
            echo "<span class=\"tag is-info\">$d</span>&nbsp;&nbsp;";
            echo "<a class=\"button is-primary is-inverted\" id={$n}>select</a></div></div></div>";
            echo "</span></div></div></div></div>";
            if(($count % 3) == 2){
                echo "</div>";
            }
            $count++;
        }
        if((($count % 3) == 2) || ($count % 3) == 1){
            echo "</div>";
        }
    ?>
    <hr>
    <div class="field level-item is-grouped is-grouped-centered">
        <div class="control">
            <button class="button is-info" onclick="myFinalSelect()">BACK</button>
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
