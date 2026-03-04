<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account Details</title>
    <link rel="icon" href="mau image.ico" type="image/x-icon"> 
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="icon" href="mau image.ico" type="image/x-icon"> 
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4; /* This remains unchanged */
            margin: 0;
            padding: 20px;
        }
        table {
            width: 80%; 
            max-width: 800px; 
            border-collapse: collapse;
            margin: 0 auto; 
            margin-bottom: 20px;
            background-color: white; /* Set only the table background color to white */
        }
        th, td {
            padding: 8px; 
            text-align: left;
            border: 1px solid #007BFF;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        .ah {
            margin-left: 300pt;
        }
        h1 {
            text-align: center;
            color: #343a40;
        }
        .status-button {
            background-color: #007BFF; 
            color: white;
            border: none;
            padding: 5px 10px; 
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 12px; 
            margin: 0 5px; 
        }
        .status-button.deactivate {
            background-color: red; 
        }
        .status-button.activate {
            background-color: green; 
        }
        .status-button:hover {
            background-color: #0056b3; 
        }
        
        th:nth-child(1), td:nth-child(1) { width: 25%; } 
        th:nth-child(2), td:nth-child(2) { width: 25%; } 
        th:nth-child(3), td:nth-child(3) { width: 25%; } 
        th:nth-child(4), td:nth-child(4) { width: 25%; } 
        th:nth-child(5), td:nth-child(5) { width: 25%; } 
        .action-buttons {
            display: flex; 
            align-items: center; 
        }
        .all {
            margin-top: -14pt;
            margin-left: -14pt;
            margin-right: -14pt;
        }
        h1{
            color:black;
        }
        .ah{
                margin-left:300pt;
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
    <script>
        function printUserDetails(username, password, role) {
            const printWindow = window.open('', '', 'height=400,width=600');
            printWindow.document.write('<html><head><title>User Details</title>');
            printWindow.document.write('<p style="font-weight:bold; color:green;">MaU HRMS Admin!</p>'); 
            printWindow.document.write('<style>body { font-family: Arial, sans-serif; }</style></head>');
            printWindow.document.write('<body><h1>User Account Details</h1>');
            printWindow.document.write('<p style="font-weight:bold; color:red;">Keep your information secretly!</p>');
            printWindow.document.write('<p><strong>Username:</strong> ' + username + '</p>');
            printWindow.document.write('<p><strong>Password:</strong> ' + password + '</p>');
            printWindow.document.write('<p><strong>Role:</strong> ' + role + '</p>');
           
            printWindow.document.write('</body></html>');
            printWindow.document.close(); 
            printWindow.print(); 
        }
    </script>
</head>
<body class="alladmin">
        
    <div class="all">
        <h3 class="ah">Welcome to admin page</h3>
        <img src="hrm.png" width="1365pt" height="110pt">
        <nav class="navbar navbar-expand-lg navbar-light bg-color:green ">
        </nav>
    </div>



<h1>User Account Details</h1>
<table>
    <tr>
        <th>Username</th>
        <th>Password</th>
        <th>Role</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <?php
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $database = "hrms";

    // Create connection
    $conn = mysqli_connect($servername, $db_username, $db_password, $database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if a status update request has been made
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['employee_id']) && isset($_POST['action'])) {
        $usernameToToggle = mysqli_real_escape_string($conn, $_POST['employee_id']);
        $action = $_POST['action'];
        
        // Determine new status based on action
        $newStatus = ($action === 'activate') ? 'active' : 'inactive';

        // Update status in database
        $sqlUpdate = "UPDATE users1 SET status='$newStatus' WHERE username='$usernameToToggle'";
        mysqli_query($conn, $sqlUpdate);
    }

    // Fetch users from the database
    $sql = "SELECT * FROM users1";
    $result = mysqli_query($conn, $sql);

    // Display users in the table
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['username']}</td>
                <td>{$row['password']}</td>
                <td>{$row['role']}</td>
                <td>{$row['status']}</td>
                <td>
                    <div class='action-buttons'>
                        <form method='POST' action='' style='display:inline; margin-right:5px;'>
                            <input type='hidden' name='employee_id' value='" . htmlspecialchars($row['username']) . "'>
                            " . ($row['status'] === 'active' ? "
                                <button type='submit' name='action' value='deactivate' class='status-button deactivate'>Deactivate</button>
                            " : "
                                <button type='submit' name='action' value='activate' class='status-button activate'>Activate</button>
                            ") . "
                        </form>
                        <button onclick=\"printUserDetails('" . htmlspecialchars($row['username']) . "', '" . htmlspecialchars($row['password']) . "', '" . htmlspecialchars($row['role']) . "')\" class='status-button'>Print</button>
                    </div>
                </td>
              </tr>";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</table>
<a href="admin.html">Back</a>
<script src="bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
</body>
</html>