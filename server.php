<?php
require "config.php";

$action = $_POST['action'];
$id = $_POST['id'];
if($action == "delete"){
    $sql = "DELETE FROM `catalog` WHERE id=$id";
    $res = mysqli_query($connect,$sql);
}elseif($action == "edit"){
    $price = $_GET['price'];
    $sql = "UPDATE goods SET price=$price where id=$id";
    if(mysqli_query($connect,$sql)){
        $query = "select title from goods where id=$id";
        $res = mysqli_query($connect,$query);
        $title = mysqli_fetch_assoc($res)['title'];
        header("Location: index.php?title=$title");
    }
}elseif($action == "new"){
    $fio = $_POST['fio'];
    $phone = $_POST['phone'];
    $who = $_POST['who'];
    $sql = "INSERT INTO `catalog` (`fio`, `phone`, `who`) VALUES ('$fio', '$phone', '$who');";
    $res = mysqli_query($connect,$sql);
}