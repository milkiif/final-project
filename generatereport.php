<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Employee Report</title>
    <nav class="navbar">
    </nav>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #edf2f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
            margin-top:11pt;
        }
        h2 {
            color: #2b2d42;
            margin-bottom: 30px;
        }
        .button {
            display: inline-block;
            padding: 15px 25px;
            margin: 10px;
            background-color: #3c9dd0;
            color: white;
            text-align: center;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.2s;
            font-weight: bold;
        }
        .button:hover {
            background-color: #2a8bb1;
            transform: scale(1.05);
        }
        .report-options {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }
        @media (max-width: 600px) {
            .button {
                width: 90%;
                margin: 10px 0;
            }
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #3c9dd0;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f0f8ff;
        }
        tr:hover {
            background-color: #d9d9d9;
        }
        .aa{
            margin-top:-14pt;
            background-color:green;
            margin-left:-6pt;
        }
    </style>
</head>
<body>
    <div class="aa">
<img src="hrm.png" width="1365px" height="110px" alt="HR Management Logo">
    </div>
<div class="container">
    <h2>Generate Employee Report</h2>
    <div class="report-options">
        <a class="button" href="?report_type=html">Generate HTML Report</a>
        <a class="button" href="?report_type=csv">Download CSV Report</a>
        <a class="button" href="hr manager.html">Back</a>
    </div>
</div>

</body>
</html>

<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "hrms"; 

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch active employees from the database
$activeEmployees = [];
$sql = "SELECT * FROM registration WHERE status = 'active'";
$result = mysqli_query($conn, $sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $activeEmployees[] = $row;
    }
}

$conn->close();

// Generate HTML Report
function generateHTMLReport($activeEmployees) {
    ob_start(); // Start output buffering
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Active Employees Report</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 20px;
                background-color: #edf2f4;
            }
            h2 {
                text-align: center;
                color: #2b2d42;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
                border-radius: 8px;
                overflow: hidden;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            }
            th, td {
                border: 1px solid #ddd;
                padding: 12px;
                text-align: left;
            }
            th {
                background-color: #3c9dd0;
                color: white;
            }
            tr:nth-child(even) {
                background-color: #f0f8ff;
            }
            tr:hover {
                background-color: #d9d9d9;
            }
        </style>
    </head>
    <body>
        <h2>Active Employees Report</h2>
        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Employee ID</th>
                    <th>Email</th>
                    <th>Phone No</th>
                    <th>Department</th>
                    <th>Education Level</th>
                    <th>Salary</th>
                    <th>Date of Joining</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($activeEmployees as $employee): ?>
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
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </body>
    </html>
<?php
    return ob_get_clean(); // Return the buffered content
}

// Generate CSV Report
function generateCSVReport($activeEmployees) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="active_employees_report.csv"');
    $output = fopen('php://output', 'w');
    
    // Output CSV header
    fputcsv($output, ['First Name', 'Middle Name', 'Last Name', 'Employee ID', 'Email', 'Phone No', 'Department', 'Education Level', 'Salary', 'Date of Joining']);
    
    // Output each row of the data
    foreach ($activeEmployees as $employee) {
        fputcsv($output, $employee);
    }
    
    fclose($output);
    exit();
}

// Check the type of report to be generated
if (isset($_GET['report_type'])) {
    if ($_GET['report_type'] === 'html') {
        // Generate HTML Report
        echo generateHTMLReport($activeEmployees);
    } elseif ($_GET['report_type'] === 'csv') {
        // Generate CSV Report
        generateCSVReport($activeEmployees);
    }
}
?>