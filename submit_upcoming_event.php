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

$stmt = $conn->prepare("INSERT INTO events (event_name, college_name, date, description, email, phone, event_link) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $name, $college, $date, $description, $email, $phone, $event_link);

if ($stmt->execute()) {
    echo "<script>
            alert('Upcoming event added successfully.');
            setTimeout(function() {
                window.location.href = 'admin_dashboard.php';
            }, 5000);
          </script>";
} else {
    echo "Error adding upcoming event: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
