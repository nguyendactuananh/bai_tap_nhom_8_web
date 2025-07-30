<?php
    include('connect.php');
    $id = $_GET['id'];
    $sql = "DELETE FROM `test` WHERE `TestID` = $id";
    mysqli_query($conn, $sql);
    header('location: trang_chu.php');
?>