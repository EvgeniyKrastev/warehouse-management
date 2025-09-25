<?php
    session_start();
    session_unset();   // чисти всички session променливи
    session_destroy();
    // be carefull with the space  this is correct Location: login.php
    header("Location: /warehouse-management/login/login.php");
    exit;
?>