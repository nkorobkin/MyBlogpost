<?php

session_start();

include("config.php");
// include("functions.php");


if($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];


    if(!empty($user_name) && !empty($password)) {

        //Here we will be reading from the database
        $query = "select * from users where username = '$user_name' limit 1";
        $result = mysqli_query($conn, $query);

        if($result) {
            if($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);

                if($user_data['password'] === $password) {

                    //$_SESSION['id'] = $user_data['id'];
                    header("Location: index.php");
                    die;

                }
            }
        }
        echo "Wrong username or password! Try Again.";

    }
} else {
    // echo "Enter the correct creditenials!";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <nav class="navbar fixed-bottom navbar-light bg-light">
        <div class="container-fluid justify-content-end">
            <a class="navbar-brand" href="index.html">Return to Main Page</a>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-6 col-md-4">
                <h1 class="text-center mb-4">Login</h1>
                <form class="login-form" method="post">
                    <div class="mb-3">
                        <!-- Changed so that the user can sign-in via his username. Later on I can add so that both options will be available.  -->
                        <label for="inputEmail" class="form-label">Username</label>
                        <input type="text" name="user_name" class="form-control" id="inputEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="inputPassword" required>
                    </div>
                    <div class="d-grid gap-2 mb-3">
                        <button type="submit" class="btn btn-primary">Sign in</button>
                    </div>
                </form>
                <div class="text-center mb-3">
                    <p class="text-muted">Don't have an account?</p>
                    <a href="signUp.php" class="btn btn-secondary">Sign up</a>
                </div>
                <div class="text-center">
                    <a href="forgotPw.html" class="text-muted">Forgot password?</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js"></script>
</body>

</html>