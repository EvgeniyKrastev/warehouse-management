<?php
session_start();
if(!isset($_SESSION["user"])){
    // better is to use absolute path"Location: /login/login.php" because it doesnt matter where i am in file directory is better than relative path(относителен) "Location: ../../login/login.php"
    header("Location: /warehouse-management/login/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Dashboard</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-primary-subtle text-primary-emphasis p-2">
            <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="btn btn-info me-5" href="/warehouse-management/login/logout.php">Logout</a>
                    <a class="nav-link active" href="/warehouse-management/warehouse/index.php">Warehouse</a>
                    <!-- <a class="nav-link disabled" aria-disabled="true">Disabled</a> -->
                </div>
            </div>
        </nav>

    <!-- d-flex justify-content-between make side bar go to left -->
    <!-- <div class="dashboard d-flex justify-content-between"> -->

        <!-- <div class="sidebar bg-dark min-vh-100">
            <h1 class="bg-primary p-4"><a href="./index.php" class="text-light text-decoration-none">Dashboard</a></h1>
            <div class="menues p-4 mt-5">
                
                <div class="menu mt-5">
                    <a href="/warehouse-management/warehouse/index.php" class="text-light text-decoration-none"><strong>View Warehouse</strong></a>
                </div>
                <div class="menu mt-5">
                    <a href="/warehouse-management/login/logout.php" class="btn btn-info">Logout</a>
                </div>
            </div>
        </div> -->

        