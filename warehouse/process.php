<?php
if(isset($_POST["create"])){
    include("connect.php");

    $category_id = mysqli_real_escape_string($conn, $_POST["category_id"]);
    $productName = mysqli_real_escape_string($conn, $_POST["productName"]);
    $comments = mysqli_real_escape_string($conn, $_POST["comments"]);
    $buyPrice = mysqli_real_escape_string($conn, $_POST["buyPrice"]);
    $sellPrice = mysqli_real_escape_string($conn, $_POST["sellPrice"]);
    $quantity = mysqli_real_escape_string($conn, $_POST["quantity"]);

    $sqlInsert = "INSERT INTO products(category_id, productName, comments, buyPrice, sellPrice, quantity) 
                  VALUES ('$category_id', '$productName', '$comments', '$buyPrice', '$sellPrice', '$quantity')";

    if(mysqli_query($conn, $sqlInsert)){
        session_start();
        $_SESSION["create"] = "Product added successfully!";
        header("Location: index.php");
    }else{
        die("Data is not inserted! " . mysqli_error($conn));
    }
}

?>

<?php
if(isset($_POST["update"])){
    include("connect.php");

    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $category_id = mysqli_real_escape_string($conn, $_POST["category_id"]);
    $productName = mysqli_real_escape_string($conn, $_POST["productName"]);
    $comments = mysqli_real_escape_string($conn, $_POST["comments"]);
    $buyPrice = mysqli_real_escape_string($conn, $_POST["buyPrice"]);
    $sellPrice = mysqli_real_escape_string($conn, $_POST["sellPrice"]);
    $quantity = mysqli_real_escape_string($conn, $_POST["quantity"]);

    $sqlUpdate = "UPDATE products 
                  SET category_id='$category_id', productName='$productName', comments='$comments',
                      buyPrice='$buyPrice', sellPrice='$sellPrice', quantity='$quantity' 
                  WHERE id='$id'";

    if(mysqli_query($conn, $sqlUpdate)){
        session_start();
        $_SESSION["update"] = "Product updated successfully!";
        header("Location: index.php");
    }else{
        die("Data is not updated! " . mysqli_error($conn));
    }
}
?>