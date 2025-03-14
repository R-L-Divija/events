<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: admin.php');
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "joinfest";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$event_id = $_POST['event_id'];

$result = $conn->query("SELECT * FROM pending_events WHERE id = $event_id");

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Insert into featured_events table
    $stmt_featured = $conn->prepare("INSERT INTO featured_events (event_name, college_name, date, description, email, phone, event_link) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt_featured->bind_param("sssssss", $row['event_name'], $row['college_name'], $row['date'], $row['description'], $row['email'], $row['phone'], $row['event_link']);

    // Insert into events table
    $stmt_events = $conn->prepare("INSERT INTO events (event_name, college_name, date, description, email, phone, event_link) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt_events->bind_param("sssssss", $row['event_name'], $row['college_name'], $row['date'], $row['description'], $row['email'], $row['phone'], $row['event_link']);

    if ($stmt_featured->execute() && $stmt_events->execute()) {
        $conn->query("DELETE FROM pending_events WHERE id = $event_id");
        echo "Event approved and added to featured events and main events table.";
    } else {
        echo "Error approving event: " . $stmt_featured->error . " | " . $stmt_events->error;
    }

    $stmt_featured->close();
    $stmt_events->close();
} else {
    echo "Event not found.";
}

$conn->close();
?>
