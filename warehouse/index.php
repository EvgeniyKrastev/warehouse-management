<?php
include("templates/header.php");
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
    <table class="table tabled-bordered">
        <thead>
            <tr>
                <th style="width:15%;">Product Name</th>
                <th style="width:20%;">Image</th>
                <th style="width:25%;">Comments</th>
                <th style="width:15%;">Sell Price</th>
                <th style="width:5%;">Quantity</th>
                <th style="width:20%;">Options</th>
            </tr>
        </thead>
        <tbody>
        <?php
        include('connect.php');
        $sqlSelect = "SELECT * FROM products";
        $result = mysqli_query($conn, $sqlSelect);

        if (mysqli_num_rows($result) > 0): 
            while ($data = mysqli_fetch_array($result)): 
        ?>
            <tr>
                <td><?php echo htmlspecialchars($data["productName"]); ?></td>
                <td>
                    <div class="form-field mb-4">
                        <!-- <label for="image" class="form-label">Current Photo:</label><br> -->
                        <?php if (!empty($data['image'])): ?>
                            <img src="uploads/<?php echo htmlspecialchars($data['image']); ?>" 
                                alt="Current Image" 
                                style="max-width:150px; height:auto; border:1px solid #ccc; margin-bottom:10px;">
                        <?php else: ?>
                            <p>No image uploaded</p>
                        <?php endif; ?>
                    </div>
                </td>
                <td><?php echo htmlspecialchars($data["comments"]); ?></td>
                <td><?php echo htmlspecialchars($data["sellPrice"]); ?></td>
                <td><?php echo htmlspecialchars($data["quantity"]); ?></td>
                <td>
                    <a class="btn btn-info" href="view.php?id=<?php echo $data["id"]; ?>">View</a>
                    <a class="btn btn-warning" href="editproduct.php?id=<?php echo $data["id"]; ?>">Edit</a>
                    <a class="btn btn-danger" href="delete.php?id=<?php echo $data["id"]; ?>">Delete</a>
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
include("templates/footer.php");
?>