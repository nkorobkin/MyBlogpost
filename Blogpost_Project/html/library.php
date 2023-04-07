<?php

session_start();

include("config.php");
include("functions.php");

$user_data = check_login($conn);

// $logged_user = $user_data['id']; 

$query = "SELECT p.id, p.title, p.content, p.created_at, u.fullname FROM posts p INNER JOIN users u ON p.user_id = u.id WHERE p.user_id = '$user_data[id]' ORDER BY p.created_at DESC";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Library | My Blog</title>
    <link rel="stylesheet" href="../css/article-style.css">
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
                    <a class="nav-link text-light" href="profile.php"><svg xmlns="http://www.w3.org/2000/svg"
                            width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                            <path fill-rule="evenodd"
                                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                        </svg> Profile</a>
                </li>
            </ul>

            <!-- This will check if the user is logged, and change navbar accordingly -->
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
                <a href="auth.php" class="btn btn-outline-light mr-2">Login</a>
                <a href="signUp.php" class="btn btn-primary">Sign up</a>
            </div> -->
        </div>
    </nav>
    <div class="main-content-flex">
        <!--Profile Card-->
        <div class="profile-card-flex">
            <div class="profile-card-header">
                <a class="profile-icon" href="profile.php"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg></a>

                <a href="profile.php" class="profile-name">
                    <?php echo $user_data['fullname']; ?>
                </a>
            </div>

            <div class="profile-meta">
                <div class="stats-bar-flex">
                    <p id="stats-text">Stats:</p>
                    <span id="likes"><svg id="like-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                        </svg>333</span>
                </div>
                <hr class="line">
                <div class="profile-stats-flex">
                    <div class="profile-stats-col1">
                        <p class="stats-bar">Posts: <span> 0</span></p>
                        <p class="stats-bar">Comments: <span> 0</span></p>
                    </div>
                    <div class="profile-stats-col2">
                        <p class="stats-bar">Followers: <span> 0</span></p>
                        <p class="stats-bar">Following: <span> 0</span></p>
                    </div>
                </div>
            </div>
        </div>
        <!--Profile Card End-->
        <!--Articles-->
        <div class="articles-flex">
            <div class="article-type-bar">
                <div class="btn-box glass-effect gradient-border">
                    <p class="glowing-text"><a>My Posts</a></p>
                </div>
                <div class="btn-box">
                    <p><a>Saved Posts</a></p>
                </div>
                <div class="btn-box">
                    <p><a>Liked Posts</a></p>
                </div>
                <div class="btn-box">
                    <p><a>Discussions</a></p>
                </div>
            </div>

            <!-- Fetching user's article from the db -->
            <!-- //TODO: Move to the article card  -->

            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>

                    <div class="article-card">
                        
                        <div class="article-card-structure">
                            <div class="article-profile-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-7 h-7">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="article-card-body">
                                <div class="article-card-title">
                                    <!-- Click would send the id of the post, so that it can be printed post.php -->
                                    <p><a href="post.php?id=<?php echo $row['id']; ?>">
                                            <?php echo htmlspecialchars($row["title"]); ?>
                                        </a></p>
                                </div>
                                <div class="article-card-text">
                                    <p>
                                        <?php echo htmlspecialchars($row["content"]); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="article-card-meta">
                            <div class="meta-item">
                                <svg id="like-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>
                                <span>333</span>
                            </div>
                            <div class="meta-item">
                                <svg id="comment-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                                </svg>
                                <span>2</span>
                            </div>
                            <div class="meta-item">
                                <svg id="bookmark-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                                </svg>
                            </div>
                            <div class="meta-item meta-item-poster">
                                <p class="poster">Posted by: <span>
                                        <?php echo htmlspecialchars($row["fullname"]); ?> on
                                        <?php echo date("F j, Y, g:i a", strtotime($row["created_at"])); ?>
                                    </span></p>
                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>
            <?php else: ?>
                <p class="article-paragraph">No posts found.</p>
            <?php endif; ?>
            <?php $conn->close(); ?>

            <!-- <div class="article-card">
                <div class="article-card-structure">
                    <div class="article-profile-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="article-card-body">
                        <div class="article-card-title">
                            <p><a href="post.html">My First Post</a></p>
                        </div>
                        <div class="article-card-text">
                            <p>Ipsum pickled godard shaman, put a bird on it williamsburg ut tousled. Biodiesel minim
                                DIY,
                                shoreditch organic authentic synth. Godard kitsch blog live-edge cardigan microdosing
                                church-key squid health goth air plant mlkshk. Copper mug yuccie bitters gorpcore.
                                Ethical
                                meggings single-origin coffee man bun williamsburg, cred sustainable magna mollit green
                                juice shoreditch.</p>
                        </div>
                    </div>
                </div>
                <div class="article-card-meta">
                    <div class="meta-item">
                        <svg id="like-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                        </svg>
                        <span>333</span>
                    </div>
                    <div class="meta-item">
                        <svg id="comment-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                        </svg>
                        <span>2</span>
                    </div>
                    <div class="meta-item">
                        <svg id="bookmark-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                        </svg>
                    </div>
                    <div class="meta-item meta-item-poster">
                        <p class="poster">Posted by: <span>UserX</span></p>
                    </div>
                </div>
            </div>
            <div class="article-card">
                <div class="article-card-structure">
                    <div class="article-profile-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="article-card-body">
                        <div class="article-card-title">
                            <p>My First Post</p>
                        </div>
                        <div class="article-card-text">
                            <p>Ipsum pickled godard shaman, put a bird on it williamsburg ut tousled. Biodiesel minim
                                DIY,
                                shoreditch organic authentic synth. Godard kitsch blog live-edge cardigan microdosing
                                church-key squid health goth air plant mlkshk. Copper mug yuccie bitters gorpcore.
                                Ethical
                                meggings single-origin coffee man bun williamsburg, cred sustainable magna mollit green
                                juice shoreditch.</p>
                        </div>
                    </div>
                </div>
                <div class="article-card-meta">
                    <div class="meta-item">
                        <svg id="like-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                        </svg>
                        <span>333</span>
                    </div>
                    <div class="meta-item">
                        <svg id="comment-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                        </svg>
                        <span>2</span>
                    </div>
                    <div class="meta-item">
                        <svg id="bookmark-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                        </svg>
                    </div>
                    <div class="meta-item meta-item-poster">
                        <p class="poster">Posted by: <span>UserX</span></p>
                    </div>
                </div>
            </div>
            <div class="article-card">
                <div class="article-card-structure">
                    <div class="article-profile-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="article-card-body">
                        <div class="article-card-title">
                            <p>My First Post</p>
                        </div>
                        <div class="article-card-text">
                            <p>Ipsum pickled godard shaman, put a bird on it williamsburg ut tousled. Biodiesel minim
                                DIY,
                                shoreditch organic authentic synth. Godard kitsch blog live-edge cardigan microdosing
                                church-key squid health goth air plant mlkshk. Copper mug yuccie bitters gorpcore.
                                Ethical
                                meggings single-origin coffee man bun williamsburg, cred sustainable magna mollit green
                                juice shoreditch.</p>
                        </div>
                    </div>

                </div>
                <div class="article-card-meta">
                    <div class="meta-item">
                        <svg id="like-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                        </svg>
                        <span>333</span>
                    </div>
                    <div class="meta-item">
                        <svg id="comment-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                        </svg>
                        <span>2</span>
                    </div>
                    <div class="meta-item">
                        <svg id="bookmark-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                        </svg>
                    </div>
                    <div class="meta-item meta-item-poster">
                        <p class="poster">Posted by: <span>UserX</span></p>
                    </div>
                </div>
            </div>
            <div class="article-card">
                <div class="article-card-structure">
                    <div class="article-profile-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="article-card-body">
                        <div class="article-card-title">
                            <p>My First Post</p>
                        </div>
                        <div class="article-card-text">
                            <p>Ipsum pickled godard shaman, put a bird on it williamsburg ut tousled. Biodiesel minim
                                DIY,
                                shoreditch organic authentic synth. Godard kitsch blog live-edge cardigan microdosing
                                church-key squid health goth air plant mlkshk. Copper mug yuccie bitters gorpcore.
                                Ethical
                                meggings single-origin coffee man bun williamsburg, cred sustainable magna mollit green
                                juice shoreditch.</p>
                        </div>
                    </div>
                </div>
                <div class="article-card-meta">
                    <div class="meta-item">
                        <svg id="like-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                        </svg>
                        <span>333</span>
                    </div>
                    <div class="meta-item">
                        <svg id="comment-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                        </svg>
                        <span>2</span>
                    </div>
                    <div class="meta-item">
                        <svg id="bookmark-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                        </svg>
                    </div>
                    <div class="meta-item meta-item-poster">
                        <p class="poster">Posted by: <span>UserX</span></p>
                    </div>
                </div>
            </div>
            <div class="article-card">
                <div class="article-card-structure">
                    <div class="article-profile-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="article-card-body">
                        <div class="article-card-title">
                            <p>My First Post</p>
                        </div>
                        <div class="article-card-text">
                            <p>Ipsum pickled godard shaman, put a bird on it williamsburg ut tousled. Biodiesel minim
                                DIY,
                                shoreditch organic authentic synth. Godard kitsch blog live-edge cardigan microdosing
                                church-key squid health goth air plant mlkshk. Copper mug yuccie bitters gorpcore.
                                Ethical
                                meggings single-origin coffee man bun williamsburg, cred sustainable magna mollit green
                                juice shoreditch.</p>
                        </div>
                    </div>
                </div>
                <div class="article-card-meta">
                    <div class="meta-item">
                        <svg id="like-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                        </svg>
                        <span>333</span>
                    </div>
                    <div class="meta-item">
                        <svg id="comment-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                        </svg>
                        <span>2</span>
                    </div>
                    <div class="meta-item">
                        <svg id="bookmark-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                        </svg>
                    </div>
                    <div class="meta-item meta-item-poster">
                        <p class="poster">Posted by: <span>UserX</span></p>
                    </div>
                </div>
            </div>
        </div> -->

            <!--Articles End-->
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>

</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>

</html>