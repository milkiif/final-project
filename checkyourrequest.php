<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "hrms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize a message variable for user feedback
$message = "";

// Initialize a variable to hold the employee ID
$employee_id = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = $_POST['employee_id'];

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM leave_requests WHERE employee_id = ?");
    $stmt->bind_param("s", $employee_id); // Assuming employee_id is a string
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any results were returned
    if ($result->num_rows == 0) {
        $message = "No leave requests found for Employee ID: $employee_id";
    }
} else {
    // Default query to show no results initially
    $result = null;
}
?>

<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 1400px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 12px; 
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #28a745;
            color: white;
        }
        button {
            padding: 6px 12px;
            cursor: pointer;
            margin: 2px;
        }
        .approve {
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
        }
        .reject {
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 4px;
        }
        .no-requests {
            text-align: center;
            color: #666;
        }
        a {
            text-decoration: none;
            margin-bottom: -20pt;
            padding: 3pt;
            color: white;
            background-color: black;
        }
        a:hover {
            color: red;
            background-color: green;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Leave Requests</h2>
        <form method="POST" action="">
            <label for="employee_id">Enter Your ID:</label>
            <input type="text" id="employee_id" name="employee_id" required>
            <button type="submit">Search</button>
        </form>

        <?php if ($message): ?>
            <p style="color: red; text-align: center;"><?php echo $message; ?></p>
        <?php endif; ?>

        <table>
            <tr>
                <th>Employee Name</th>
                <th>Employee ID</th>
                <th>Leave Type</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Reason</th>
                <th>Status</th>
            </tr>
            <?php
                          if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>{$row['employee_name']}</td>
                                    <td>{$row['employee_id']}</td>
                                    <td>{$row['leave_type']}</td>
                                    <td>{$row['start_date']}</td>
                                    <td>{$row['end_date']}</td>
                                    <td>{$row['reason']}</td>
                                    <td>{$row['status']}</td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7' class='no-requests'>No leave requests found for this Employee ID.</td></tr>";
                        }
                    ?>
                </table>
                <a href="apply_leave2.php">Back</a>
            </div>
        </body>
        </html>
        
        <?php
        // Close the database connection
        $conn->close();
        ?>