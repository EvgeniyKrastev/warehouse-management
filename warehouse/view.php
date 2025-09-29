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
                <div class="form-field mb-4">
                <label for="image" class="form-label">Current Photo:</label><br>
                <?php if (!empty($data['image'])): ?>
                    <img src="uploads/<?php echo htmlspecialchars($data['image']); ?>" 
                        alt="Current Image" 
                        style="max-width:150px; height:auto; border:1px solid #ccc; margin-bottom:10px;">
                <?php else: ?>
                    <p>No image uploaded</p>
                <?php endif; ?>
            </div>
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