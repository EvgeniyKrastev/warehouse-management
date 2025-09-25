<?php
    // session in php is a way to store information  in variables to be used across multiple pages. Unlike cookie the information is not stored on the computer
    session_start();
    if(isset($_SESSION["user"])){
        // be carefull with the space  this is correct Location: index.php
        header("Location: ../warehouse/index.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Login Form</title>
</head>
<body>
    <div class="container">
        <?php
        // if login key is submitted then we will have the login data
        if(isset($_POST["login"])){
            $email = $_POST["email"];
            $password = $_POST["password"];
            require_once "database.php";
            
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if($user){
                if(password_verify($password, $user["password"])){
                    // session_start();
                    $_SESSION["user"] = "yes";
                    // be carefull with the space  this is correct Location: index.php
                    header("Location: ../warehouse/index.php"); 
                    die();
                }else{
                    echo "<div class='alert alert-danger'>Password does not match!</div>";
                }
            }else{
                echo "<div class='alert alert-danger'>Email does not match!</div>";
            }
        }
        ?>
    <form action="login.php" method="post">
            <div class="form-group">
                <input type="email" placeholder="Enter Email:" class="form-control" name="email" placeholder="Email:">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter Password:" class="form-control" name="password" placeholder="Password:">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Login" name="login">
            </div>
    </form>
     <div>
            <p>Not registered yet!</p>
            <a href="registration.php">Register here</a>
        </div>
    </div>
</body>
</html>