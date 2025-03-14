<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #d3d3d3; /* Light grey background */
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
     

        /* Main Container */
        .cloud-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100vh;
            padding: 100px; 
            margin-top:20px/* Space from the navbar */
        }

        /* Left Side - Form */
        .cloud {
            background-color: #a9a9a9;
            padding: 40px;
            width: 40%;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            text-align: left;
        }

        .cloud form {
            display: flex;
            flex-direction: column;
        }

        .cloud label, .cloud input {
            width: 100%;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .cloud input[type="text"], 
        .cloud input[type="password"] {
            padding: 10px;
            border: none;
            border-radius: 5px;
        }

        .cloud input[type="submit"] {
            background-color:rgb(37, 212, 177);
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            width: 50%;
            transition: background-color 0.3s;
        }

        .cloud input[type="submit"]:hover {
            background-color: rgb(37, 212, 177);
        }

        /* Right Side - Image */
        .background-image {
            width: 50%;
            height: 80vh;
            background-image: url('admin_bg.png'); /* Replace with actual image */
            background-repeat: no-repeat;
            background-size: contain;
            background-position: center;
        }

        /* Responsive Design */
        @media (max-width: 900px) {
            .cloud-container {
                flex-direction: column;
                justify-content: center;
                padding: 50px;
            }
            .cloud {
                width: 80%;
                margin-bottom: 20px;
            }
            .background-image {
                width: 100%;
                height: 50vh;
            }
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

    <!-- Main Content -->
    <div class="cloud-container">
        <!-- Left Side - Form -->
        <div class="cloud">
            <form method="post" action="admin_login.php">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <input type="submit" value="Login">
            </form>
        </div>

        <!-- Right Side - Image -->
        <div class="background-image"></div>
    </div>

    <!-- Footer -->
    <footer>
        <p style="text-align: center;">&copy; 2025 JoinFest.com</p>
    </footer>

</body>
</html>
