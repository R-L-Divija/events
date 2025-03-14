<?php
session_start();

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($password)) {
        // Prepare and execute the SQL statement correctly
        $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($hashed_password);
            $stmt->fetch();

            // Verify password
            if (password_verify($password, $hashed_password)) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username; // Store username in session
                header("Location: admin_dashboard.php");
                exit;
            }
        }

        echo "Invalid username or password. Please try again.";
        $stmt->close();
    } else {
        echo "Both username and password are required.";
    }
}

$conn->close();
?>
