<?php
session_start();

include("config.php");
// include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){

    //Checking if something was posted
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(!empty($user_name) && !empty($email) && !empty($password) && !is_numeric($user_name)) {

        $query = "insert into users (username, email, password) values ('$user_name', '$email', '$password')";

        mysqli_query($conn, $query);

        header("Location: auth.php");
        die;
    } else {
        echo "Please enter valid information!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">
                
                <!-- This is a main signup form -->
                <form class="mt-5" method="post">
                    <h3 class="text-center mb-4">Sign Up</h3>
                    <div class="form-group mb-3">
                        <!-- Full Name of the User (I am changing to be the user name. Full name can be implemented later as there is no need for it now) -->
                        <label for="name" class="form-label">Username</label>
                        <input type="text" class="form-control" id="name" name="user_name" placeholder="Enter your user name">
                    </div>
                    <div class="form-group mb-3">
                        <!-- User's email -->
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address">
                    </div>
                    <div class="form-group mb-3">
                        <!-- User's Password -->
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                    </div>
                    <!-- <div class="form-group mb-3"> -->
                        <!-- Password Confirmation TODO: Perhaps we will need to delete it (at least for now). -->
                        <!-- <label for="confirm-password" class="form-label">Confirm Password</label> -->
                        <!-- <input type="password" class="form-control" id="confirm-password" -->
                            <!-- placeholder="Confirm your password"> -->
                    <!-- </div> -->
                    <button type="submit" class="btn btn-primary btn-block mt-4">Sign Up</button>
                    <div class="text-center mt-3">
                        Already have an account? <a href="auth.php">Log In</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
</body>

</html>