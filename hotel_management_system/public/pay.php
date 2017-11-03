<?php require_once("db_connection.php"); ?>
<?php require_once("header.php"); ?>
<?php require_once("functions.php"); ?>
<?php session_start(); ?>
<?php
    foreach ($_SESSION["rooms"] as $r) {
        $query1 = "UPDATE `rooms` SET `available`=1 WHERE `room_num`={$r}";
        $result1 = mysqli_query($connection, $query1);
    }
    $query2 = "DELETE FROM `bookings` WHERE `customer_id`={$_SESSION["cid"]}";
    $result2= mysqli_query($connection, $query2);
    var_dump($result1);
    var_dump($result2);
    //$query3 = "DELETE FROM `customer` WHERE `customer_id`={$cid}";
    //$result3= mysqli_query($connection, $query3);
    redirect_to("admin.php");
    ?>