php
Run
Copy code
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User Account</title>
    <link rel="icon" href="mau image.ico" type="image/x-icon"> 
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa; /* Light grey background */
            font-family: Arial, sans-serif; /* Font for the text */
        }
        .container {
            max-width: 400px;
            margin-left: 40pt; /* Limit width */
            margin-top: 20px; /* Top margin */
            padding: 30px; /* Padding inside the container */
            background-color: #fff; /* White background for the form */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }
        h2 {
            text-align: center; /* Centered heading */
            margin-bottom: 20px; /* Space below heading */
        }
        .success-message {
            color: green;
            margin-bottom: 15px;
            text-align: center;
        }
        .error-message {
            color: red;
            margin-bottom: 15px;
            text-align: center;
        }
        .btn-success {
            width: 100%; /* Button width */
        }
        .form-group {
            margin-bottom: 15px; /* Space below form groups */
        }
        .button-group {
            display: flex; /* Flex for alignment */
            justify-content: space-between; /* Space between buttons */
        }
        .back-button {
            flex: 1; /* Take equal space */
            margin-right: 10px; /* Margin between buttons */
        }
        .ah {
            margin-left: 300pt;
        }
    </style>
</head>
<body class="alladmin">
        
    <div class="all">
        <h3 class="ah">Welcome to admin page</h3>
        <img src="hrm.png" width="1365pt" height="110pt">
        <nav class="navbar navbar-expand-lg navbar-light bg-color:green ">
        </nav>
    </div>

    <div class="container">
        <h2>Create User Account</h2>

        <?php
        // Initialize a variable for success and error messages
        $success_message = "";
        $error_message = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Database connection
            $host = "localhost"; // Database host
            $db_user = "root"; // Database username
            $db_password = ""; // Database password
            $db_name = "hrms"; // Database name

            // Create connection
            $conn = new mysqli($host, $db_user, $db_password, $db_name);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Collect form data
            $username = $_POST['username'];
            $password = $_POST['password']; // Store password as plain text
            $role = $_POST['role'];
            $status = $_POST['status'];

            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO users1 (username, password, role, status) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $password, $role, $status);

            // Execute the statement
            if ($stmt->execute()) {
                $success_message = "User  created successfully!";
            } else {
                $error_message = "Error: " . $stmt->error;
            }

            // Close connections
            $stmt->close();
            $conn->close();
        }
        ?>
                <?php if (!empty($success_message)): ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php endif; ?>
        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="role">Select Role:</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="">--Select Role--</option>
                    <option value="HR Manager">HR Manager</option>
                    <option value="Admin">Admin</option>
                    <option value="Employee">Employee</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <div class="button-group mt-3">
                <button type="button" class="btn btn-secondary back-button" onclick="window.location.href='admin.html'">Back</button>
                <button type="submit" class="btn btn-success">Create User</button>
            </div>
        </form>
    </div>
    <script src="bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
</body>
</html>