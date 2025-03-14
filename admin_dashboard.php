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
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        main{
          margin-top:50px;
        }
        .main-content {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            min-height: calc(100vh - 80px); /* Adjust height to ensure footer is at the bottom */
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
      
          .dashboard-menu {
    width: 100%; /* Use full width */
    display: flex;
    flex-direction: column; /* Align items vertically */
    align-items: center; /* Center items horizontally */
    gap: 20px; /* Space between boxes */
}

.dashboard-menu a {
    width: 80%; /* Increase the width */
    height: 80px; /* Increase height for better visibility */
    padding: 20px;
    background-color: #fffde7; /* Very light yellow */
    text-align: center;
    text-decoration: none;
    color: #333;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px; /* Increase font size */
    font-weight: bold;
}

.dashboard-menu a:hover {
    background-color: #fff9c4;
}

   
        .pending-approvals {
            width: 28%;
            background-color: #f4f4f4;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .event-card {
            background-color: white;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            width: 100%; /* Make the event cards broader */
            box-sizing: border-box;
        }
        .event-card h3 {
            margin: 0;
            color: #333;
        }
        .event-card p {
            margin: 5px 0;
            color: #555;
        }
        .event-card a {
            display: inline-block;
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }
        .event-card form {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }
        .event-card form input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .event-card form input[type="submit"].reject {
            background-color: #dc3545;
        }
        .event-card form input[type="submit"].approve-featured {
            background-color: #ffc107;
        }
        footer {
            text-align: center;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
    <script>
        function handleEvent(action, eventId) {
            const formData = new FormData();
            formData.append('event_id', eventId);

            fetch(action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('event-' + eventId).remove();
                console.log(data);
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
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
          <li class="items"><a href="./logout.php">Logout</a></li>
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

    <main class="main-content">
        <div class="dashboard-menu">
            <a href="add_featured_events.php">Add Featured Events</a>
            <a href="add_upcoming_events.php">Add Upcoming Events</a>
            <a href="remove_featured_events.php">Remove Featured Events</a>
            <a href="remove_upcoming_events.php">Remove Upcoming Events</a>
        </div>

        <div class="pending-approvals">
            <h2>Pending Approvals</h2>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "joinfest";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $result = $conn->query("SELECT * FROM pending_events");

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="event-card" id="event-' . $row["id"] . '">';
                    echo '<h3>' . $row["event_name"] . '</h3>';
                    echo '<p>' . $row["college_name"] . '</p>';
                    echo '<p>Date: ' . $row["date"] . '</p>';
                    echo '<p>' . $row["description"] . '</p>';
                    echo '<a href="' . $row["event_link"] . '" class="view-more">View More</a>';
                    echo '<form onsubmit="event.preventDefault(); handleEvent(\'approve_event.php\', ' . $row["id"] . ');">';
                    echo '<input type="submit" value="Approve">';
                    echo '</form>';
                    echo '<form onsubmit="event.preventDefault(); handleEvent(\'reject_event.php\', ' . $row["id"] . ');">';
                    echo '<input type="submit" value="Reject" class="reject">';
                    echo '</form>';
                    echo '<form onsubmit="event.preventDefault(); handleEvent(\'approve_featured_event.php\', ' . $row["id"] . ');">';
                    echo '<input type="submit" value="Approve & Add to Featured" class="approve-featured">';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo "No pending approvals.";
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
