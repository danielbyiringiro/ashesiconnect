<?php
// Include the connection script
require_once 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
    $email = $_POST["email"];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $token = bin2hex(random_bytes(16));
        $sql_update = "UPDATE users SET reset_token = '$token' WHERE email = '$email'";
        if ($conn->query($sql_update) === TRUE) {
            $subject = "Password Reset";
            $message = "Click the link below to reset your password:\r\n";
            $message .= "../view/forgotpassword.php?token=$token\r\n";
            $headers = "From: $email";

            if (mail($email, $subject, $message, $headers)) {
                echo "Password reset link has been sent to your email.";
            } else {
                echo "Failed to send password reset email.";
            }
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "Email not found. Please check and try again.";
    }
}
?>
