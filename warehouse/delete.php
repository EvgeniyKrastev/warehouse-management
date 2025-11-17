<?php 
$id =  $_GET["id"];
if($id){
    include("../connect.php");
    $sqlDelete = "DELETE FROM products WHERE id = $id";
if(mysqli_query($conn,$sqlDelete)){
    session_start();
    $_SESSION["delete"] = "Product deleted successfully!";
    header("Location: index.php");
}else{
    die("Something is not write. Product is not deleted!");
}
}else{
    echo "Post not found!";
}
?>