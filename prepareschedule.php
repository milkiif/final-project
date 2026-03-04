<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prepare Schedule</title>
    <link rel="icon" href="mau image.ico" type="image/x-icon"> 
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
        <style>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            background-color: #4CAF50; /* Green */
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 0 auto; /* Center the form */
            max-width: 400px; /* Set a maximum width for the form */
        }
        b {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"], input[type="time"] {
            width: 100%; /* Make input fields take full width of the form */
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus, input[type="time"]:focus {
            border-color: #4CAF50; /* Green */
            outline: none;
        }
        input[type="submit"], input[type="reset"] {
            background-color: #4CAF50; /* Green */
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
            min-width: 80px;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover, input[type="reset"]:hover {
            background-color: #45a049; /* Darker green */
        }
        .button-container {
            display: flex;
            justify-content: flex-start; /* Align buttons to the left */
            margin-top: 10px;
        }
        .schedule {
            margin-left: 10pt;
        }
        .all {
            margin-top: -14pt;
            margin-left: -14pt;
            margin-right: -14pt;
        }
        .form{
            margin-top:10pt;
            margin-left:-500pt;
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
</head>
<body class="alladmin">
        
    <div class="all">
        <h3 class="ah">Welcome to manager page</h3>
    <img src="hrm.png" width="1350pt" height="110pt">
    <nav class="navbar navbar-expand-lg navbar-light bg-color:green ">
    </div>
   
<div class="form">

<form action="prepareschedule.php" method="POST">
    <b>Employee Role:</b>
    <input type="text" name="employeerole" required>
    
    <b>Day of Work:</b>
    <input type="text" name="dayofwork" required>
    
    <b>Day of No Work:</b>
    <input type="text" name="dayofnowork" required>
    
    <b>Start Time:</b>
    <input type="time" name="sttart" required>
    
    <b>Break Time:</b>
    <input type="time" name="breeak" required>
    
    <b>End Time:</b>
    <input type="time" name="ennd" required>
    
    <div class="button-container">
        <input type="submit" name="submit" value="Send">
        <input type="submit" name="update" value="Modify"><br><br>
        </div>
        <a href="hr manager.html">Back</a>
      
</form>
    </div>
</body>
</html>

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

// Initialize a message variable
$message = "";

// Initialize an array to hold schedules
$schedules = [];

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get the form data
    $emprole = $_POST['employeerole'];
    $dyw = $_POST['dayofwork'];
    $dnwo = $_POST['dayofnowork'];
    $start = $_POST['sttart'];
    $break = $_POST['breeak'];
    $end = $_POST['ennd'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO schedule111 (employeerole, dayofwork, dayofnowork, start_time, break_time, end_time) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $emprole, $dyw, $dnwo, $start, $break, $end);

    // Execute the statement
    if ($stmt->execute()) {
        $message = "Successfully scheduled!";
    } else {
        $message = "Error: " . $stmt->error; // Display the error
    }
    $stmt->close();
}

if(isset($_POST['update'])){
    $emprole = $_POST['employeerole'];
    $dyw = $_POST['dayofwork'];
    $dnwo = $_POST['dayofnowork'];
    $start = $_POST['sttart'];
    $break = $_POST['breeak'];
    $end = $_POST['ennd'];

    $sql = "UPDATE schedule111 SET dayofwork = '$dyw', dayofnowork = '$dnwo', start_time = '$start', break_time = '$break', end_time = '$end' WHERE employeerole = '$emprole'";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        // Optionally, you can set a success message here
        $message = "Schedule successfully updated!";
    } else {
        echo "Error updating schedule: " . mysqli_error($conn);
    }
}

// Fetch all schedules from the database
$sql = "SELECT * FROM schedule111";
$result = mysqli_query($conn, $sql);
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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4; /* Optional: Set a light background for the body */
        }
        .message {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 20px;
            color: green; /* Change to red for error messages */
        }
        a {
            text-decoration: none;
            padding: 5pt;
        }
        a:hover {
            background-color: green;
            color: red;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white; /* Set table background to white */
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2; /* Light gray for header */
        }
        h2{
            color:green;
            margin-left:150pt;
            margin-top:15pt;
        }
    </style>
</head>
<body>

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

</body>
</html>