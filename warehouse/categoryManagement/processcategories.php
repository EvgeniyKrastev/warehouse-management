<?php
include("../../connect.php");
session_start();

if (isset($_POST["create"])) {

    $categoryName = mysqli_real_escape_string($conn, $_POST["categoryName"]);

    $sqlInsert = "INSERT INTO categories(name) VALUES ('$categoryName')";

    if (mysqli_query($conn, $sqlInsert)) {
        $_SESSION["create"] = "Category added successfully!";
        header("Location: index.php");
        exit;
    } else {
        die("Insert failed: " . mysqli_error($conn));
    }
}


if (isset($_POST["update"])) {

    // 🔥 Получаваме ID (липсваше ти!)
    if (!isset($_POST["id"]) || empty($_POST["id"])) {
        die("Error: Missing category ID for update.");
    }

    $id = intval($_POST["id"]); // безопасно число
    $categoryName = mysqli_real_escape_string($conn, $_POST["categoryName"]);

    // 🔥 Правилна SQL заявка
    $sqlUpdate = "UPDATE categories 
                  SET name='$categoryName'
                  WHERE id='$id'";

    if (mysqli_query($conn, $sqlUpdate)) {
        $_SESSION["update"] = "Category updated successfully!";
        header("Location: index.php");
        exit;
    } else {
        die("Update failed: " . mysqli_error($conn));
    }
}
?>
