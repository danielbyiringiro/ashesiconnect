<?php
// Include the database connection file
include'../settings/connection.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $event_name = $_POST['event-name'];
    $event_date = $_POST['event-date'];
    $event_location = $_POST['event-location'];
    $event_description = $_POST['event-description'];

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO events (event_name, event_description, event_date, location, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssss", $event_name, $event_description, $event_date, $event_location);

    // Execute the SQL statement
    if ($stmt->execute() === TRUE) {
        echo "New record created successfully";

        // Check if data was inserted by retrieving the affected rows count
        if ($stmt->affected_rows > 0) {
            echo " Data successfully inserted into the database.";
        } else {
            echo " Data was not inserted into the database.";
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();

    // Close connection
$conn->close();
}


?>
