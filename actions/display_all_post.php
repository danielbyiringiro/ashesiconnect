<?php
include("../settings/connection.php");
ini_set('display_errors', 'off'); 

$sql = "SELECT * FROM POST ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) 
    {
        $user_id = $row['user_id']; 
        $post_id = $row['id'];

        $user_query = "SELECT * FROM USERS WHERE ID = ?";
        $vibes_query = "SELECT count(id) AS vibes FROM LIKES WHERE postId = ?";
        $comments_query = "SELECT count(ID) AS comments FROM comment WHERE POSTID = ?";

        $sql_query = "SELECT id FROM LIKES WHERE postId = ? AND userId = ?";
        $stmt = $conn->prepare($sql_query);
        $stmt->bind_param("ii", $post_id, $user_id);
        $stmt->execute();
        $result_src = $stmt->get_result();

        $image_src = '';

        if ($result_src->num_rows > 0) 
        {
            $image_src = "../images/vibed.jpeg";
        }
        else
        {
            $image_src = "../images/vibe.png";
        }


        $stmt_vibes = $conn->prepare($vibes_query);
        $stmt_vibes->bind_param("i", $post_id);
        $stmt_vibes->execute();
        $vibes_result = $stmt_vibes ->get_result();

        $stmt_comment = $conn->prepare($comments_query);
        $stmt_comment->bind_param("i", $post_id);
        $stmt_comment->execute();
        $comment_result = $stmt_comment->get_result();

        $stmt = $conn->prepare($user_query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $user_result = $stmt->get_result();
        
        
        if (($user_result->num_rows > 0) && ($vibes_result->num_rows > 0) && ($comment_result->num_rows > 0)) {
            $user_row = $user_result->fetch_assoc();
            $vibes_row = $vibes_result->fetch_assoc();
            $comment_row = $comment_result->fetch_assoc();

            $vibes = $vibes_row["vibes"];
            $comments = $comment_row["comments"];

            $username = $user_row["first_name"] . " " . $user_row["last_name"];
            $year_group = "C'" . substr($user_row['year_group'], 2);
            $initials = strtoupper(preg_replace('/\b(\w)\w*\s*/', '$1', $user_row['major']));
            $formatted_date = date("h:i d F", strtotime($row['created_at']));
    
            echo "<div class='post-container'>";
            echo "<div class='post-header'>";
            echo "<a href='' class='header_link'>";
            echo "<img src='https://api.slingacademy.com/public/sample-photos/2.jpeg' class='horizontal-image' alt='Profile Picture'>";
            echo "</a>";
            echo "<span class='post-username'>";
            echo "<p class='username'><a href='/users/'>" . $username . "</a></p>";
            echo "<p class='belowtext'>". $year_group . " ".  $initials . " | " .$formatted_date . "</p>";
            echo "</span>";
            echo "</div>";
            echo "<br>";
            echo "<div class='post-content'>" . $row['content'] . "</div>";

            if ($row['picture_path'] != "N/A") {
                echo "<div class='post-image-container'>";
                echo "<img class='post-image' src='" . $row['picture_path'] . "' alt='Post Image'>";
                echo "</div>";
            }

            echo "<div class='post-actions'>";
            echo "<div class='vibe-comment'>";
            echo "<button class='vibe-button'>";
            echo "<img id='vibe-image-$post_id' onclick='". "vibeClicked($user_id, $post_id)" .  "' data-post-id='' src='$image_src' alt='vibe'>";
            echo "<strong><span id='vibes-count-$post_id'> " . $vibes . "</span><span class='strong'> vibes</span></strong>";
            echo "</button>";
            echo "<button class='comment-button' onclick='loadComments()'>";
            echo "<img src='../images/comment.png' alt='comment'>";
            echo "<strong><span id='comments-count-'>" . $comments . "</span><span class='strong'> comments</span></strong>";
            echo "</button>";
            echo "</div>";
            echo "<div class='comment-section'>";
            echo "<div class='comment_area'>";
            echo "<textarea class='comment-add' id='comment-input-' placeholder='Leave a comment...' required></textarea>";
            echo "<button>Post</button>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        $stmt->close();
    }
}
else
{
    echo "No Post";
}


