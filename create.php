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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Events</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <style>
  /* Ensure full height of page */
html,body {
    height: 100%;
    margin: 0px;
    display: flex;
    flex-direction: column;
}

/* Make main content take available space */
main {
    flex: 1;
}
main {
    margin-top: 60px; /* Adjust to match your navbar height */
}

/* Footer stays at the bottom */
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
     
        /* Form Container */
        .form-container {
            max-width: 90%;
            width: 1000px;
            margin: 40px auto;
            padding: 20px;
            background-color: #1E1E1E;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #22F5B6;
        }

        /* Horizontal Form Layout */
        .form-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px; /* Space between input fields */
            justify-content: center;
            align-items: center;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            min-width: 250px;
            flex: 1;
        }

        .form-group label {
            font-weight: bold;
            color: #f4f4f4;
            margin-bottom: 5px;
        }

        .form-group input {
            padding: 10px;
            border: 1px solid #444;
            border-radius: 5px;
            background: #222;
            color: white;
            width: 100%;
        }

        .form-container input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #22F5B6;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: 0.3s;
            margin-top: 20px;
        }

        .form-container input[type="submit"]:hover {
            background-color: #1AC09C;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-grid {
                flex-direction: column;
            }
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 15px;
            background: rgba(0, 0, 0, 0.3);
            color: white;
            margin-bottom: 0px;
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


<main>
    <div class="form-container">
        <h2>Create an Event</h2>
        <form method="post" action="submit_pending_event.php">
            <div class="form-grid">
                <div class="form-group">
                    <label for="name">Event Name:</label>
                    <input type="text" id="name" name="name" placeholder="Enter event name" required>
                </div>
                <div class="form-group">
                    <label for="college">College Name:</label>
                    <input type="text" id="college" name="college" placeholder="Enter college name" required>
                </div>
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" required>
                </div>
                <div class="form-group">
                    <label for="description">One-line Description:</label>
                    <input type="text" id="description" name="description" placeholder="Enter a short description" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Enter contact email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Mobile No:</label>
                    <input type="tel" id="phone" name="phone" placeholder="Enter mobile number" required>
                </div>
                <div class="form-group">
                    <label for="event_link">Event Website Link:</label>
                    <input type="url" id="event_link" name="event_link" placeholder="Enter event website link" required>
                </div>
            </div>
            <input type="submit" value="Submit">
        </form>
    </div>
</main>

<footer>
    <p>&copy; 2025 JoinFest.com</p>
</footer>

</body>
</html>
