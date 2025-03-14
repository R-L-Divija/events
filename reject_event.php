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

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$event_id = $_POST['event_id'];

$result = $conn->query("DELETE FROM pending_events WHERE id = $event_id");

if ($result === TRUE) {
    echo "Event rejected and removed from the pending events table.";
} else {
    echo "Error rejecting event: " . $conn->error;
}

$conn->close();
?>
