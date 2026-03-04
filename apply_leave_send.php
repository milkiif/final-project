<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "hrmss";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$stmt = $conn->prepare("INSERT INTO leave_applications (employee_name, leave_type, start_date, end_date) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $employee_name, $leave_type, $start_date, $end_date);


$employee_name = $_POST['employee_name'];
$leave_type = $_POST['leave_type'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

if ($stmt->execute()) {
    echo "Leave application submitted successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>