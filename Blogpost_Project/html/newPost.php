<?php

session_start();

include("config.php");
include("functions.php");

$user_id = $_SESSION['id'];

if(isset($_POST['submit_post'])) {

// Get post title and content from submitted form data
$post_title = isset($_POST['post_title']) ? trim($_POST['post_title']) : '';
$post_content = isset($_POST['post_content']) ? trim($_POST['post_content']) : '';

// Validate input
if (empty($post_title) || empty($post_content)) {
    die("Post title and content cannot be empty.");
}

$query = "INSERT INTO posts (user_id, title, content, created_at) VALUES (?, ?, ?, NOW())";

// Prepare the SQL statement
$stmt = mysqli_prepare($conn, $query);

// Bind the parameters to the SQL statement
mysqli_stmt_bind_param($stmt, 'iss', $user_id, $post_title, $post_content);

// Execute the SQL statement
if (mysqli_stmt_execute($stmt)) {
    // Redirect to index.php after successful insertion
    header("Location: index.php");
    exit();
} else {
    // Display error message if insertion fails
    echo "Error: " . mysqli_error($conn);
}

}

mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>New Post | My Blog</title>
    <link rel="stylesheet" href="../css/post-style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-xl navbar-dark spacer-nav layer-nav">
        <a class="navbar-brand" href="index.php">My Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <!-- <li class="nav-item">
                    <a class="nav-link text-light" href="about.html"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" fill="currentColor" class="bi bi-asterisk" viewBox="0 0 16 16">
                            <path
                                d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1z" />
                        </svg> About</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link text-light" href="profile.php"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                            <path fill-rule="evenodd"
                                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                        </svg> Profile</a>
                </li>
            </ul>

            <?php if (isset($_SESSION['id'])): ?>

                <div class="my-2 my-lg-0">
                    <a href="logout.php" class="btn btn-outline-light mr-2">Logout</a>
                </div>

            <?php else: ?>

                <div class="my-2 my-lg-0">
                    <a href="auth.php" class="btn btn-outline-light mr-2">Login</a>
                    <a href="signUp.php" class="btn btn-primary">Sign up</a>
                </div>

            <?php endif; ?>

            <!-- <div class="my-2 my-lg-0">
                <a href="auth.html" class="btn btn-outline-light mr-2">Login</a>
                <a href="signUp.html" class="btn btn-primary">Sign up</a>
            </div> -->
        </div>
    </nav>

    <div class="main-content-flex">

        <div class="article-flex">
            <div class="article-container">
                <div class="article-content glass-effect">

                    <form method="post" action="newPost.php">
                        <div class="comment-form-flex">
                            <textarea name="post_title" class="comment-input" rows="2"
                                placeholder="Type the title here..."></textarea>
                            <br>
                            <textarea name="post_content" class="comment-input" rows="10"
                                placeholder="Type your comment here..."></textarea>
                            <button type="submit" name="submit_post" class="comment-submit">Post</button>
                        </div>
                    </form>

                </div>
            </div>



        </div>


    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
<script src="../js/app.js" defer></script>

</html>