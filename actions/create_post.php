<?php
include("../settings/connection.php");
session_start();

$error = array();
unset($_SESSION["error"]);

function generateUUID() {
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (empty($_POST['postContent'])) {
        array_push($error, "Empty Post");
        $_SESSION['error'] = $error;
        header("location: ../view/newpost.php");
        exit();
    } else {
        $post_content = $_POST['postContent'];
        
        if (!empty($_FILES["image"]["name"])) {
            $file_name = generateUUID() . "_" . $_FILES["image"]["name"];
            $target_path = "../assets/" . $file_name;
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_path)) {
                $image_path = $target_path;
                echo "Image moved successfully<br>";
            } else {
                echo "Error uploading image";
            }
        } else {
            $image_path = "N/A";
        }

        $sql = "INSERT INTO POST (user_id, content, picture_path, created_at) VALUES (?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("iss", $_SESSION["id"], $post_content, $image_path);
            if ($stmt->execute()) {
                header("location: ../view/homepage.php");
                $conn ->close();
                exit();
            } else {
                // Error inserting post
                echo "Error: " . $conn->error;
            }
            $stmt->close();
        } else 
        {
            echo "Error in prepared statement";
        }
        $conn->close();
    }
}
