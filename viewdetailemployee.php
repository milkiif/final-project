<?php 
$servername = "localhost"; // Your server name
$username = "root"; // Your database username
$password = ""; // Your database password
$database = "hrms"; // Your database name

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Update status if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['employee_id'])) {
    $employee_id = $_POST['employee_id'];
    
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        if ($action === 'deactivate') {
            $sql_update = "UPDATE registration SET status='deactive' WHERE employee_id=?";
        } else if ($action === 'activate') {
            $sql_update = "UPDATE registration SET status='active' WHERE employee_id=?";
        }
        
        $stmt = $conn->prepare($sql_update);
        $stmt->bind_param("s", $employee_id);
        
        if ($stmt->execute()) {
            //echo "<div class='message'>Status updated successfully!</div>";
        } else {
            echo "<div class='message' style='color: red;'>Error updating status: " . $conn->error . "</div>";
        }
        $stmt->close();
    }
}

// Handle the update request for specific employee details
if (isset($_POST['update_employee'])) {
    $employee_id = $_POST['update_employee'];
    $department = $_POST['department'];
    $education_level = $_POST['education_level'];
    $salary = $_POST['salary'];

    $sql_update_employee = "UPDATE registration SET department=?, education_level=?, salary=? WHERE employee_id=?";
    $stmt = $conn->prepare($sql_update_employee);
    $stmt->bind_param("ssis", $department, $education_level, $salary, $employee_id);
    
    if ($stmt->execute()) {
       // echo "<div class='message'>Employee details updated successfully!</div>";
    } else {
        echo "<div class='message' style='color: red;'>Error updating employee details: " . $conn->error . "</div>";
    }
    $stmt->close();
}

$sql = "SELECT * FROM registration";
$result = mysqli_query($conn, $sql);
$registration = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $registration[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Confirmation</title>
    <link rel="icon" href="mau image.ico" type="image/x-icon"> 
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: linear-gradient(to right,rgb(4, 91, 102),rgb(12, 108, 121)); /* Gradient background */
            background-attachment: fixed; /* Keep background fixed during scroll */
        }
        .message {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 20px;
            color: green; /* Change to red for error messages */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white; /* Set table background to white */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2; /* Light gray for header */
        }
        .back-button {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #007BFF; /* Blue */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .back-button:hover {
            background-color: #0056b3; /* Darker blue */
        }
        .status-button {
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .activate {
            background-color: green;
        }
        .activate:hover {
            background-color: darkgreen;
        }
        .deactivate {
            background-color: red;
        }
        .deactivate:hover {
            background-color: darkred;
        }
        .update-form {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .update-form h3 {
            margin-bottom: 15px;
        }
        .update-form label {
            display: block;
            margin: 10px 0 5px;
        }
        .update-form input[type="text"],
        .update-form input[type="number"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box; /* Ensures padding is included in the input width */
        }
        .update-form button {
            background-color: #007BFF;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        .update-form button:hover {
            background-color: #0056b3; /* Darker blue */
        }
        a {
            text-decoration: none;
            padding: 10pt;
            color: #007BFF; /* Blue link color */
        }
        a:hover {
            color: red;
            background-color: green;
        }
        .all {
            margin-top: -14pt;
            margin-left: -14pt;
            margin-right: -14pt;
        }
        h2 {
            color: white;
            margin-left: 400pt;
            margin-top: 10pt;
        }
        .ah {
            margin-left: 300pt;
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
<body>
    <div class="all">
        <h3 class="ah">Welcome to manager page</h3>
        <img src="hrm.png" width="1365pt" height="110pt">
    </div>

    <div class="schedule-list">
        <h2>Detail of Employees</h2>
        <?php if (!empty($registration)): ?>
            <table>
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Employee Id</th>
                        <th>Email</th>
                        <th>Phone No</th>
                        <th>Department</th>
                        <th>Education Level</th>
                        <th>Salary</th>
                        <th>Date of Joining</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($registration as $employee): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($employee['first_name']); ?></td>
                            <td><?php echo htmlspecialchars($employee['middle_name']); ?></td>
                            <td><?php echo htmlspecialchars($employee['last_name']); ?></td>
                            <td><?php echo htmlspecialchars($employee['employee_id']); ?></td>
                            <td><?php echo htmlspecialchars($employee['email']); ?></td>
                            <td><?php echo htmlspecialchars($employee['phone']); ?></td>
                            <td><?php echo htmlspecialchars($employee['department']); ?></td>
                            <td><?php echo htmlspecialchars($employee['education_level']); ?></td>
                            <td><?php echo htmlspecialchars($employee['salary']); ?></td>
                            <td><?php echo htmlspecialchars($employee['date_of_joining']); ?></td>
                            <td><?php echo htmlspecialchars($employee['status']); ?></td>
                            <td>
                                <form method="POST" action="">
                                    <input type="hidden" name="employee_id" value="<?php echo htmlspecialchars($employee['employee_id']); ?>">
                                    <?php if ($employee['status'] === 'active'): ?>
                                        <button type="submit" name="action" value="deactivate" class="status-button deactivate">Deactivate</button>
                                    <?php else: ?>
                                        <button type="submit" name="action" value="activate" class="status-button activate">Activate</button>
                                    <?php endif; ?>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No employees found.</p>
        <?php endif; ?>

        <!-- Form to update employee details -->
        <div class="update-form">
            <h3>Update Employee Details</h3>
            <form method="POST" action="">
                <label for="update_employee">Employee ID:</label>
                <input type="text" name="update_employee" required placeholder="Enter Employee ID">
                <label for="department">New Department:</label>
                <input type="text" name="department" required placeholder="Enter New Department">
                <label for="education_level">New Education Level:</label>
                <input type="text" name="education_level" required placeholder="Enter New Education Level">
                <label for="salary">New Salary:</label>
                <input type="number" name="salary" required placeholder="Enter New Salary">
                <button type="submit">Update</button>
            </form>
            <a href="hr manager.html">Back</a>
        </div>
    </div>

    <!-- Back Button -->
</body>
</html>