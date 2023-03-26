<?php

session_start();

include("config.php");

$query = "SELECT p.id, p.title, p.content, p.created_at, u.fullname FROM posts p INNER JOIN users u ON p.user_id = u.id ORDER BY p.created_at DESC";
$result = mysqli_query($conn, $query);

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
                <li class="nav-item">
                    <a class="nav-link text-light" href="library.php"><svg xmlns="http://www.w3.org/2000/svg"
                            width="16" height="16" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                            <path
                                d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                        </svg> My Library</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="about.html"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" fill="currentColor" class="bi bi-asterisk" viewBox="0 0 16 16">
                            <path
                                d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1z" />
                        </svg> About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="profile.html"><svg xmlns="http://www.w3.org/2000/svg"
                            width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                            <path fill-rule="evenodd"
                                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                        </svg> Profile</a>
                </li>
            </ul>
            <div class="my-2 my-lg-0">
                <a href="auth.php" class="btn btn-outline-light mr-2">Login</a>
                <a href="signUp.php" class="btn btn-primary">Sign up</a>
            </div>
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

        <div class="article-col-flex">

            <!-- Fetching posts from db -->
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <section class="container">
                        <article class="article-container">
                            <header class="article-header-container">
                                <h2 class="article-title">
                                    <?php echo htmlspecialchars($row["title"]); ?>
                                </h2>
                                <p class="article-meta">Posted by
                                    <?php echo htmlspecialchars($row["fullname"]); ?> on
                                    <?php echo date("F j, Y, g:i a", strtotime($row["created_at"])); ?>
                                </p>
                            </header>
                            <section class="article-body container-text">
                                <p class="article-paragraph">
                                    <?php echo htmlspecialchars($row["content"]); ?>
                                </p>
                            </section>
                        </article>
                    </section>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="article-paragraph">No posts found.</p>
            <?php endif; ?>
            <?php $conn->close(); ?>


            <!-- <section class="container">
                <article class="article-container">
                    <header class="article-header-container">
                        <h1 class="article-title">My First Blog Post</h1>
                        <p class="article-meta">Published on January 1, 2023</p>
                    </header>
                    <section class="article-body container-text">
                        <p class="article-paragraph">Chicharrones try-hard polaroid shabby chic hashtag cronut, bicycle
                            rights XOXO tote bag seitan master cleanse messenger bag. Bruh asymmetrical YOLO pop-up
                            tacos meggings, drinking vinegar craft beer freegan. Bushwick echo park typewriter
                            live-edge. Everyday carry tousled man braid, woke squid hexagon tumeric artisan truffaut
                            schlitz iceland cardigan tilde. Vexillologist narwhal asymmetrical bruh thundercats, selfies
                            helvetica shoreditch.</p>
                        <p class="article-paragraph">Suspendisse potenti. Nullam sit amet</p>
                    </section>
                </article>
            </section>


            <section class="container">
                <article class="article-container">
                    <header class="article-header-container">
                        <h1 class="article-title">Lorem Ipsum How You Doin?</h1>
                        <p class="article-meta">Published on January 12, 2023</p>
                    </header>
                    <section class="article-body container-text">
                        <p class="article-paragraph">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc
                            aliquam ipsum a nibh commodo sagittis.
                            Sed laoreet, erat non consequat bibendum, felis ex pellentesque eros, ut convallis quam
                            tellus eu
                            enim. Vivamus bibendum nulla in malesuada suscipit. Suspendisse a bibendum leo.
                            Phasellus vel dui
                            vitae enim porttitor luctus. Integer sodales velit nisl, vel ultrices nunc dictum vitae.
                            Donec
                            luctus, leo eu congue varius, purus nunc efficitur elit, eu pulvinar nibh libero vel
                            sapien. Integer
                            quis urna eros. Nulla posuere turpis justo, non hendrerit tortor mollis vel. Etiam
                            euismod libero
                            ipsum, vel consectetur sapien eleifend ac. Donec sollicitudin ante sed malesuada rutrum.
                            In hac
                            habitasse platea dictumst.</p>
                        <p class="article-paragraph">Suspendisse potenti. Nullam sit amet</p>
                    </section>
                </article>
            </section>

            <section class="container">
                <article class="article-container">
                    <header class="article-header-container">
                        <h1 class="article-title">Lorem Ipsum How You Doin?</h1>
                        <p class="article-meta">Published on January 12, 2023</p>
                    </header>
                    <section class="article-body container-text">
                        <p class="article-paragraph">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc
                            aliquam ipsum a nibh commodo sagittis.
                            Sed laoreet, erat non consequat bibendum, felis ex pellentesque eros, ut convallis quam
                            tellus eu
                            enim. Vivamus bibendum nulla in malesuada suscipit. Suspendisse a bibendum leo.
                            Phasellus vel dui
                            vitae enim porttitor luctus. Integer sodales velit nisl, vel ultrices nunc dictum vitae.
                            Donec
                            luctus, leo eu congue varius, purus nunc efficitur elit, eu pulvinar nibh libero vel
                            sapien. Integer
                            quis urna eros. Nulla posuere turpis justo, non hendrerit tortor mollis vel. Etiam
                            euismod libero
                            ipsum, vel consectetur sapien eleifend ac. Donec sollicitudin ante sed malesuada rutrum.
                            In hac
                            habitasse platea dictumst.</p>
                        <p class="article-paragraph">Suspendisse potenti. Nullam sit amet</p>
                    </section>
                </article>
            </section>

            <section class="container">
                <article class="article-container">
                    <header class="article-header-container">
                        <h1 class="article-title">My First Blog Post</h1>
                        <p class="article-meta">Published on January 1, 2023</p>
                    </header>
                    <section class="article-body container-text">
                        <p class="article-paragraph">Chicharrones try-hard polaroid shabby chic hashtag cronut, bicycle
                            rights XOXO tote bag seitan master cleanse messenger bag. Bruh asymmetrical YOLO pop-up
                            tacos meggings, drinking vinegar craft beer freegan. Bushwick echo park typewriter
                            live-edge. Everyday carry tousled man braid, woke squid hexagon tumeric artisan truffaut
                            schlitz iceland cardigan tilde. Vexillologist narwhal asymmetrical bruh thundercats, selfies
                            helvetica shoreditch.</p>
                        <p class="article-paragraph">Suspendisse potenti. Nullam sit amet</p>
                    </section>
                </article>
            </section> -->
        </div>


        <footer class="footer">
            <div class="container">
                <p>&copy; 2023 Blogpost Website</p>
            </div>
        </footer>
    </div>
</body>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>

</html>