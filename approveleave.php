<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "hrms"; 


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle approval or rejection
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['leave_id'], $_POST['action'])) {
    $leave_id = $_POST['leave_id'];
    $action = $_POST['action'];
    
    // Determine SQL update based on action
    if ($action === 'approve') {
        $sql = "UPDATE leave_requests SET status='Approved' WHERE id=?";
    } else if ($action === 'reject') {
        $sql = "UPDATE leave_requests SET status='Rejected' WHERE id=?";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $leave_id);
    $stmt->execute();
    $stmt->close();
}

// Fetch leave requests
$sql = "SELECT id, employee_name, employee_id, leave_type, start_date, end_date, reason, status FROM leave_requests";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Requests Management</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Leave Requests Management</h2>
        <table>
            <thead>
                <tr>
                    <th>Employee Name</th>
                    <th>Employee ID</th>
                    <th>Leave Type</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['employee_name']}</td>
                            <td>{$row['employee_id']}</td>
                            <td>{$row['leave_type']}</td>
                            <td>{$row['start_date']}</td>
                            <td>{$row['end_date']}</td>
                            <td>{$row['reason']}</td>
                            <td>{$row['status']}</td>
                            <td>
                                <form method='POST' style='display:inline;' onsubmit='return confirm(\"Are you sure you want to approve this leave request?\")'>
                                    <input type='hidden' name='leave_id' value='{$row['id']}'>
                                    <input type='hidden' name='action' value='approve'>
                                    <button class='approve' type='submit'>Approve</button>
                                </form>
                                <form method='POST' style='display:inline;' onsubmit='return confirm(\"Are you sure you want to reject this leave request?\")'>
                                    <input type='hidden' name='leave_id' value='{$row['id']}'>
                                    <input type='hidden' name='action' value='reject'>
                                    <button class='reject' type='submit'>Reject</button>
                                </form>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr>
                        <td colspan='8' class='no-requests'>No leave requests to display.</td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close(); // Close the database connection
?>