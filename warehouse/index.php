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
                <th style="width:45%;">Comments</th>
                <th style="width:15%;">Sell Price</th>
                <th style="width:5%;">Quantity</th>
                <th style="width:20%;">Options</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <?php
            include('connect.php');
            $sqlSelect = "SELECT * FROM products";
            $result = mysqli_query($conn,$sqlSelect);
            // now we need to make the result array to move all the data here
            while($data = mysqli_fetch_array($result)){
            ?>
            <td><?php echo $data["productName"]?></td>
            <td><?php echo $data["comments"]?></td>
            <td><?php echo $data["sellPrice"]?></td>
            <td><?php echo $data["quantity"]?></td>
            <td>
                <a class="btn btn-info" href="view.php?id=<?php echo $data["id"]?>">View</a>
                <a class="btn btn-warning" href="editproduct.php?id=<?php echo $data["id"]?>">Edit</a>
                <a class="btn btn-danger" href="delete.php?id=<?php echo $data["id"]?>">Delete</a>
            </td>
            </tr>
            <?php
            } 
            ?>
            
        </tbody>
    </table>
</div>

<?php
include("templates/footer.php");
?>