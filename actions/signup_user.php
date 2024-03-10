<?php
session_start(); // Start the session

unset($_SESSION['errors']);
unset($_SESSION['signup_data']);

$error_array = array();

include('../settings/connection.php');

// Define variables and initialize with empty values
$first_name = $last_name = $email = $phone = $password = $major = $year_group = $dob = $gender = "";
$first_name_err = $last_name_err = $email_err = $phone_err = $password_err = $major_err = $year_group_err = $dob_err = $gender_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate first name
    // Validate first name
    if (empty(trim($_POST["first_name"]))) 
    {
        array_push($error_array,"Please enter your first name.");
    } else {
        $first_name = trim($_POST["first_name"]);
    }

    // Validate last name
    if (empty(trim($_POST["last_name"]))) {
        array_push($error_array, "Please enter your last name.");
    } else {
        $last_name = trim($_POST["last_name"]);
    }

    // Validate email
    if (empty(trim($_POST["emailaddress"]))) {
        array_push($error_array, "Please enter your email address.<br>");
    } elseif (!filter_var(trim($_POST["emailaddress"]), FILTER_VALIDATE_EMAIL)) {
        array_push($error_array, "Invalid email format. Please enter a valid email address.<br>");
    } else {
        // Check if the email is already taken
        $param_email = trim($_POST["emailaddress"]);
        $sql = "SELECT id FROM users WHERE email = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $param_email);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows == 1) {
                    array_push($error_array, "This email is already taken.<br>");
                } else {
                    $email = $param_email;
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.<br>";
            }
            $stmt->close();
        }
    }

    // Validate phone number
    if (empty(trim($_POST["phone"]))) {
        array_push($error_array, "Please enter your phone number.<br>");
    } else {
        $phone = trim($_POST["phone"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        array_push($error_array, "Please enter a password.<br>");
    } elseif (strlen(trim($_POST["password"])) < 6) {
        array_push($error_array, "Password must have at least 6 characters.<br>");
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate major
    if (empty($_POST["major"])) {
        array_push($error_array , "Please select your major.<br>");
    } else {
        $major = trim($_POST["major"]);
    }

    // Validate year group
    if (empty($_POST["yeargroup"])) {
        array_push($error_array, "Please select your year group.<br>");
    } else {
        $year_group = trim($_POST["yeargroup"]);
    }

    // Validate date of birth
    if (empty($_POST["dob"])) {
       array_push($error_array, "Please enter your date of birth.<br>");
    } else {
        $dob = trim($_POST["dob"]);
    }

    // Validate gender
    if (!isset($_POST['gender'])) {
        array_push($error_array, "Please select your gender.<br>");
    } else {
        $gender = ($_POST['gender'] == 0) ? 'Male' : 'Female';
    }

    // Check input errors before inserting into database
    if (empty($error_array)) 
    {
        // Prepare an insert statement
        echo "Hello";
        $sql = "INSERT INTO users (first_name, last_name, email, phone_number, password_hash, major, year_group, date_of_birth, gender, Created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

        if ($stmt = $conn->prepare($sql)) 
        {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssssssiss", $param_first_name, $param_last_name, $param_email, $param_phone, $param_password, $param_major, $param_year_group, $param_dob, $param_gender);

            // Set parameters
            $param_first_name = $first_name;
            $param_last_name = $last_name;
            $param_email = $email;
            $param_phone = $phone;
            $param_password = password_hash(trim($password), PASSWORD_DEFAULT); // Creates a password hash
            $param_major = $major;
            $param_year_group = $year_group;
            $param_dob = $dob;
            $param_gender = $gender;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) 
            {
                // Redirect to login page
                header("location: ../view/signin.php");
                exit();
            } 
            else 
            {
                echo "Something went wrong. Please try again later.<br>";
            }

            // Close statement
            $stmt->close();
        }
    }
    // Close connection
    else
    {
        $_SESSION['signup_data'] = $_POST;
        $_SESSION['errors'] = $error_array;
        header("Location: ../view/signup.php");
        exit();
    }

    $conn->close();
}
