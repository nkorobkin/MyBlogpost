<?php

include 'config.php';

$postsNewCount = $_POST['postsNewCount'];

$query = "SELECT p.id, p.title, p.content, p.created_at, u.fullname FROM posts p INNER JOIN users u ON p.user_id = u.id ORDER BY p.created_at DESC LIMIT $postsNewCount";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = $result->fetch_assoc()) {

        echo "<section class='container'>";
        echo    "<article class='article-container'>";
        echo        "<header class='article-header-container'>";
        echo            "<h2 class='article-title'>";
            echo htmlspecialchars($row["title"]);
                echo    "</h2>";
                echo    "<p class='article-meta'>Posted by" . htmlspecialchars($row["fullname"]) . "on" . date("F j, Y, g:i a", strtotime($row["created_at"]));
                    
                echo "</header>";
                echo "<section class='article-body container-text'>";
                  echo  "<p class='article-paragraph'>";
                        echo htmlspecialchars($row["content"]); 
                   echo "</p>";
                echo "</section>";
           echo "</article>";
        echo "</section>";
    }
} else {
    echo "<p class='article-paragraph'>No posts found!</p>";
}

?>



        

  