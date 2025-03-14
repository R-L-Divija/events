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

// Prepare and bind
$stmt = $conn->prepare("UPDATE events SET college_name=?, date=?, description=?, event_link=?, event_type=? WHERE event_name=?");
$stmt->bind_param("ssssss", $college_name, $date, $description, $event_link, $event_type, $event_name);

if ($stmt->execute()) {
    echo "Event updated successfully.";
} else {
    echo "Error updating event: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
