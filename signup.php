<?php
$showalert = false;
$showerror = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconnection.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $exists = false;

    if($password == $cpassword && $exists == false){
        $hash = password_hash($password, PASSWORD_DEFAULT());
        $sql = "INSERT INTO `users` (`username`, `password`, `dt`) 
        VALUES ('$username', '$hash', current_timestamp())";

        $result = mysqli_query($conn, $sql);
        if($result){
        $showalert = true;
        }
        
    }
    else{
        $showerror = "Password Does not Match";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>

<body>
    <?php require "_navbar.php" ?>

    <?php
    if($showalert){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> login Successfully .
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>'; }

    if($showerror){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Sorry!</strong> does not match password.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    }

    ?>

    <div class="container my-3">
        <h1 class="text-center">Sign Up</h1>
        <form action="/ak25/signup.php" method="post">
            <div class="form-group my-3">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp"
                    placeholder="Enter Your Username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password"
                    placeholder="Enter Your Password" required>
            </div>
            <div class="form-group">
                <label for="cpassword">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword"
                    placeholder="Enter Your Password">
            </div>
            <!-- <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div> -->
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="/ak25/login.php" class="btn btn-primary">Login </a>
        </form>
    </div>
</body>

</html>