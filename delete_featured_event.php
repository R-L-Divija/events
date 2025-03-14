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
$email = $_POST['email'];
$phone = $_POST['phone'];

$stmt = $conn->prepare("DELETE FROM featured_events WHERE event_name = ? AND email = ? AND phone = ?");
$stmt->bind_param("sss", $event_name, $email, $phone);

if ($stmt->execute()) {
    echo "<script>
            alert('Featured event removed successfully.');
            setTimeout(function() {
                window.location.href = 'admin_dashboard.php';
            }, 5000);
          </script>";
} else {
    echo "Error removing featured event: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
