<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css"> 


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 50px;
        }
        h2 {
            color: #007bff;
        }
        .btn-back {
            margin-top: 20px;
        }

        body {
            font-family: Arial, sans-serif; 
            background-color: #f4f4f4; 
            margin: 0;
            padding: 0;
        }

        a {
            padding: 5pt;
            text-decoration: none;
            color: white; 
        }

        a:hover {
            color: white;
            background-color: green;
        }

        .header {
            background-color: green;
            color: white;
            text-align: center;
            padding: 8px 0;
        }

        .content {
            margin: 20px; 
        }

        .vacancy {
            background-color: #ffcccb; 
            padding: 20pt; 
            border-radius: 20px; 
            margin-top: 20pt; 
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .vacancy h2 {
            color: #d5006d; 
            margin-top: 0; 
        }

        .footer {
            background-color: #333; 
            color: white; 
            text-align: center;
            padding: 20px; 
            position: relative; 
            margin-top: 20px; 
        }

        .footer a {
            color: white; 
            margin: 0 5px; /* Reduce margin for less space between buttons */
            padding: 10px 15px; /* Add padding to buttons for better click area */
            border-radius: 5px; /* Rounded corners for buttons */
            background-color: green; /* Button background color */
        }

        .footer a:hover {
            text-decoration: underline; /* Underline on hover for footer links */
        }

        .navbar-nav {
          
            margin-left: 170pt;
        }

        .navbar {
            background-color: green; 
        }

        .navbar-brand, .nav-link {
            color: white; 
        }

        .nav-link:hover {
            color: yellow; 
        }

        /* Responsive design */
        @media (max-width: 600px) {
            .content {
                margin: 10px; 
            }

            .vacancy {
                padding: 15pt; 
            }
        }

        .section h2 {
            margin-bottom: 20px; /* Space below headings */
            color: #007bff; /* Bootstrap primary color */
        }

        .footer {
            background-color: #333; /* Dark background for the footer */
            color: white; /* White text for contrast */
            text-align: center; /* Center text */
            padding: 20px; /* Padding for footer */
            position: relative; /* Positioning for potential future enhancements */
        }

        .footer a {
            color: white; /* White text for footer links */
            margin: 0 10px; /* Spacing between footer links */
        }

        .footer a:hover {
            text-decoration: underline; /* Underline on hover for footer links */
        }

        .social-icons img {
            width: 30px; /* Set width for social media icons */
            margin: 0 10px; /* Spacing between icons */
        }

        /* Responsive design */
        @media (max-width: 600px) {
            .section {
                padding: 20px; /* Reduce padding on smaller screens */
            }
        }
        .milk {
            margin-left: 130%; 
        }
    </style>
    <title>File Upload and Download</title>
    <link rel="icon" href="mau image.ico" type="image/x-icon"> 
</head>
<body>

<img src="hrm.png" width="1348pt" height="110pt" alt="Header Image">
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">HRMS of MaU</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="homepage.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="aboutDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        About
                    </a>
                    <div class="dropdown-menu" aria-labelledby="aboutDropdown">
                        <a class="dropdown-item" href="background.html">Background</a>
                        <a class="dropdown-item" href="mission and vision.html">Mission and Vision</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="newspageboard.html">News</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="developer.html">Developers</a>
                </li>
                <div class="milk">
                    <li class="nav-item">
                        <a class="nav-link" href="homepage.php">Login</a>
                    </li>
                </div>
            </ul>
        </div>
    </nav>
    
    <div class="container mt-5">
        <h2>Upload Your File</h2>
        
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="file" class="form-label">Select File</label>
                <input type="file" class="form-control" name="file" id="file" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload File</button>
        </form>
        
        <a href="javascript:history.back()" class="btn btn-secondary btn-back">Back</a>
    </div>

    <footer class="footer">
   
   <div class="social-icons">
      <img src="facebook-new.png" alt="Facebook"></a>
       <img src="download.png" alt="Twitter"></a>
       <img src="download (1).png" alt="Instagram"></a>
    <br><br><br>
   </div>
   <p>&copy; 2025 HRMS of Mattu University.</p>
</footer>

</body>
</html>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was uploaded without errors
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $target_dir = "uploads/"; // Change this to the desired directory for uploaded files
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is allowed (you can modify this to allow specific file types)
        $allowed_types = array("jpg", "jpeg", "png", "gif", "pdf");
        if (!in_array($file_type, $allowed_types)) {
            echo "Sorry, only JPG, JPEG, PNG, GIF, and PDF files are allowed.";
        } else {
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                // File upload success, now store information in the database
                $filename = $_FILES["file"]["name"];
                $filesize = $_FILES["file"]["size"];
                $filetype = $_FILES["file"]["type"];

                // Database connection
                $db_host = "localhost";
                $db_user = "root";
                $db_pass = "";
                $db_name = "hrms";

                $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Insert the file information into the database
                $sql = "INSERT INTO files (filename, filesize, filetype) VALUES ('$filename', $filesize, '$filetype')";

                if ($conn->query($sql) === TRUE) {
                    echo "The file " . basename($_FILES["file"]["name"]) . " has been uploaded and your information has been stored in the database.";
                } else {
                    echo "Sorry, there was an error uploading your file and storing information in the database: " . $conn->error;
                }

                $conn->close();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "No file was uploaded.";
    }
}
?>

