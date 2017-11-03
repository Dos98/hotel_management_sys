<?php require_once("db_connection.php"); ?>
<?php require_once("header.php"); ?>
<?php require_once("functions.php"); ?>
<?php session_start(); ?>

<?php
    $cid=(string)$_SESSION["cid"];
    $fn=$_SESSION["fn"];
    $mn=$_SESSION["mn"];
    $ln=$_SESSION["ln"];
    $em=$_SESSION["em"];
    $pn=$_SESSION["pn"];
    $ms=$_SESSION["ms"];
    $ci=$_SESSION["ci"];
    $pi=$_SESSION["pi"];
    $co=$_SESSION["co"];
    $va=$_SESSION["va"];
    $pay=$_SESSION["pay"];
    $cin=$_SESSION["cin"];
    $cout=$_SESSION["cout"];
    $query1 = "INSERT INTO `customer` (`customer_id`, `f_name`, `m_name`, `l_name`, `address`, `pincode`, `city`, `country`, `aadhaar_visa`, `email`, `phone`, `payment`, `check_in`, `check_out`) VALUES ('{$cid}', '{$fn}', '{$mn}', '{$ln}', '{$ms}', '{$pi}', '{$ci}', '{$co}', '{$va}', '{$em}', '{$pn}',{$pay},'{$cin}','{$cout}')";
    $result1 = mysqli_query($connection, $query1);
    foreach ($_SESSION["rooms"] as $r) {
        $query2="INSERT INTO `bookings` (`customer_id`, `room_num`, `nod_left`, `nod_booking`) VALUES ('{$cid}', '{$r}', '{$_SESSION["nod_l"]}', '{$_SESSION["nod_b"]}')";
        $result2 = mysqli_query($connection, $query2);
        $query3="UPDATE `rooms` SET `available`=0 WHERE `room_num`={$r}";
        $result3 = mysqli_query($connection, $query3);
    }
    redirect_to("admin.php");
    ?>