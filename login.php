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
                    header("Location: hr manager.html"); // Ensure this file exists
                    break;
                case 'Admin':
                    header("Location: admin.html");
                    break;
                case 'Employee':
                    header("Location: employee.html");
                    break;
                default:
                    header("Location: login.html"); // Fallback redirection
                    break;
            }
            exit();
        } else {
            // Account is inactive
            $error_message = "Your account is not active. Please contact the admin.";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="icon" href="mau image.ico" type="image/x-icon">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <style>
        .navbar-brand { color: white; background-color: green; }
        .error-message { color: red; }
        body { background-color: rgb(176, 176, 176); }
        .required-label { color: red; }
        .navbar-nav {
            margin-right: 50pt;
            margin-left: 120pt;
        }
        .login-container {
            max-width: 350px; /* Reduced max width for a more compact form */
            margin: auto; /* Center the form */
            background-color: white; /* White background for better contrast */
            padding: 15px; /* Reduced padding inside the form */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            margin-top: 10px; /* Give some space from the top */
        }
        .form-group {
            margin-bottom: 5px; /* Further reduced space between form elements */
        }
        button {
            background-color: green; /* Green background for the button */
            color: white; /* White text for the button */
            margin-right: 5px; /* Add margin to the right */
            width: 100%; /* Make the button full width */
        }
        h2 {
            font-size: 1.5rem; /* Reduce heading font size */
            margin-bottom: 10px; /* Space below the heading */
            text-align: center; /* Center the heading text */
        }
    </style>
</head>
<body>
    <img src="hrm.png" width="1348pt" height="110pt">
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">HRMS OF MaU</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="Home page.html">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="aboutDropdown" data-toggle="dropdown">About</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="background.html">BACKGROUND</a>
                        <a class="dropdown-item" href="mission and vision.html">MISSION AND VISION</a>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link" href="newspageboard.html">News</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="developer.html">Developers</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
            </ul>
        </div>
    </nav>

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
                <label for="role">Select Role:</label>
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
</body>
</html>