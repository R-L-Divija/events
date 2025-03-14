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

// Prepare and bind
$stmt = $conn->prepare("DELETE FROM events WHERE event_name=?");
$stmt->bind_param("s", $event_name);

if ($stmt->execute()) {
    echo "Event removed successfully.";
} else {
    echo "Error removing event: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
