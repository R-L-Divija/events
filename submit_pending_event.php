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

// Fetch upcoming events
$sql = "SELECT event_name, college_name, date, description, event_link FROM events WHERE event_type = 'upcoming'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Events</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #121212; /* Dark Background */
            color: #f4f4f4; /* Light Text for Contrast */
            padding-top: 60px;
        }

        /* Navigation Bar */
        nav {
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            padding: 10px 20px;
            transition: 0.3s;
            z-index: 1000;
        }

        nav ul {
            list-style: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        nav ul li {
            padding: 15px 20px;
            cursor: pointer;
        }

        nav ul li a {
            color: white;
            font-size: 15px;
            text-decoration: none;
            transition: 0.4s;
        }

        nav ul li a:hover {
            color: rgb(34, 245, 182);
        }

        /* Dark Theme Filter Form */
        .filter-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
            align-items: center;
            padding: 15px;
            background: rgba(255, 255, 255, 0.1); /* Transparent White */
            border-radius: 8px;
            margin: 20px auto;
            width: 90%;
            max-width: 1000px;
        }

        .filter-item {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .filter-item label {
            font-weight: 600;
            margin-bottom: 5px;
            color: #f4f4f4;
        }

        .filter-item input {
            padding: 8px;
            border: 1px solid #444;
            border-radius: 5px;
            width: 180px;
            background: #222;
            color: #fff;
        }

        .filter-item input[type="submit"] {
            background-color: #22F5B6;
            color: black;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            width: 100px;
        }

        .filter-item input[type="submit"]:hover {
            background-color: #1AC09C;
        }

        /* Event Cards */
        .event-cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .event-card {
            background: #1E1E1E;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            width: 300px;
            text-align: center;
            transition: 0.3s;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.3);
        }

        .event-card h3 {
            color: #fff;
            margin-bottom: 10px;
        }

        .event-card p {
            color: #bbb;
            font-size: 14px;
            margin: 5px 0;
        }

        .view-more {
            display: inline-block;
            background: #22F5B6;
            color: black;
            padding: 8px 12px;
            margin-top: 10px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .view-more:hover {
            background: #1AC09C;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 15px;
            background: rgba(0, 0, 0, 0.3);
            color: white;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<header>
    <nav>
        <ul>
            <li><a href="./index.php">Home</a></li>
            <li><a href="./upcoming.php">Upcoming Events</a></li>
            <li><a href="./create.php">Create Events</a></li>
            <li><a href="./index.php#about">About</a></li>
            <li><a href="./index.php#contact">Contact</a></li>
            <li><a href="./admin.php">Admin Login</a></li>
        </ul>
    </nav>
</header>

<main class="animate__animated animate__fadeInUp">
    <h2 style="text-align:center; margin-bottom: 20px;">Upcoming Events</h2>

    <form method="get" action="" class="filter-form">
        <div class="filter-container">
            <div class="filter-item">
                <label for="search">Search:</label>
                <input type="text" id="search" name="search" placeholder="Search events...">
            </div>
            <div class="filter-item">
                <label for="from-date">From:</label>
                <input type="date" id="from-date" name="from-date">
            </div>
            <div class="filter-item">
                <label for="to-date">To:</label>
                <input type="date" id="to-date" name="to-date">
            </div>
            <div class="filter-item">
                <label for="place">Place:</label>
                <input type="text" id="place" name="place" placeholder="Enter location">
            </div>
            <div class="filter-item">
                <input type="submit" value="Filter">
            </div>
        </div>
    </form>

    <div class="event-cards animate__animated animate__fadeInUp">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="event-card animate__animated animate__zoomIn">';
                echo '<h3>' . $row["event_name"] . '</h3>';
                echo '<p>' . $row["college_name"] . '</p>';
                echo '<p>Date: ' . $row["date"] . '</p>';
                echo '<p>' . $row["description"] . '</p>';
                echo '<a href="' . $row["event_link"] . '" class="view-more">View More</a>';
                echo '</div>';
            }
        } else {
            echo "<p style='text-align:center;'>No upcoming events found.</p>";
        }
        $conn->close();
        ?>
    </div>
</main>

<footer>
    <p>&copy; 2025 JoinFest.com</p>
</footer>

</body>
</html>
