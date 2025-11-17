<?php
    // session in php is a way to store information  in variables to be used across multiple pages. Unlike cookie the information is not stored on the computer
    session_start();
    if(isset($_SESSION["user"])){
        // be carefull with the space  this is correct Location: index.php
        header("Location: index.php");
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
    <title>Registration Form</title>
</head>
<body>
    <div class="container">
        <?php
        // var _POST catches all data submitet by the users
        // $_POST
        if(isset($_POST["submit"])){
            $fullName = $_POST["fullname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $passwordRepeat = $_POST["repeat_password"];
            $phone = $_POST["phone"] ?? ""; // ако искаш телефонен номер

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $errors = array();

            if(empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)){
                array_push($errors, "All fields are riquired");
            }

            // Име: само латински букви (малки и големи), дължина 5–15 символа 
            // for white space in the fullname is s "/^[A-Za-z\s]{5,35}$/"
            // withous white space "/^[A-Za-z]{5,35}$/"
            if((!preg_match("/^[A-Za-z\s]{5,35}$/", $fullName)) && (!preg_match("/^[A-Za-z]{5,35}$/", $fullName))){
                array_push($errors, "Full name must be 5–35 characters long and contain only Latin letters (A–Z, a–z).");
            }

            //Email
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($errors,"Email is not valid");
            }

            if(strlen($password) < 8){
                array_push($errors,"Password must be at least 8 characters!");
            }
            if(!preg_match("/[a-z]/", $password)){
                array_push($errors,"Password must contain at least one lowercase letter!");
            }
            if(!preg_match("/[A-Z]/", $password)){
                array_push($errors,"Password must contain at least one uppercase letter!");
            }
            if(!preg_match("/[@\-\_~]/", $password)){
                array_push($errors,"Password must contain at least one special character (@ - _ ~)!");
            }

            if($password!==$passwordRepeat){
                array_push($errors,"Password does not match");
            }

            // Телефон: само цифри, интервал и -
            if(!empty($phone) && !preg_match("/^[0-9\s\-]+$/", $phone)){
                array_push($errors,"Phone number can only contain digits, spaces and dashes.");
            }

            require_once "../connect.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";

            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);

            if($rowCount>0) {
                array_push($errors,"Email already exists!");
            }

            if(count($errors)>0){
                foreach($errors as $error){
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            }else{
                require_once "../connect.php";
                $sql = "INSERT INTO users (full_name ,email ,password ) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                // mysqli_stmt_init(); initialises statement and returns object suitable for mysqli
                // statement prepare so it returns an object and we can use that object in the mysql statement prepare function
                // so lets store the object in a variable
                // $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                if(mysqli_stmt_prepare($stmt, $sql)){
                    //we have 3 sss for the 3params name email pass
                    mysqli_stmt_bind_param($stmt,"sss",$fullName,$email,$passwordHash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>You are registered successfully!</div>";
                }else{
                    die("Something went wrong!");
                }
            }
        }
        
        ?>
        <form action="registration.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="fullname" placeholder="Full Name:">
            </div>
            <div class="form-group">
                <input type="email"  class="form-control" name="email" placeholder="Email:">
            </div>
            <div class="form-group">
                <input type="password"  class="form-control" name="password" placeholder="Password:">
            </div>
            <div class="form-group">
                <input type="password"  class="form-control" name="repeat_password" placeholder="Repeat Password:">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>
        <div>
            <p>Already registered!</p>
            <a href="login.php">Login here</a>
        </div>
    </div>
</body>
</html>