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
    html, body {
    height: 100%;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    background-color:rgb(205, 198, 198);
}

/* Make main content take available space */
main {
    flex: 1;
}


/* Footer sticks to the bottom */
footer {
    text-align: center;
    padding: 15px;
    background: rgba(0, 0, 0, 0.3);
    color: white;
    margin-top: auto;
}
           @import url('https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700&display=swap');
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}

nav {
  background: rgba(0, 0, 0, 0.3); /* Slightly transparent black */
  backdrop-filter: blur(10px); /* Adds blur effect */
  position: fixed;
  width: 100%;
  top: 0;
  left: 0;
  padding: 5px 20px;
  transition: 0.3s;
  z-index: 1000; /* Ensures navbar stays on top */
}

nav ul {
  list-style: none;
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: center;
}
nav ul li {
  padding: 15px 0;
  cursor: pointer;
}
nav ul li.items {
  position: relative;
  width: auto;
  margin: 0 16px;
  text-align: center;
  order: 3;
}
nav ul li.items:after {
  position: absolute;
  content: '';
  left: 0;
  bottom: 5px;
  height: 2px;
  width: 100%;
  background: rgb(34, 245, 182);
  opacity: 0;
  transition: all 0.2s linear;
}
nav ul li.items:hover:after {
  opacity: 1;
  bottom: 8px;
}
nav ul li.logo {
  flex: 1;
  color: white;
  font-size: 17px;
  font-weight: 600;
  cursor: default;
  user-select: none;
}
nav ul li a {
  color: white;
  font-size: 15px;
  text-decoration: none;
  transition: 0.4s;
}
nav ul li:hover a {
  color: rgb(34, 245, 182);
}
nav ul li i {
  font-size: 23px;
}
nav ul li.btn {
  display: none;
}
nav ul li.btn.hide i:before {
  content: '\f00d';
}
@media all and (max-width: 900px) {
  nav {
    padding: 5px 30px;
  }
  nav ul li.items {
    width: 100%;
    display: none;
  }
  nav ul li.items.show {
    display: block;
  }
  nav ul li.btn {
    display: block;
  }
  nav ul li.items:hover {
    border-radius: 5px;
    box-shadow: inset 0 0 5px rgb(34, 245, 182),
      inset 0 0 10px rgb(34, 245, 203);
  }
  nav ul li.items:hover:after {
    opacity: 0;
  }
}
     
        /* Ensure content does not get hidden under the navbar */
        main {
            padding-top: 100px;
            text-align: center;
        }

        /* Search Filter Box */
        .filter-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            align-items: center;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1); /* Light Transparent Box */
            border-radius: 8px;
            margin: 20px auto;
            width: 90%;
            max-width: 900px;
        }

        /* Input Box Styles */
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
            padding: 10px;
            border: 1px solid #444;
            border-radius: 5px;
            width: 220px;
            background: #222;
            color: #fff;
        }

        /* Search Button */
        .filter-item input[type="submit"] {
            background-color: #22F5B6;
            color: black;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            width: 120px;
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
          <li class="logo">JoinFest</li>
          <li class="items"><a href="./index.php">Home</a></li>
          <li class="items"><a href="./upcoming.php">Upcoming Events</a></li>
          <li class="items"><a href="./create.php">Create Events</a></li>
          <li class="items"><a href="./index.php#about">About</a></li>
          <li class="items"><a href="./index.php#contact">Contact</a></li>
          <li class="items"><a href="./admin.php">Admin Login</a></li>
          <li class="btn">
            <a href="#"><i class="fas fa-bars"></i></a>
          </li>
        </ul>
      </nav>
    </header>
    <script>
      $(document).ready(function () {
        $('.btn').click(function () {
          $('.items').toggleClass('show');
          $('ul li').toggleClass('hide');
        });
      });
    </script>

<main class="animate__animated animate__fadeInUp">
    <h2 style="text-align:center; margin-bottom: 20px; color:white">Upcoming Events</h2>

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
