<?php
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "warehouse_management";

$conn = mysqli_connect($dbHost,$dbUser,$dbPass,$dbName);

if(!$conn){
    die("Something went wrong!");
    //Винаги използвай mysqli_error($conn) при die() за да видиш точната грешка.
}
?>