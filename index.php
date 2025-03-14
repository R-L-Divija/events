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

$sql = "SELECT event_name, college_name, date, description, event_link FROM featured_events";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JoinFest</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<style>
.about-section {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
    padding: 60px 10%;
    background-color: #121212; /* Dark Theme Background */
    color: #ffffff;
    overflow: hidden;
}

.about-content {
    z-index: 1;
    background: rgba(30, 30, 30, 0.9);
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    animation: fadeInText 1.5s ease-in-out;
    max-width: 50%;
}

.about-content h2 {
    font-size: 2rem;
    margin-bottom: 10px;
    color: #ffcc00;
}

.about-content p {
    font-size: 1.1rem;
    line-height: 1.6;
    color: #ddd;
}

.about-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
    background: url('assets/about-bg.jpg') no-repeat center center/cover;
    filter: blur(5px) brightness(0.5);
    animation: fadeInBackground 1.5s ease-in-out;
}

.about-image img {
    max-width: 100%;
    height: auto;
    display: block;
}

/* Animations */
@keyframes fadeInText {
    from {
        transform: translateY(20px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

@keyframes fadeInBackground {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}
/* Carousel Wrapper */
.carousel-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    width: 100%;
    max-width: 100%;
    padding: 20px 0;
}

/* Carousel Container */
.carousel-container {
    display: flex;
    overflow: hidden;
    scroll-behavior: smooth;
    gap: 20px;
    max-width: 900px; /* Adjust width to fit 3 cards */
    padding: 10px;
    white-space: nowrap;
}

/* Individual Event Card */
.event-card {
    background: black;
    color: white;
    padding: 20px;
    border-radius: 10px;
    width: 300px;
    flex: 0 0 auto;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    transition: transform 0.3s ease;
    display: inline-block;
}

/* Hover Effect */
.event-card:hover {
    transform: scale(1.05);
}

/* View More Button */
.view-more {
    display: inline-block;
    background: yellow;
    color: black;
    padding: 10px 15px;
    border-radius: 5px;
    font-weight: bold;
    text-decoration: none;
    transition: background 0.3s ease;
}

.view-more:hover {
    background: orange;
}

/* Carousel Buttons */
.carousel-btn {
    background-color: #333;
    color: white;
    border: none;
    padding: 10px;
    font-size: 20px;
    cursor: pointer;
    border-radius: 50%;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10;
}

.prev-btn {
    left: 5px;
}

.next-btn {
    right: 5px;
}

/* Hide Scrollbar */
.carousel-container::-webkit-scrollbar {
    display: none;
}

/* Responsive */
@media screen and (max-width: 768px) {
    .carousel-container {
        max-width: 100%;
    }
}


    /* Footer Styling */
    .footer {
        background: linear-gradient(to right, #f8f9fa, #e9ecef); /* Neutral gradient */
        color: #333;
        padding: 40px 0;
        font-family: 'Arial', sans-serif;
    }

    .footer h5 {
        font-weight: bold;
        margin-bottom: 15px;
        color: #444;
    }

    .footer p, .footer ul {
        font-size: 14px;
        margin-bottom: 10px;
        color: #666;
    }

    .footer a {
        text-decoration: none;
        color: #555;
        transition: color 0.3s ease-in-out;
    }

    .footer a:hover {
        color:rgb(152, 231, 96);
    }

    .divider {
        border-color: rgba(0, 0, 0, 0.1);
    }

    /* Social Icons */
    .social-icon {
        font-size: 20px;
        margin: 0 10px;
        color: #555;
        transition: transform 0.3s ease-in-out, color 0.3s ease-in-out;
    }

    .social-icon:hover {
        transform: scale(1.2);
        color: #007bff;
    }


</style>

</head>
<body>
    <section>
    <?php
    include('./includes/head.php');
    ?>
</section>
   <!-- <main class="animate_animated animate_fadeInUp" >
        <section class="featured-events">
            <h2>Featured Events</h2>
            <div class="carousel-vertical animate_animated animate_fadeInLeft">
                <?php
               /*if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="event-card-vertical animate_animated animate_zoomIn">';
                        echo '<h3>' . $row["event_name"] . '</h3>';
                        echo '<p>' . $row["college_name"] . '</p>';
                        echo '<p>Date: ' . $row["date"] . '</p>';
                        echo '<p>' . $row["description"] . '</p>';
                        echo '<a href="' . $row["event_link"] . '" class="view-more">View More</a>';
                        echo '</div>';
                    }
                } else {
                    echo "No featured events found.";
                }
                $conn->close();
                */?>
            </div>
        </section>-->

<!--<main class="animate_animated animate_fadeInUp">
    <section class="featured-events" style="  background: linear-gradient(to right, #f8f9fa, #e9ecef);">
    <h2 style="color: black;">Featured Events</h2>

        <div class="carousel-vertical animate_animated animate_fadeInLeft">
            <?php
            /*if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="event-card-vertical animate_animated animate_zoomIn">';
                    echo '<h3>' . htmlspecialchars($row["event_name"]) . '</h3>';
                    echo '<p class="college">' . htmlspecialchars($row["college_name"]) . '</p>';
                    echo '<p class="date">📅 ' . htmlspecialchars($row["date"]) . '</p>';
                    echo '<p class="description">' . htmlspecialchars($row["description"]) . '</p>';
                    echo '<a href="' . htmlspecialchars($row["event_link"]) . '" class="view-more">View More</a>';
                    echo '</div>';
                }
            } else {
                echo "<p class='no-events'>No featured events found.</p>";
            }
            $conn->close();*/
            ?>
        </div>
    </section>
</main>-->
<main class="animate_animated animate_fadeInUp">
    <section class="featured-events" style="background: linear-gradient(to right, #f8f9fa, #e9ecef);">
        <h2 style="color: black; text-align: center;">Featured Events</h2>

        <!-- Carousel Wrapper -->
        <div class="carousel-wrapper">
            <button class="carousel-btn prev-btn"><i class="fas fa-chevron-left"></i></button>
            
            <div class="carousel-container">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="event-card">';
                        echo '<h3>' . htmlspecialchars($row["event_name"]) . '</h3>';
                        echo '<p class="college"><i>' . htmlspecialchars($row["college_name"]) . '</i></p>';
                        echo '<p class="date">📅 <span style="color: red; font-weight: bold;">' . htmlspecialchars($row["date"]) . '</span></p>';
                        echo '<p class="description">' . htmlspecialchars($row["description"]) . '</p>';
                        echo '<a href="' . htmlspecialchars($row["event_link"]) . '" class="view-more">View More</a>';
                        echo '</div>';
                    }
                } else {
                    echo "<p class='no-events'>No featured events found.</p>";
                }
                $conn->close();
                ?>
            </div>

            <button class="carousel-btn next-btn"><i class="fas fa-chevron-right"></i></button>
        </div>
    </section>
</main>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const carousel = document.querySelector(".carousel-container");
    const prevBtn = document.querySelector(".prev-btn");
    const nextBtn = document.querySelector(".next-btn");

    prevBtn.addEventListener("click", () => {
        carousel.scrollBy({ left: -320, behavior: "smooth" });
    });

    nextBtn.addEventListener("click", () => {
        carousel.scrollBy({ left: 320, behavior: "smooth" });
    });
});

</script>




        <!--<section id="about" class="animate_animated animate_fadeInUp">
            <h2>About JoinFest</h2>
            <p >JoinFest.com is a platform designed to efficiently manage and promote events, providing a seamless experience for both organizers and attendees. Whether you're hosting a college fest, corporate event, or community gathering, our website helps you streamline the process and reach your target audience. Browse upcoming events, create your own, and stay updated on the latest happenings. JoinFest.com ensures you never miss out on any exciting event in your area.</p>
           
        </section>-->
        <form id="about"></form>
        <section>
            <?php
              include('./includes/about.php');
            ?>
        </section>
 


       <!--<section id="contact" class="animate_animated animate_fadeInUp">
            <h2>Contact Info</h2>
            <p>Email: support@joinfest.com</p>
            <p>Phone: +91-123-456-7890</p>
            <form>
                <label for="help">Help Box:</label><br>
                <textarea id="help" name="help" rows="4" cols="50"></textarea><br>
                <input type="submit" value="Submit">
            </form>
        </section>
    </main>

    <footer class="animate_animated animate_fadeInUp">
        <p>&copy; 2025 JoinFest.com</p>
    </footer>-->
    <form id="contact"></form>
    <footer class="footer animate_animated animate_fadeInUp">
    <div class="container">
        <div class="row">
            <!-- About -->
            <div class="col-md-4">
                <h5>About JoinFest</h5>
                <p>Your go-to platform for seamless event management, making planning easier and more efficient.</p>
            </div>

            <!-- Quick Links -->
            <div class="col-md-2">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Events</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-md-3">
                <h5>Contact</h5>
                <p>Email: support@joinfest.com</p>
                <p>Phone: +1 123 456 7890</p>
                <p>Location: New York, USA</p>
            </div>

            <!-- Social Media -->
            <div class="col-md-3 text-center">
                <h5>Follow Us</h5>
                <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>

        <hr class="divider">

        <div class="text-center">
            <p>&copy; 2025 JoinFest. All Rights Reserved.</p>
        </div>
    </div>
</footer>

<!-- FontAwesome for Icons -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>


    <script src="script.js"></script>
</body>
</html>
