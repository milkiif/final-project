<?php
// Database connection details
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "hrms";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the uploaded files from the database
$sql = "SELECT * FROM files";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Uploaded Files</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="icon" href="mau image.ico" type="image/x-icon"> 
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
        
    <style>
         .ah{
                margin-left:300pt;
            }
        body {
            background-color:gray;
        }
        .container {
            margin-top: 30px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .back-button {
            margin-top: 20px;
            text-align: center;
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
    <img src="hrm.png" width="1365pt" height="110pt">
    <nav class="navbar navbar-expand-lg navbar-light bg-color:green ">
    </div>

    <div class="container">
        <h2>Uploaded Files</h2>
        <p>This file is uploaded from the applicant. If you need to see, download it.</p>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>File Name</th>
                    <th>File Size</th>
                    <th>File Type</th>
                    <th>Uploaded Date</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Display the uploaded files and download links
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $file_path = "uploads/" . $row['filename'];
                        ?>
                        <tr>
                            <td><?php echo $row['filename']; ?></td>
                            <td><?php echo $row['filesize']; ?> bytes</td>
                            <td><?php echo $row['filetype']; ?></td>
                            <td><?php echo $row['upload_date']; ?></td>
                            <td><a href="<?php echo $file_path; ?>" class="btn btn-primary" download>Download</a></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="5" class="text-center">No files uploaded yet.</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <a href="hr manager.html">Back</a>
    </div>
    <script src="bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>