<?php
// Include database connection code
include_once "connection.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $content = $_POST["content"];
    $picture_path = ""; // You need to handle file upload to save picture path

    // Prepare and execute SQL query to insert post into the database
    $stmt = $mysqli->prepare("INSERT INTO POST (user_id, content, picture_path, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("iss", $user_id, $content, $picture_path);
    
    // You need to replace $user_id with actual user id
    $user_id = 1; // Example user id, you need to retrieve this dynamically based on user session

    if ($stmt->execute()) {
        // Post inserted successfully
        header("Location: homepage.php"); // Redirect to homepage or any other page
        exit();
    } else {
        // Error occurred while inserting post
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close database connection
$mysqli->close();
?>
