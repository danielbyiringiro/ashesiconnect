<?php

// Database configuration
$servername = "localhost";
$username = "root";
$password = "cs341webtech";
$database = "AC2024";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve posts from the database in reverse chronological order
$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "Post ID: " . $row["id"] . "<br>";
        echo "User ID: " . $row["user_id"] . "<br>";
        echo "Content: " . $row["content"] . "<br>";
        echo "Picture Path: " . $row["picture_path"] . "<br>";
        echo "Created At: " . $row["created_at"] . "<br><br>";
    }
} else {
    echo "No posts found";
}

// Close connection
$conn->close();

?>
