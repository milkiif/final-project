<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Request</title>
    <link rel="stylesheet" href="styles.css"> <!-- Add your CSS file here -->
    <link rel="icon" href="mau image.ico" type="image/x-icon"> 
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
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-top: 8pt;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #218838;
        }
        a {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            text-decoration: none;
            margin-left: 20pt;
            font-family: Arial, sans-serif;
        }
        a:hover {
            background-color: #218838;
        }
        .success-message {
            color: green;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body class="alladmin">
        
    <div class="all">
        <h3 class="ah">Welcome to employee page</h3>
        <img src="hrm.png" width="1350pt" height="110pt" style="margin-bottom: 20px;"> <!-- Added margin-bottom for spacing -->
    </div>

    <div class="container">
        <h2>Leave Request Form</h2>
        
        <?php
        $servername = "localhost"; 
        $username = "root"; 
        $password = ""; 
        $dbname = "hrms"; 

        // Create database connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Initialize a variable for success message
        $success_message = "";

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $employee_name = $_POST["employee_name"];
            $employee_id = $_POST["employee_id"];
            $leave_type = $_POST["leave_type"];
            $start_date = $_POST["start_date"];
            $end_date = $_POST["end_date"];
            $reason = $_POST["reason"];

            $stmt = $conn->prepare("INSERT INTO leave_requests (employee_name, employee_id, leave_type, start_date, end_date, reason) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $employee_name, $employee_id, $leave_type, $start_date, $end_date, $reason);
            if ($stmt->execute()) {
                $success_message = "Leave request submitted successfully.";
            } else {
                $success_message = "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        }

        // Close the connection
        $conn->close();
        ?>

        <!-- Display success message if it exists -->
        <?php if (!empty($success_message)): ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <label for="employee_name">Employee Name:</label>
            <input type="text" id="employee_name" name="employee_name" required>

            <label for="employee_id">Employee ID:</label>
            <input type="text" id="employee_id" name="employee_id" required>
            
            <label for="leave_type">Leave Type:</label>
            <select id="leave_type" name="leave_type" required>
                <option value="">Select Leave Type</option>
                <option value="sick">Sick Leave</option>
                <option value="annual">Annual Leave</option>
                <option value="vacation">Vacation Leave</option>
                <option value="maternity">Maternity Leave</option>
                <option value="parental">Parental Leave</option>
            </select>

            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" required>

            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" required>

            <label for="reason">Reason for Leave:</label>
            <textarea id="reason" name="reason" rows="4" required></textarea>

            <button type="submit">Submit Leave Request</button>
        </form>
        <a href="checkyourrequest.php">Check Your Request</a>
        <a href="employee.html">Back</a>
    </div>
</body>
</html>