<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Leave Requests</title>
  
    <link rel="icon" href="mau image.ico" type="image/x-icon"> 
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
        <style>
             .all {
            margin-top: -14pt;
            margin-left: -14pt;
            margin-right: -14pt;
        }
            .ah{
                margin-left:300pt;
            }/* Add your styles here */
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
            margin-top:20pt;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        button {
            
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .approve {
            background-color: #28a745;
            color: white;
        }
        .reject {
            background-color: #dc3545;
            color: white;
        }
        .message {
            margin: 20px 0;
            padding: 10px;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
        a{
            text-decoration:none;
            margin-top:-20pt;
            padding:2pt;
            color:white;
            background-color:black;
        }
        a:hover{
            color:red;
            background-color:green;
        }
       
    </style>
</head>
<body class="alladmin">
        
    <div class="all">
        <h3 class="ah">Welcome to manager page</h3>
    <img src="hrm.png" width="1365pt" height="110pt">
    <nav class="navbar navbar-expand-lg navbar-light bg-color:green ">
    </div>




    <div class="container">
        
        <h2>Leave Requests</h2>
        
        <?php
     
        $servername = "localhost"; 
        $username = "root";
        $password = ""; 
        $dbname = "hrms"; 

       
        $conn = new mysqli($servername, $username, $password, $dbname);

       
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

       
        $message = '';

       
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $request_id = $_POST["request_id"];
            $action = $_POST["action"];

            if ($action == 'approve') {
                $update_sql = "UPDATE leave_requests SET status = 'approved' WHERE id = ?";
                $message = "Leave request approved successfully.";
            } else if ($action == 'reject') {
                $update_sql = "UPDATE leave_requests SET status = 'rejected' WHERE id = ?";
                $message = "Leave request rejected successfully.";
            }

            // Prepare and bind
            $stmt = $conn->prepare($update_sql);
            $stmt->bind_param("i", $request_id);

            // Execute the statement
            if ($stmt->execute()) {
                // Success message
                $message = "<div class='message success'>$message</div>";
            } else {
                // Error message
                $message = "<div class='message error'>Error: " . $stmt->error . "</div>";
            }

            // Close the statement
            $stmt->close();
        }
        ?>

        <!-- Display message -->
        <?php if (!empty($message)) echo $message; ?>

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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch leave requests
                $sql = "SELECT * FROM leave_requests WHERE status = 'pending'";
                $result = $conn->query($sql);

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
                                    <form action='' method='POST' style='display:inline;'>
                                        <input type='hidden' name='request_id' value='{$row['id']}'>
                                        <button type='submit' name='action' value='approve' class='approve'>Approve</button>
                                    </form>
                                    <form action='' method='POST' style='display:inline;'>
                                        <input type='hidden' name='request_id' value='{$row['id']}'>
                                        <button type='submit' name='action' value='reject' class='reject'>Reject</button>
                                    </form>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No pending leave requests.</td></tr>";
                }

               
                // Close the connection
                $conn->close();
                ?>
                
            </tbody>

        </table>
     
        <a href="hr manager.html">Back</a>
        <a href="leave_check.php">Leave History</a>
    </div>
 
    <script src="bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>     
</body>
</html>