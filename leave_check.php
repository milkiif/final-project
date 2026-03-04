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
?>

<?php
$sql = "SELECT * FROM leave_requests ";
$result = $conn->query($sql);
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
            max-width: 14000px;
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
            width: 103%;
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
        a{
            text-decoration:none;
            margin-bottom:-20pt;
            padding:3pt;
            color:white;
            background-color:black;
        }
        a:hover{
            color:red;
            background-color:green;
        }
        </style>
</head>
    <body>
        
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
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                   <td>{$row['employee_name']}</td>
                                <td>{$row['employee_id']}</td>
                                <td>{$row['leave_type']}</td>
                                <td>{$row['start_date']}</td>
                                <td>{$row['end_date']}</td>
                                <td>{$row['reason']}</td>
                                <td>{$row['status']}</td>
                    <td>
                    </td>
                </tr>";
            }
        } else {
            
        }
        ?>

    </table>
    <a href="leave_manage.php">back</a>

    </body>
    </html>