<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove Featured Events</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
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
        main {
            margin-top: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Form Container */
        .form-container {
            width: 90%;
            max-width: 600px;
            padding: 20px;
            background-color: black;
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }

        .form-container h2 {
            margin-bottom: 20px;
            color: #dc3545;
        }

        /* Form Layout - Two Columns */
        .form-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .form-group {
            width: 48%; /* Two-column layout */
            display: flex;
            flex-direction: column;
        }

        .form-container label {
            margin-bottom: 5px;
            font-weight: bold;
            text-align: left;
        }

        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="tel"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            background: #222;
            color: white;
        }

        /* Full-Width Input */
        .form-group.full-width {
            width: 100%;
        }

        .form-container input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .form-container input[type="submit"]:hover {
            background-color: #c82333;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
            }
            .form-group {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<header>
      <nav>
        <ul>
          <li class="logo">JoinFest</li>
          <li class="items"><a href="./admin_dashboard.php">Home</a></li>
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

<main>
    <div class="form-container">
        <h2>Remove Featured Event</h2>
        <form method="post" action="delete_featured_event.php">
            <div class="form-row">
                <div class="form-group">
                    <label for="event_name">Event Name:</label>
                    <input type="text" id="event_name" name="event_name" placeholder="Enter event name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Enter contact email" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group full-width">
                    <label for="phone">Mobile No:</label>
                    <input type="tel" id="phone" name="phone" placeholder="Enter mobile number" required>
                </div>
            </div>

            <input type="submit" value="Remove">
        </form>
    </div>
</main>

<footer>
    <p style="text-align: center;">&copy; 2025 JoinFest.com</p>
</footer>

</body>
</html>
