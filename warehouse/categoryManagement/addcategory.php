<?php
include("../../templates/header.php");
?>
 <?php
include("../../connect.php");
// Вземаме категориите от базата
$sqlCategories = "SELECT category_id, name FROM categories";
$result = mysqli_query($conn, $sqlCategories);
?>
    <div class="create-form w-100 mx-auto p-4" style="max-width:500px;">
        <a href="../index.php" class="btn btn-warning">Назад</a>
        <h3 class="mb-2">Add Category</h3>
        <!-- enctype="multipart/form-data" -->
        <form action="processcategories.php" method="post" enctype="multipart/form-data">
            <div class="form-field mb-4">
                <input type="text" name="categoryName" class="form-control" id="categoryName" placeholder="Enter Category Name:">
            </div>
            <div class="form-field mb-4">
                <input type="submit" name="create" value="Изпрати" class="btn btn-success" />
            </div>
        </form>
    </div>
<?php
include("../../templates/footer.php");
?>