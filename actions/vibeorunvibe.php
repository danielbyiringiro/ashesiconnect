<?php

include "../settings/connection.php";

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get JSON data from the request body
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);

    // Extract postId and userId from the JSON data
    $postId = $data['postId'];
    $userId = $data['userId'];

    // Prepare and execute the SQL query to check if the user has already liked the post
    $sql_query = "SELECT id FROM LIKES WHERE postId = ? AND userId = ?";
    $stmt = $conn->prepare($sql_query);
    $stmt->bind_param("ii", $postId, $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Initialize variable to store image source
    $src = '';

    // If the user has already liked the post, delete the like
    if ($result->num_rows > 0) {
        $sql_query = "DELETE FROM LIKES WHERE postId = ? AND userId = ?";
        $stmt = $conn->prepare($sql_query);
        $stmt->bind_param("ii", $postId, $userId);
        $stmt->execute();
        $src = "../images/vibe.png";
    } else { // If the user has not liked the post, insert the like
        $sql_query = "INSERT INTO LIKES(postId, userId) VALUES(?,?)";
        $stmt = $conn->prepare($sql_query);
        $stmt->bind_param("ii", $postId, $userId);
        $stmt->execute();
        $src = "../images/vibed.jpeg";
    }

    // Get the count of likes for the post
    $getCount = "SELECT count(*) as likes FROM LIKES WHERE postId = ?";
    $stmt = $conn->prepare($getCount);
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Initialize variable to store the count of likes
    $count = 0;

    // If the query returned results, fetch the count of likes
    if ($result->num_rows > 0) {
        $rows = $result->fetch_assoc();
        $count = $rows["likes"];
    }

    // Prepare the response data
    $response_data = array(
        'likes' => $count,
        'image_src' => $src
    );

    // Set headers to indicate JSON content
    header('Content-Type: application/json');

    // Send the response data as JSON
    echo json_encode($response_data);
}
