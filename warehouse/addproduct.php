<?php
include("templates/header.php");
?>

<?php
include("connect.php");

// Вземаме категориите от базата
$sqlCategories = "SELECT id, name FROM categories";
$result = mysqli_query($conn, $sqlCategories);
?>
    
    <div class="create-form w-100 mx-auto p-4" style="max-width:500px;">
        <a href="index.php" class="btn btn-warning">Назад</a>
        <h3 class="mb-2">Add Product</h3>
        <!-- enctype="multipart/form-data" -->
        <form action="process.php" method="post" >

                <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select name="category_id" id="category" class="form-select" required>
                        <option value="">-- Select Category --</option>
                        <?php while($row = mysqli_fetch_assoc($result)) { ?>
                                <option value="<?php echo $row['id']; ?>">
                                <?php echo htmlspecialchars($row['name']); ?>
                                </option>
                        <?php } ?>
                        </select>
                </div>

            <div class="form-field mb-4">
                    <input type="text" name="productName" class="form-control" id="productName" placeholder="Enter ProductName:">
            </div>
            <div class="form-field mb-4">
                    <textarea name="comments" class="form-control" id="comments" cols="10" rows="1" placeholder="Enter Comments:"></textarea>
            </div>
            <div class="form-field mb-4">
                    <label for="photo" class="form-label">Add Photo:</label>
                    <input type="file" name="photo" id="photo" class="form-control" accept=".jpg,.jpeg,.png"/>
            </div>
            <div class="form-field mb-4">
                    <input type="text" name="buyPrice" class="form-control" id="buyPrice" placeholder="Buying Price:">
            </div>
            <div class="form-field mb-4">
                    <input type="text" name="sellPrice" class="form-control" id="sellPrice" placeholder="Sell Price:">
            </div>
            <div class="form-field mb-4">
                    <input type="text" name="quantity" class="form-control" id="quantity" placeholder="Quantity:">
            </div>
            <div class="form-field mb-4">
                    <input type="submit" name="create" value="Изпрати" class="btn btn-success" />
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