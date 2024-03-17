<?php
session_start();

include('../settings/connection.php');

// Initialize variables
$email = $password = "";
$error_array = array();

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    // Check if email is empty
    if (empty(trim($_POST["email"]))) {
        array_push($error_array, "Please enter your email.");
    } else {
        $email = trim($_POST["email"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        array_push($error_array, "Please enter your password.");
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($error_array)) 
    {
        // Prepare a select statement
        $sql = "SELECT id, email, password_hash, first_name, last_name, major, year_group, Created_at, bio FROM USERS WHERE email = ?";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_email);

            // Set parameters
            $param_email = $email;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Store result
                $stmt->store_result();

                // Check if email exists, then verify password
                if ($stmt->num_rows == 1) {
                    // Bind result variables
                    $stmt->bind_result($id, $email, $hashed_password, $first_name, $last_name, $major, $year, $join, $bio);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) 
                        {
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $first_name . " " . $last_name;
                            $_SESSION["email"] = $email;
                            $_SESSION['major'] = strtoupper(preg_replace('/\b(\w)\w*\s*/', '$1', $major));
                            $_SESSION['year'] = $year_group = "C'" . substr($year, 2);
                            $_SESSION['joined'] = date("h:i d F", strtotime($join));
                            $_SESSION['bio'] = $bio;

                            // Redirect user to welcome page
                            header("location: ../view/homepage.php");
                            exit();
                        } 
                        else 
                        {
                            array_push($error_array, "The password you entered is not valid.<b>");
                        }
                    }
                } else 
                {
                    array_push($error_array, "No account found with that email.");
                }
            } else {
                array_push($error_array, "Oops! Something went wrong. Please try again later.");
            }

            // Close statement
            $stmt->close();
        }
    }

    $_SESSION['errors'] = $error_array;
    $_SESSION['signup_data'] = $_POST;
    header("location: ../view/signin.php");
    exit();
}
