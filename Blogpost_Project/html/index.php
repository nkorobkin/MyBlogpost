<?php

session_start();

include("config.php");
include("functions.php");


// Get the search query from the URL
$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';

if ($search_query) {

    $query = "SELECT p.id, p.title, p.content, p.created_at, u.fullname FROM posts p INNER JOIN users u ON p.user_id = u.id WHERE p.title LIKE ? ORDER BY p.created_at DESC";

    // Prepare the SQL statement
    $stmt = mysqli_prepare($conn, $query);

    // Bind the search parameter to the SQL statement
    $search_param = "%" . $search_query . "%";
    mysqli_stmt_bind_param($stmt, 's', $search_param);

    // Execute the SQL statement
    mysqli_stmt_execute($stmt);

    // Get the result of the SQL statement
    $result = mysqli_stmt_get_result($stmt);

} else {

    $query = "SELECT p.id, p.title, p.content, p.created_at, u.fullname FROM posts p INNER JOIN users u ON p.user_id = u.id ORDER BY p.created_at DESC";
    $result = mysqli_query($conn, $query);

}




// * Just some useful debugging statements casually saving my sanity. 
// var_dump($_GET);

// echo "<br>";
// echo "isset(\$_GET['action']): " . (isset($_GET['action']) ? "true" : "false") . "<br>";
// echo "\$_GET['action'] === 'delete': " . (($_GET['action'] ?? "") === "delete" ? "true" : "false") . "<br>";
// echo "isset(\$_GET['id']): " . (isset($_GET['id']) ? "true" : "false") . "<br>";

// Check for the delete action and post id
if (isset($_GET['action']) && $_GET['action'] === "delete" && isset($_GET['id'])) {

    // echo "Action: " . $_GET['action'] . " | ID: " . $_GET['id'];

    $post_id = $_GET['id'];

    // Prepare a statement to delete the post from the database
    $stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->bind_param("i", $post_id);

    if ($stmt->execute()) {
        //Redirect to the same page after deleting the post
        header("Location: index.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Blog</title>
    <link rel="stylesheet" href="../css/home-style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <!-- //!I have no idea why is it not working and how to implement ajax properly in this case. -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script> -->

    <!-- <script>
        //jQuery for ajax
        $(document).ready(function () {
            var postsCount = 2;
            $("#more_posts").click(function () {
                postsCount = postsCount + 2;
                $("#posts").load("load-posts.php", {
                    postsNewCount: postsCount
                });
            });
        })
    </script> -->

</head>

<body>
    <nav class="navbar navbar-expand-xl navbar-dark spacer-nav layer-nav">
        <a class="navbar-brand" href="#">My Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">

                <?php if (isset($_SESSION['id'])): ?>

                    <li class="nav-item">
                        <a class="nav-link text-light" href="library.php"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                                <path
                                    d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                            </svg> My Library</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="profile.php"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                            </svg> Profile</a>
                    </li>

                <?php else: ?>
                <?php endif; ?>

                <!-- <li class="nav-item">
                    <a class="nav-link text-light" href="about.html"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" fill="currentColor" class="bi bi-asterisk" viewBox="0 0 16 16">
                            <path
                                d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1z" />
                        </svg> About</a>
                </li> -->

            </ul>

            <!-- This will check if the user is logged, and change navbar accordingly -->
            <?php if (isset($_SESSION['id'])): ?>

                <div class="my-2 my-lg-0">
                    <a href="newPost.php" class="btn btn-outline-light mr-2">New Post</a>
                    <br>
                </div>

                <form action="index.php" method="GET" class="navbar-search">
                    <input type="search" name="search" class="search-input" placeholder="Search...">
                    <button class="search-button" type="submit">Search</button>
                </form>

                <div class="my-2 my-lg-0">
                    <a href="logout.php" class="btn btn-outline-light mr-2">Logout</a>
                </div>

            <?php else: ?>

                <!-- <div class="my-2 my-lg-0">
                    <a href="newPost.php" class="btn btn-outline-light mr-2">New Post</a>
                    <br>
                </div> -->

                <form action="index.php" method="GET" class="navbar-search">
                    <input type="search" name="search" class="search-input" placeholder="Search...">
                    <button class="search-button" type="submit">Search</button>
                </form>

                <div class="my-2 my-lg-0">
                    <a href="auth.php" class="btn btn-outline-light mr-2">Login</a>
                    <a href="signUp.php" class="btn btn-primary">Sign up</a>
                </div>

            <?php endif; ?>


        </div>
    </nav>

    <div class="main-content-flex">
        <div class="article-card-flex">
            <article class="article-card-container">
                <header class="articles-card-header-container">
                    <h1 class="article-card-title">Trending Blogs </h1>
                    <hr>
                </header>
                <div class="card-content-section">
                    <section>
                        <p class="articles-card-paragraph">Lorem ipsum dolor </p>

                    </section>
                    <section>
                        <p class="articles-card-paragraph">Suspendisse potenti</p>
                    </section>
                    <section>

                        <p class="articles-card-paragraph">Suspendisse potenti. Nullam sit amet</p>
                    </section>
                </div>
            </article>

        </div>

        <!-- I've added id for the load function to work  -->
        <div id="posts" class="article-col-flex">

            <!-- Fetching posts from db -->
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <section class="container">
                        <article class="article-container">
                            <header class="article-header-container">
                                <h2 class="article-title"><a href="post.php?id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row["title"]); ?></a></h2>
                                <p class="article-meta">Posted by
                                    <?php echo htmlspecialchars($row["fullname"]); ?> on
                                    <?php echo date("F j, Y, g:i a", strtotime($row["created_at"])); ?>
                                </p>
                            </header>
                            <section class="article-body container-text">
                                <p class="article-paragraph">
                                    <?php echo htmlspecialchars($row["content"]); ?>

                                    <!-- //!If the user is admin, allow him to delete the posts. -->
                                    <?php if (isset($_SESSION['id']) && (int) $_SESSION['id'] === 1): ?>

                                        <!-- //? Having a hard time understanding wtf is going on below? Me too. Works though! =) -->

                                        <span><a href="index.php?id=<?php echo $row['id']; ?>&action=delete"
                                                onclick="return confirmDelete();"><button
                                                    style="border: none; background: none; color: red; cursor: pointer; padding: 0; margin-left: 98%;"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"
                                                        style="margin-left:98%;">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg></button></a></span>

                                    <?php endif; ?>
                                </p>
                            </section>
                        </article>
                    </section>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="article-paragraph">No posts found!</p>
            <?php endif; ?>
            <?php $conn->close(); ?>

        </div>

        <!-- //TODO: This button will pull more posts using ajax -->
        <!-- <button id="more_posts" class="container">Show More Posts</button> -->

        <footer class="footer">
            <div class="container">
                <p>&copy; 2023 Blogpost Website</p>
            </div>
        </footer>
    </div>

    <script>
        function confirmDelete() {
            // Display a confirmation dialog
            if (window.confirm("Are you sure you want to delete this post?")) {
                // If the admin user clicks "OK", proceed with the delete action
                return true;
            } else {
                // If the admin user clicks "Cancel", prevent the delete action
                return false;
            }
        }
    </script>

</body>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>

</html>