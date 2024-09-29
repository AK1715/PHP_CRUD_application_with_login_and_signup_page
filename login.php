<?php
$login = false;
$showerror = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconnection.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // $sql = "Select * from users where username='$username' AND password='$password'";
    $sql = "Select * from users where username='$username'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num == 1){
        if($row = mysqli_fetch_assoc($result)){
            if(password_verify($password,$row['password'])){
            $login = true;
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header("location: /ak/index.php");
            }
            else{
                $showerror = true;
            }
        }
    }
    else{
        $showerror = true;
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>

    <?php require "_navbar.php" ?>
    
    <?php
    if($login){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> login Successfully .
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>';
        }
    
    if($showerror){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Invaild!</strong> Username or Password.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>';
        }
    ?>

    <div class="container my-3">
        <h1 class="text-center">Login Here</h1>
        <form action="/ak25/login.php" method="post">
            <div class="form-group my-3">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp"
                    placeholder="Enter Your Username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password"
                    placeholder="Enter Your Password">
            </div>
            <!-- <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div> -->
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="/ak25/signup.php" class="btn btn-primary">Sign Up </a>
        </form>
    </div>

</body>

</html>