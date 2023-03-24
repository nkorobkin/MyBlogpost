<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Blog</title>
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <header class="header">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="#">My Blog</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Articles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <?php
                        // check if the user is logged in and show/hide the profile button accordingly
                        session_start();
                        if (isset($_SESSION["user_id"])) {
                            echo '<li class="nav-item">
                                        <a class="nav-link" href="profile.php">Profile</a>
                                    </li>';
                        }
                        ?>
                    </ul>
                    <div class="my-2 my-lg-0">
                        <?php
                        // show either login/logout and signup buttons based on whether the user is logged in
                        if (isset($_SESSION["user_id"])) {
                            echo '<a href="logout.php" class="btn btn-outline-light mr-2">Logout</a>';
                        } else {
                            echo '<a href="#" class="btn btn-outline-light mr-2">Login</a>';
                        }
                        ?>
                        <a href="#" class="btn btn-primary">Sign up</a>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <main class="main">
        <div class="container">
            <article class="article-container">
                <header class="article-header-container">
                    <h1 class="article-title">My First Blog Post</h1>
                    <p class="article-meta">Published on January 1, 2023</p>
                </header>
                <section class="article-body">
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
        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2023 Blogpost Website</p>
        </div>
    </footer>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNVQ8ew" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>