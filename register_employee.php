<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Registration Form</title>
    <link rel="icon" href="mau image.ico" type="image/x-icon">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <style>
          .all {
            margin-top: -30pt;
            margin-left: -35pt;
            margin-right: -35pt;
        }
        .ah {
            margin-left: 300pt;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        input[type="reset"] {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="reset"]:hover {
            background-color: #0056b3;
        }
        .message {
            margin-bottom: 20px;
            text-align: center;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }

        a {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: #4CAF50; /* Green */
            font-weight: bold;
            padding: 10px 15px;
            border: 2px solid #4CAF50; /* Green border */
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }
        a:hover {
            background-color: #4CAF50; /* Green */
            color: white; /* White text on hover */
        }
    </style>
</head>
<body class="alladmin">
        
    <div class="all">
        <h3 class="ah">Welcome to employee page</h3>
        <img src="hrm.png" width="1365pt" height="110pt" style="margin-bottom: 20px;"> <!-- Added margin-bottom for spacing -->
    </div>



<h1>Employee Registration Form</h1>

<?php
// Database connection details
$host = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "hrms"; 

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables for messages
$success_message = "";
$error_message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $firstName = htmlspecialchars($_POST['firstName']);
    $middleName = htmlspecialchars($_POST['mirstName']);
    $lastName = htmlspecialchars($_POST['lastName']);
    $empId = htmlspecialchars($_POST['emid']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $department = htmlspecialchars($_POST['department']);
    $education = htmlspecialchars($_POST['educ']);
    $salary = htmlspecialchars($_POST['salary']);
    $dateOfJoining = htmlspecialchars($_POST['dateOfJoining']);
    $status = htmlspecialchars($_POST['status']);

    // Validate inputs (basic validation)
    if (empty($firstName) || empty($lastName) || empty($empId) || empty($email) || empty($phone) || empty($department) || empty($education) || empty($salary) || empty($dateOfJoining) || empty($status)) {
        $error_message = "All fields are required. Please fill out the form completely.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format. Please enter a valid email address.";
    } elseif (!preg_match("/^\+251[0-9]{8}$/", $phone)) {
        $error_message = "Invalid phone number format. Please use the format +251XXXXXXXX.";
    } else {
        // Prepare SQL query to insert data into the database
        $sql = "INSERT INTO registration (first_name, middle_name, last_name, employee_id, email, phone, department, education_level, salary, date_of_joining, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Check if the query is valid
        if (!$stmt) {
            $error_message = "Error in SQL query: " . $conn->error;
        } else {
            // Bind parameters to the query
            $stmt->bind_param("ssssssssdss", $firstName, $middleName, $lastName, $empId, $email, $phone, $department, $education, $salary, $dateOfJoining, $status);

            // Execute the query
            if ($stmt->execute()) {
                $success_message = "Employee registration successful!";
            } else {
                $error_message = "Error: " . $stmt->error;
            }
            // Close the statement
            $stmt->close();
        }
    }
}

// Close the database connection
$conn->close();
?>

<form action="" method="POST">
    <?php if (!empty($success_message)) : ?>
        <div class="message success"><?php echo $success_message; ?></div>
    <?php elseif (!empty($error_message)) : ?>
        <div class="message error"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <label for="firstName">First Name:</label>
    <input type="text" id="firstName" name="firstName" required>

    <label for="mirstName">Middle Name:</label>
    <input type="text" id="mirstName" name="mirstName" required>

    <label for="lastName">Last Name:</label>
    <input type="text" id="lastName" name="lastName" required>

    <label for="empid">Employee ID:</label>
    <input type="text" id="empid" name="emid" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="phone">Phone Number:</label>
    <input type="tel" id="phone" name="phone" pattern="^\+251[0-9]{8}$" required placeholder="+251XXXXXXXX">

    <label for="department">Department:</label>
    <input type="text" id="department" name="department" required>

    <label for="educ">Education Level:</label>
    <input type="text" id="educ" name="educ" required>

    <label for="salary">Salary:</label>
    <input type="text" id="salary" name="salary" required>

    <label for="dateOfJoining">Date of Joining:</label>
    <input type="date" id="dateOfJoining" name="dateOfJoining" required>

    <label for="status">Status:</label>
    <input type="text" id="status" name="status" required>

    <input type="submit" value="Register Employee">
    <a href="employee.html">Back</a>
</form>

</body>
</html>