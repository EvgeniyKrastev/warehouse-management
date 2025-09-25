<?php
include("templates/header.php");
?>

<div class="post w-100 bg-light p-5">
    <?php
    // we make request and we take the id and if is taken correctly we go to if()
    $id = $_GET["id"];
    if($id){
        include("connect.php");
        $sqlSelectPost = "SELECT * FROM products WHERE id = $id";  
        $result = mysqli_query($conn, $sqlSelectPost);
        while($data = mysqli_fetch_array($result)){
            ?>
                <h1><?php echo $data['productName']; ?></h1>
                <p>More info: <?php echo $data['comments']; ?></p>
                <p>Price for one: <?php echo $data['sellPrice']; ?></p>
                <p>Quantity: <?php echo $data["quantity"]?></p>
            <?php
        }
    }else{
        echo "Post Not Found";
    }
    ?>
</div>

<?php
include("templates/footer.php");
?>