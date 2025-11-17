<?php
include("../templates/header.php");
?>

<?php
include("../connect.php");

// Вземаме категориите от базата
$sqlCategories = "SELECT id, name FROM categories";
$result = mysqli_query($conn, $sqlCategories);
?>
    <div class="create-form w-100 mx-auto p-4" style="max-width:500px;">
        <a href="index.php" class="btn btn-warning">Назад</a>
        <h3 class="mb-2">Add Product</h3>
        <!-- enctype="multipart/form-data" -->
        <form action="process.php" method="post" enctype="multipart/form-data">
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
                <label for="image" class="form-label">Add Photo:</label>
                <input type="file" name="image" id="image" class="form-control" accept=".jpg,.jpeg,.png"/>

                <!-- Контейнер за преглед -->
                <div id="preview-container" style="margin-top:10px;">
                        <img id="preview" src="" alt="No image selected" 
                        style="max-width:150px; height:auto; display:none; border:1px solid #ccc;"/>
                </div>
            </div>

            <div class="form-field mb-4">
                    <input type="text" name="buyPrice" class="form-control" id="buyPrice" placeholder="Buying Price:" required>
            </div>
            <div class="form-field mb-4">
                    <input type="text" name="sellPrice" class="form-control" id="sellPrice" placeholder="Sell Price:" required>
            </div>
            <div class="form-field mb-4">
                    <input type="text" name="quantity" class="form-control" id="quantity" placeholder="Quantity:">
            </div>
            <div class="form-field mb-4">
                    <input type="text" name="code" class="form-control" id="quantity" placeholder="Code (unique): doesn't work for now" required>
            </div>
            <div class="form-field mb-4">
                    <input type="submit" name="create" value="Изпрати" class="btn btn-success" />
            </div>
        </form>

        <script>
        document.getElementById('image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('preview');

        if (file) {
                // Проверка за тип файл (по желание)
                const allowed = ['image/jpeg','image/png','image/gif'];
                if (!allowed.includes(file.type)) {
                alert('Please select a JPG, PNG, or GIF image.');
                preview.style.display = 'none';
                preview.src = '';
                return;
                }

                // Показване на избраната снимка
                const reader = new FileReader();
                reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
        } else {
                // Ако няма избран файл
                preview.style.display = 'none';
                preview.src = '';
        }
        });
        </script>


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
include("../templates/footer.php");
?>