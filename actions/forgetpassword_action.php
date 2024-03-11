<?php

session_start();
$message = array();
// Load environment variables
require_once '../settings/env.php';
require_once '../settings/connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) 
{
    $email = $_POST["email"];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format";
        $_SESSION['message'] = $message;
        header("location: ../view/forgotpassword.php");
        exit();
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $token = bin2hex(random_bytes(16));
        $sql_update = "UPDATE users SET reset_token = ? WHERE email = ?";
        $stmt = $conn->prepare($sql_update);
        $stmt->bind_param("ss", $token, $email);

        if ($stmt->execute() === TRUE) {
            // Configure PHPMailer
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = getenv('GMAIL_USERNAME');
                $mail->Password = getenv('GMAIL_PASSWORD');
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Set email parameters
                $mail->setFrom(getenv('GMAIL_USERNAME'), 'Ashesi Connect');
                $mail->addAddress($email);
                $mail->Subject = 'Password Reset';
                $mail->isHTML(true);
                $mail->Body = "<p>Here is your password reset token: <br>$token</p>";

                // Send email
                $mail->send();
                $message = "A reset token has been sent to your email<br>";
                $_SESSION['message'] = $message;
                $_SESSION['successful_email'] = $email;
                header("location: ../view/forgotpassword.php");
                exit;   
            } catch (Exception $e) {
                $message = "Oops! Something went wrong. Please try again later : " . $e->getMessage() . "<br>";
                $_SESSION['message'] = $message;
                header("location: ../view/forgotpassword.php");
                exit();
            }
        } else {
            $message = "Error updating record: " . $conn->error . "<br>";
            $_SESSION['message'] = $message;
            header("location: ../view/forgotpassword.php");
            exit();
        }
    } else {
        $message = "Email not found. Please check and try again.<br>";
        $_SESSION['message'] = $message;
        header("location: ../view/forgotpassword.php");
        exit();
    }
}
elseif($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["token"])) 
{
    $token = $_POST["token"];
    $submitted_email = $_POST["submitted_email"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $submitted_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        if ($token !== $row["reset_token"])
        {
            $message = "Wrong reset token<br>";
            $_SESSION['message'] = $message;
            header("location: ../view/forgotpassword.php");
            exit();
        }
        else
        {
            $new_password = $_POST["password"];

            if (strlen(trim($new_password)) < 6)
            {
                $message = "Password should have at least 6 characters";
                $_SESSION['message'] = $message;
                header("location: ../view/forgotpassword.php");
                exit();
            }
            else
            {
                $sql = "UPDATE users SET password_hash = ? WHERE email = ?";
                $new_password = password_hash($new_password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare($sql);

                // Check if the statement was prepared successfully
                if (!$stmt) {
                    // Statement preparation failed, handle the error
                    $error = $conn->error;
                    echo "Statement preparation failed: $error";
                    // Handle the error as needed
                } else {
                    $stmt->bind_param("ss", $new_password, $submitted_email);

                    if ($stmt->execute()) {
                        // Execution successful
                        $message = "You have successfully changed your password";
                        $_SESSION["message"] = $message;
                        unset($_SESSION['successful_email']);
                        header("location: ../view/forgotpassword.php");
                    } else {
                        // Execution failed
                        $error = $stmt->error;
                        echo "Statement execution failed: $error";
                        // Handle the error as needed
                    }
                }
            }
        }
    }
}
