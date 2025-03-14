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

$event_name = $_POST['event_name'];
$college_name = $_POST['college_name'];
$date = $_POST['date'];
$description = $_POST['description'];
$event_link = $_POST['event_link'];
$event_type = $_POST['event_type'];

$stmt = $conn->prepare("INSERT INTO events (event_name, college_name, date, description, event_link, event_type) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $event_name, $college_name, $date, $description, $event_link, $event_type);

if ($stmt->execute()) {
    echo "Event added successfully.";
} else {
    echo "Error adding event: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
