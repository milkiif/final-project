<?php 
$servername = "localhost"; // Your server name
$username = "root"; // Your database username
$password = ""; // Your database password
$database = "hrms"; // Your database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch all schedules from the database
$sql = "SELECT * FROM schedule111";
$result = mysqli_query($conn, $sql);
$schedules = []; // Initialize the schedules array
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $schedules[] = $row; // Store each schedule in the array
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Confirmation</title>
    <link rel="icon" href="mau image.ico" type="image/x-icon"> 
    <link rel="icon" href="mau image.ico" type="image/x-icon"> 
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .message {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 20px;
            color: green; /* Change to red for error messages */
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .back-button {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .back-button:hover {
            background-color: #0056b3;
        }

        .all {
            margin-top: -14pt;
            margin-left: -14pt;
            margin-right: -14pt;
        }
        .ah{
                margin-left:300pt;
            }
    </style>
</head>
<body>
        
    <div class="all">
        <h3 class="ah">Welcome to employee page</h3>
        <img src="hrm.png" width="1360pt" height="110pt" style="margin-bottom: 20px;"> <!-- Added margin-bottom for spacing -->
    </div>


<div class="schedule-list">
    <h2>Detail Schedules</h2>
    <?php if (!empty($schedules)): ?>
        <table>
            <thead>
                <tr>
                    <th>Employee Role</th>
                    <th>Day of Work</th>
                    <th>Day of No Work</th>
                    <th>Start Time</th>
                    <th>Break Time</th>
                    <th>End Time</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($schedules as $schedule): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($schedule['employeerole']); ?></td>
                        <td><?php echo htmlspecialchars($schedule['dayofwork']); ?></td>
                        <td><?php echo htmlspecialchars($schedule['dayofnowork']); ?></td>
                        <td><?php echo htmlspecialchars($schedule['start_time']); ?></td>
                        <td><?php echo htmlspecialchars($schedule['break_time']); ?></td>
                        <td><?php echo htmlspecialchars($schedule['end_time']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No schedules found.</p>
    <?php endif; ?>
</div>

<!-- Back Button -->
<button class="back-button" onclick="window.history.back();">Back</button>

</body>
</html>