<?php
include("../templates/header.php");
?>

<div class="post w-100 bg-light p-5">
    <?php
    // we make request and we take the id and if is taken correctly we go to if()
    $id = $_GET["id"];
    if($id){
        include("../connect.php");
        $sqlSelectPost = "SELECT * FROM products WHERE product_id = $id";  
        $result = mysqli_query($conn, $sqlSelectPost);
        while($data = mysqli_fetch_array($result)){
            ?>

                <div class="card" style="width: 13rem;">
                <?php if (!empty($data['image'])): ?>
                        <img src="uploads/<?php echo htmlspecialchars($data['image']); ?>" 
                            alt="Current Image" 
                            style="border-radius: 2%">
                    <?php else: ?>
                        <p>No image uploaded</p>
                    <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $data['productName']; ?></h5>
                    <p class="card-text"><?php echo $data['comments']; ?></p>
                    <p>Price for one: <?php echo $data['sellPrice']; ?></p>
                    <p>Quantity: <?php echo $data["quantity"]?></p>
                </div>
            </div>
            <?php
        }
    }else{
        echo "Post Not Found";
    }
    ?>
</div>

<?php
include("../templates/footer.php");
?>