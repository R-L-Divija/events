<?php
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

$name = $_POST['name'];
$college = $_POST['college'];
$date = $_POST['date'];
$description = $_POST['description'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$event_link = $_POST['event_link'];

// Insert into featured_events table
$stmt_featured = $conn->prepare("INSERT INTO featured_events (event_name, college_name, date, description, email, phone, event_link) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt_featured->bind_param("sssssss", $name, $college, $date, $description, $email, $phone, $event_link);

// Insert into events table
$stmt_events = $conn->prepare("INSERT INTO events (event_name, college_name, date, description, email, phone, event_link) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt_events->bind_param("sssssss", $name, $college, $date, $description, $email, $phone, $event_link);

if ($stmt_featured->execute() && $stmt_events->execute()) {
    echo "<script>
            alert('Featured event added successfully.');
            setTimeout(function() {
                window.location.href = 'admin_dashboard.php';
            }, 5000);
          </script>";
} else {
    echo "Error adding featured event: " . $stmt_featured->error . " | " . $stmt_events->error;
}

$stmt_featured->close();
$stmt_events->close();
$conn->close();
?>
