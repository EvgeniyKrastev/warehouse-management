<?php
include("../../templates/header.php");
?>

<div class="posts-list w-100 p-5">
    <?php
        if(isset($_SESSION["create"])) {
        ?>
        <div class="alert alert-success">
            <?php
            echo $_SESSION["create"];
            ?>
        </div>
        <?php
        unset($_SESSION["create"]);
        }
        ?>
        <?php
        if(isset($_SESSION["update"])) {
        ?>
        <div class="alert alert-success">
            <?php
                echo $_SESSION["update"];
            ?>
        </div>
        <?php
            unset($_SESSION["update"]);
        }
        ?>
        <?php
        if(isset($_SESSIO["delete"])){
        ?>
        <div class="alert alert-success">
            <?php
                echo $_SESSION["delete"];
            ?>
        </div>
        <?php
        unset($_SESSION["delete"]);
        }
    ?>

    <div class="button">
        <a class="btn btn-info" href="addcategory.php">Add Category</a>
    </div>

    <table class="table tabled-bordered">
        <thead>
            <tr>
                <th style="width:15%;">Category Name</th>
            </tr> 
        </thead>
        <tbody>
        <?php
        include('../../connect.php');
        $sqlSelect = "SELECT * FROM categories";
        $result = mysqli_query($conn, $sqlSelect);

        if (mysqli_num_rows($result) > 0): 
            while ($data = mysqli_fetch_array($result)): 
        ?>
            <tr>
                <td><?php echo htmlspecialchars($data["name"]); ?></td>
                <td>
                    <a class="btn btn-warning" href="editcategory.php?id=<?php echo $data["id"]; ?>">Edit</a>
                    <a class="btn btn-danger" href="deletecategory.php?id=<?php echo $data["id"]; ?>">Delete</a>
                </td>
            </tr>
        <?php
            endwhile;
        else:
        ?>
            <tr>
                <td colspan="6" class="text-center text-muted">No products found</td>
            </tr>
        <?php endif; ?>
        </tbody>

    </table>
</div>

<?php
include("../../templates/footer.php");
?>