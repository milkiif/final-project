

<?php
// Database configuration
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "hrms"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the employee ID from the form
$employeeId = $_POST['employeeId'];

// Prepare and bind
$stmt = $conn->prepare("SELECT * FROM registration WHERE employee_id = ?");
$stmt->bind_param("s", $employeeId);

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Start HTML output
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
  <style>
 .all {
            margin-top: -14pt;
            margin-left: -14pt;
            margin-right: -14pt;
        }
        .ah {
            margin-left: 300pt;
        }
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin-top: 8pt;
        }
        h2 {
            text-align: center;
            color: #343a40;
            margin-bottom: 20px;
        }
        .employee-detail {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #007BFF;
            border-radius: 5px;
            background-color: #e9f7ff;
        }
        .employee-detail b {
            color: #007BFF;
        }
        .not-found {
            text-align: center;
            color: red;
            font-weight: bold;
        }
        .back-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body class="alladmin">
        
    <div class="all">
        <h3 class="ah">Welcome to employee page</h3>
        <img src="hrm.png" width="1365pt" height="110pt" style="margin-bottom: 20px;"> <!-- Added margin-bottom for spacing -->
    </div>
    
<div class="container">
    <?php
    // Check if any employee was found
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<h2>Employee Details</h2>";
            echo "<div class='employee-detail'><b>First Name:</b> " . htmlspecialchars($row['first_name']) . "</div>";
            echo "<div class='employee-detail'><b>Middle Name:</b> " . htmlspecialchars($row['middle_name']) . "</div>";
            echo "<div class='employee-detail'><b>Last Name:</b> " . htmlspecialchars($row['last_name']) . "</div>";
            echo "<div class='employee-detail'><b>Employee ID:</b> " . htmlspecialchars($row['employee_id']) . "</div>";
            echo "<div class='employee-detail'><b>Email:</b> " . htmlspecialchars($row['email']) . "</div>";
            echo "<div class='employee-detail'><b>Phone:</b> " . htmlspecialchars($row['phone']) . "</div>";
            echo "<div class='employee-detail'><b>Department:</b> " . htmlspecialchars($row['department']) . "</div>";
            echo "<div class='employee-detail'><b>Education Level:</b> " . htmlspecialchars($row['education_level']) . "</div>";
            echo "<div class='employee-detail'><b>Salary:</b> " . htmlspecialchars($row['salary']) . "</div>";
            echo "<div class='employee-detail'><b>Date of Joining:</b> " . htmlspecialchars($row['date_of_joining']) . "</div>";
            echo "<a href='profile.html' class='back-button'>Back</a>";
        }
    } else {
        echo "<div class='not-found'>No employee found with ID: " . htmlspecialchars($employeeId);
}

// Close connections
$stmt->close();
$conn->close();
?>