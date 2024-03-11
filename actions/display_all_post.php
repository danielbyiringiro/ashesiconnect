<?php
include("../settings/connection.php"); 

$sql = "SELECT * FROM post ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $user_id = $row['user_id']; // Assuming the user ID is stored in the 'user_id' column of the posts table
        $user_query = "SELECT * FROM users WHERE ID = ?";
        $stmt = $conn->prepare($user_query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $user_result = $stmt->get_result();
        
        if ($user_result->num_rows > 0) {
            $user_row = $user_result->fetch_assoc();
            $username = $user_row["first_name"] . " " . $user_row["last_name"];
            $year_group = "C'" . substr($user_row['year_group'], 2);
            $initials = strtoupper(preg_replace('/\b(\w)\w*\s*/', '$1', $user_row['major']));
            $formatted_date = date("h:i d F", strtotime($row['created_at']));
            // Display user details and post content
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
            echo "<img id='vibe-image-' data-post-id='' src='../images/vibe.png' alt='vibe'>";
            echo "<strong><span id='vibes-count-'>0</span><span class='strong'> vibes</span></strong>";
            echo "</button>";
            echo "<button class='comment-button' onclick='loadComments()'>";
            echo "<img src='../images/comment.png' alt='comment'>";
            echo "<strong><span id='comments-count-'>0</span><span class='strong'> comments</span></strong>";
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
