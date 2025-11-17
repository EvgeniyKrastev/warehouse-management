<?php
include("../../templates/header.php");
?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    include("../../connect.php");
    $sqlEdit = "SELECT * FROM categories WHERE category_id = $id";
    $result = mysqli_query($conn,$sqlEdit); 
    $category = mysqli_fetch_assoc($result); 

    $sqlCategories = "SELECT * FROM categories";
    $categoriesResult = mysqli_query($conn, $sqlCategories);
} else {
    echo "No posts found!";
    exit;
}

?>  

 <?php
include("../../connect.php");
// Вземаме категориите от базата
$sqlCategories = "SELECT category_id, name FROM categories";
$result = mysqli_query($conn, $sqlCategories);
?>
    <div class="create-form w-100 mx-auto p-4" style="max-width:500px;">
        <a href="index.php" class="btn btn-warning">Назад</a>
        <h3 class="mb-2">Edit Category</h3>
        <!-- enctype="multipart/form-data" -->
        <form action="processcategories.php" method="post" enctype="multipart/form-data">
             <div class="form-field mb-4">
                <input type="text" name="categoryName" class="form-control" id="categoryName"
                       placeholder="Enter categoryName:" value="<?php echo $category['name']; ?>">
            </div>
             <input type="hidden" name="id" value="<?php echo $category['category_id']; ?>">

            <div class="form-field mb-4">
                <input type="submit" name="update" value="Изпрати" class="btn btn-success" />
            </div>
        </form>
    </div>
<?php
include("../../templates/footer.php");
?>