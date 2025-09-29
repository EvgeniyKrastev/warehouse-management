<?php
include("templates/header.php");
?>
    <?php
    $id = $_GET['id'];
    if($id){
        include("connect.php");
        $sqlEdit = "SELECT * FROM products WHERE id = $id";
        $result = mysqli_query($conn,$sqlEdit); 
        $product = mysqli_fetch_assoc($result); 
        // for what is this $product = mysqli_fetch_assoc($result);
        $sqlCategories = "SELECT * FROM categories";
        $categoriesResult = mysqli_query($conn, $sqlCategories);

    }else{
        echo "No posts found!";
        exit;
    }

    ?>
    
    <div class="create-form w-100 mx-auto p-4" style="max-width:500px;">
        <a href="index.php" class="btn btn-warning">Назад</a>
        <h3 class="mb-2">Edit Product</h3>
        <!-- enctype="multipart/form-data" -->
        <form action="process.php" method="post" enctype="multipart/form-data">
            
            <!-- Динамично падащо меню -->
            <div class="mb-4">
                <label for="category" class="form-label">Category</label>
                <select name="category_id" id="category" class="form-select" required>
                    <option value="">-- Select Category --</option>
                    <?php while($cat = mysqli_fetch_assoc($categoriesResult)) { ?>
                        <option value="<?php echo $cat['id']; ?>"
                            <?php if($cat['id'] == $product['category_id']) echo "selected"; ?>>
                            <?php echo htmlspecialchars($cat['name']); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-field mb-4">
                <input type="text" name="productName" class="form-control" id="productName"
                       placeholder="Enter ProductName:" value="<?php echo $product['productName']; ?>">
            </div>

            <div class="form-field mb-4">
                <textarea name="comments" class="form-control" id="comments" cols="10" rows="1"
                          placeholder="Enter Comments:"><?php echo $product['comments']; ?></textarea>
            </div>
            <div class="form-field mb-4">
                <label for="image" class="form-label">Current Photo:</label><br>
                <?php if (!empty($product['image'])): ?>
                    <img src="uploads/<?php echo htmlspecialchars($product['image']); ?>" 
                        alt="Current Image" 
                        style="max-width:150px; height:auto; border:1px solid #ccc; margin-bottom:10px;">
                <?php else: ?>
                    <p>No image uploaded</p>
                <?php endif; ?>
            </div>

            <!-- Скриваме името на текущия файл, за да го запазим при нужда -->
            <input type="hidden" name="current_image" value="<?php echo htmlspecialchars($product['image']); ?>">

            <div class="form-field mb-4">
                    <label for="photo" class="form-label">Add Photo:</label>
                    <input type="file" name="image" id="image" class="form-control" accept=".jpg,.jpeg,.png"/>
            </div>

            <div class="form-field mb-4">
                <input type="text" name="buyPrice" class="form-control" id="buyPrice"
                       placeholder="Buying Price:" value="<?php echo $product['buyPrice']; ?>">
            </div>

            <div class="form-field mb-4">
                <input type="text" name="sellPrice" class="form-control" id="sellPrice"
                       placeholder="Sell Price:" value="<?php echo $product['sellPrice']; ?>">
            </div>

            <div class="form-field mb-4">
                <input type="text" name="quantity" class="form-control" id="quantity"
                       placeholder="Quantity:" value="<?php echo $product['quantity']; ?>">
            </div>

            <!-- Hidden input за ID -->
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

            <div class="form-field mb-4">
                <input type="submit" name="update" value="Запази" class="btn btn-success" />
            </div>
        </form>

        <!-- <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            echo "<h3>POST данни:</h3>";
            echo "<pre>";
            print_r($_POST);
            echo "</pre>";

            echo "<h3>FILES данни:</h3>";
            echo "<pre>";
            print_r($_FILES);
            echo "</pre>";
        }
        ?> -->

    </div>

<?php
include("templates/footer.php");
?>