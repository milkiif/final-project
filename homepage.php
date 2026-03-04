<?php
session_start();
$host = "localhost"; 
$db_user = "root"; 
$db_password = "";
$db_name = "hrms"; 

// Create connection
$conn = new mysqli($host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$username = $password = $role = "";
$error_message = ""; // Initialize error message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password']; // Use plain text password
    $role = $_POST['role'];

    // Validate user in the database (without checking status first)
    $stmt = $conn->prepare("SELECT * FROM users1 WHERE username = ? AND password = ? AND role = ?");
    $stmt->bind_param("sss", $username, $password, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found, now check their status
        $user = $result->fetch_assoc();
        
        if ($user['status'] === 'active') {
            // User is authenticated and active
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            switch ($user['role']) {
                case 'HR Manager':
                    header("Location: hr manager.html"); 
                    break;
                case 'Admin':
                    header("Location: admin.html");
                    break;
                case 'Employee':
                    header("Location: employee.html");
                    break;
                default:
                    header("Location: login.php");
                    break;
            }
            exit();
        } else {
            // Account is inactive
            $error_message = "Your account is not active. Please contact admin.";
        }
    } else {
        $error_message = "Invalid username, password, or role.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HRMS OF MaU</title>
    <link rel="icon" href="mau image.ico" type="image/x-icon"> 
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css"> 
    <style>
        body {
            background-color: #f4f4f4; /* Light background for better readability */
        }

        .navbar {
            background-color: green; 
        }

        .navbar-brand, .nav-link {
            color: white; /* Navbar text color */
        }

        .nav-link:hover {
            color: yellow; /* Change color on hover */
        }

        #carouselExampleCaptions {
            position: relative; /* Set positioning context for absolute positioning */
        }

        .carousel-item img {
            height: 550pt; /* Fixed height for images */
        }

        /* Styles for carousel buttons to remove focus and active color */
        .carousel-control-prev, .carousel-control-next {
            background-color: transparent; /* Make background transparent */
            border: none; /* Remove border */
        }

        .carousel-control-prev:focus, .carousel-control-next:focus {
            outline: none; /* Remove outline when focused */
        }

        .carousel-control-prev:hover, .carousel-control-next:hover {
            background-color: transparent; /* Ensure no change on hover */
        }

        /* Login form styles */
        .login-container {
            max-width: 400px; 
            margin: 0 auto; /* Centering */
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white */
            padding: 20px; 
            border-radius: 15px; 
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); 
            position: absolute; /* Absolute position to overlap the carousel */
            top: 60%; /* Center vertically */
            left: 84%; /* Center horizontally */
            transform: translate(-50%, -50%); /* Adjust to ensure centered properly */
        }

        h2 {
            text-align: center; 
            color: #333; /* Dark text for the heading */
        }

        .form-group {
            margin-bottom: 15px; 
        }

        .form-control {
            height: 40px; 
            border-radius: 20px; 
            border: 1px solid #ccc;
        }

        .form-control:focus {
            border: 1px solid #6bd1ff; 
            box-shadow: 0 0 5px rgba(107, 209, 255, 0.5); 
        }

        button {
            background-color: green; /* Button color */
            color: white; /* Button text */
            border-radius: 20px; 
            width: 100%; 
            border: none; 
            transition: background 0.3s; 
        }

        button:hover {
            background-color: #5cb3e4; /* Button hover effect */
        }

        .error-message {
            color: red; 
            margin-bottom: 10px; 
        }

        .required-label {
            color: red;        /* Color for the required asterisk */
            /* Removed strikethrough */
            margin-left: 5px; /* Space between label and asterisk */
        }

        .navbar-nav {
            margin-right: 50pt;
            margin-left: 120pt;
        }

        .milk {
            margin-left: 130%; 
        }

        .footer {
            background-color: #333; 
            color: white; /* White text for contrast */
            text-align: center; /* Center text */
            padding: 20px; /* Padding for footer */
            position: relative; /* Positioning for potential future enhancements */
        }

        .footer a {
            color: white; /* White text for footer links */
            margin: 0 10px; /* Spacing between footer links */
        }

        .footer a:hover {
            text-decoration: underline; /* Underline on hover for footer links */
        }

        .social-icons img {
            width: 30px; /* Set width for social media icons */
            margin: 0 10px; /* Spacing between icons */
        }

        /* Responsive design */
        @media (max-width: 600px) {
            .section {
                padding: 20px; /* Reduce padding on smaller screens */
            }
        }
    </style>
</head>
<body>

    <img src="hrm.png" width="1348pt" height="110pt" alt="Header Image">
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">HRMS of MaU</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="homepage.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="aboutDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        About
                    </a>
                    <div class="dropdown-menu" aria-labelledby="aboutDropdown">
                        <a class="dropdown-item" href="background.html">Background</a>
                        <a class="dropdown-item" href="mission and vision.html">Mission and Vision</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="newspageboard.html">News</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="developer.html">Developers</a>
                </li>
                <div class="milk">
                    <li class="nav-item">
                        <a class="nav-link" href="">Login</a>
                    </li>
                </div>
            </ul>
        </div>
    </nav>

    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="mau.jpg" class="d-block w-100" alt="Mattu University">
                <div class="carousel-caption d-none d-md-block">
                    <h3>Welcome to the Human Resource Management System of Mattu University</h3>
                </div>
            </div>
            <div class="carousel-item">
                <img src="mau2.jpg" class="d-block w-100" alt="Mattu University">
                <div class="carousel-caption d-none d-md-block">
                    <h3>Welcome to the Human Resource Management System of Mattu University</h3>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="login-container">
        <h2>Login Form</h2>
        <?php if ($error_message): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label for="username">Username:<span class="required-label">*</span></label>
                <input type="text" id="username" name="username" required class="form-control" />
            </div>
            <div class="form-group">
                <label for="password">Password:<span class="required-label">*</span></label>
                <input type="password" id="password" name="password" required class="form-control" />
            </div>
            <div class="form-group">
                <label for="role">Select Role:<span class="required-label">*</span></label>
                <select id="role" name="role" required class="form-control">
                    <option value="">--Select Role--</option>
                    <option value="HR Manager">HR Manager</option>
                    <option value="Admin">Admin</option>
                    <option value="Employee">Employee</option>
                </select>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>

    <footer class="footer">
        <div class="social-icons">
           <img src="facebook-new.png" alt="Facebook"></a>
            <img src="download.png" alt="Twitter"></a>
            <img src="download (1).png" alt="Instagram"></a>
         <br><br><br>
        </div>
        <p>&copy; 2025 HRMS of Mattu University.</p>
    </footer>

    <script src="bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
</body>
</html>