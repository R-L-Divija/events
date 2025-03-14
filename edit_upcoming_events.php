<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: admin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Upcoming Events</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="logo.png" alt="Logo" class="logo">
        <h1>JoinFest.com</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="upcoming.php">Upcoming Events</a></li>
                <li><a href="create.php">Create Events</a></li>
                <li><a href="index.php#about">About</a></li>
                <li><a href="index.php#contact">Contact</a></li>
                <li><a href="admin.php">Admin Login</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Edit Upcoming Events</h2>
        <form method="post" action="update_event.php">
            <label for="event-name">Event Name:</label>
            <input type="text" id="event-name" name="event_name" placeholder="Enter event name"><br>
            <label for="college-name">College Name:</label>
            <input type="text" id="college-name" name="college_name" placeholder="Enter college name"><br>
            <label for="date">Date:</label>
            <input type="date" id="date" name="date"><br>
            <label for="description">One-line Description:</label>
            <input type="text" id="description" name="description" placeholder="Enter a short description"><br>
            <label for="event-link">Event Link:</label>
            <input type="url" id="event-link" name="event_link" placeholder="Enter event website link"><br>
            <input type="hidden" name="event_type" value="upcoming">
            <input type="submit" value="Update Event">
        </form>
    </main>

    <footer>
        <p>&copy; 2025 JoinFest.com</p>
    </footer>
</body>
</html>
