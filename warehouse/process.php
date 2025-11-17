<?php
if(isset($_POST["create"])){
    include("../connect.php");

    $category_id = mysqli_real_escape_string($conn, $_POST["category_id"]);
    $productName = mysqli_real_escape_string($conn, $_POST["productName"]);
    $comments = mysqli_real_escape_string($conn, $_POST["comments"]);
    $buyPrice = mysqli_real_escape_string($conn, $_POST["buyPrice"]);
    $sellPrice = mysqli_real_escape_string($conn, $_POST["sellPrice"]);
    $quantity = mysqli_real_escape_string($conn, $_POST["quantity"]);

    $fileName = $_FILES["image"]["name"];
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    $allowedTypes = array("jpg","jpeg","png", "gif");
    $tempName = $_FILES["image"]["tmp_name"];
    $targetPath = "uploads/".$fileName;

    $sqlInsert = "INSERT INTO products(category_id, productName, comments, buyPrice, sellPrice, quantity, image) 
                  VALUES ('$category_id', '$productName', '$comments', '$buyPrice', '$sellPrice', '$quantity','$fileName')";

    if(in_array($ext,$allowedTypes)){
        if(move_uploaded_file($tempName,$targetPath)){
            // $query = "INSERT INTO products (filename) VALUES ('$fileName')";
            if(mysqli_query($conn,$sqlInsert)){
                header("Location: index.php");
                session_start();
                $_SESSION["create"] = "Product added successfully!";
                // header("Location: index.php");
            }else{
                // echo "Something is wrong with connection for image!";
                die("Data is not inserted! " . mysqli_error($conn));
            }
        }else{
            echo "File is not uploaded!";
        }
    }else{
        echo "Your files are not allowed!";
    }

}

?>

<?php
if(isset($_POST["update"])){
    include("../connect.php");

    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $category_id = mysqli_real_escape_string($conn, $_POST["category_id"]);
    $productName = mysqli_real_escape_string($conn, $_POST["productName"]);
    $comments = mysqli_real_escape_string($conn, $_POST["comments"]);
    $buyPrice = mysqli_real_escape_string($conn, $_POST["buyPrice"]);
    $sellPrice = mysqli_real_escape_string($conn, $_POST["sellPrice"]);
    $quantity = mysqli_real_escape_string($conn, $_POST["quantity"]);

       // Текущото изображение от скритото поле
    $currentImage = mysqli_real_escape_string($conn, $_POST["current_image"]);
    $newImage = $currentImage; // по подразбиране запазваме старото

    // Проверка дали е качен нов файл
    if (!empty($_FILES['image']['name'])) {
        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $fileName = $_FILES["image"]["name"];
            $ext      = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowed  = ["jpg","jpeg","png","gif"];

            if (in_array($ext, $allowed)) {
                $targetPath = "uploads/" . basename($fileName);
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath)) {
                    $newImage = $fileName;
                } else {
                    echo "❌ Грешка при качването на новото изображение.";
                }
            } else {
                echo "❌ Невалиден тип файл.";
            }
        }
    }

    $sqlUpdate = "UPDATE products 
                  SET category_id='$category_id',
                productName='$productName',
                comments='$comments',
                buyPrice='$buyPrice',
                sellPrice='$sellPrice',
                quantity='$quantity',
                image ='$newImage' 
                WHERE id='$id'";

    if(mysqli_query($conn, $sqlUpdate)){
        session_start();
        $_SESSION["update"] = "Product updated successfully!";
        header("Location: index.php");
        exit;
    }else{
        die("Data is not updated! " . mysqli_error($conn));
    }
}
?>