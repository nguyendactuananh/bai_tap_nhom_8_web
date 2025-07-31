<?php
    include('connect.php');
    $id = $_GET['id'];
    $sql = "DELETE FROM `news` WHERE `NewsID` = $id";
    mysqli_query($conn, $sql);
    header('location: trang_chu.php');
?>