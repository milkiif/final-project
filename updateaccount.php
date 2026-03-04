<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "hrms";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize message variable
$message = '';

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Update query
    $sql = "UPDATE users1 SET password = '$password' WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    // Check if the update was successful
    if ($result) {
        $message = "Account is successfully updated!";
    } else {
        $message = "Account is not updated!";
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User Account</title>
    <link rel="icon" href="mau image.ico" type="image/x-icon"> 
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 400px; /* Set a maximum width for the form */
            margin-left:79pt;
            margin-top:10pt; /* Center the form */
            background-color: white; /* White background for the form */
            padding: 20px; /* Padding inside the form */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }
        h2 {
            text-align: center;
            color: #343a40; /* Dark color for the heading */
        }
        label {
            display: block; /* Make labels block elements */
            margin: 10px 0 5px; /* Spacing around labels */
            color: #555; /* Slightly lighter color for labels */
        }
        input[type="text"] {
            width: 100%; /* Full width for input fields */
            padding: 10px; /* Padding inside input fields */
            border: 1px solid #007BFF; /* Border color */
            border-radius: 4px; /* Rounded corners for input fields */
            box-sizing: border-box; /* Include padding in width */
        }
        .button-container {
            display: flex; /* Use flexbox for button alignment */
            justify-content: space-between; /* Space between buttons */
            margin-top: 15px; /* Spacing above the button container */
        }
        input[type="submit"], input[type="reset"] {
            background-color: #007BFF; /* Blue background for buttons */
            color: white; /* White text for buttons */
            border: none; /* No border */
            padding: 10px; /* Padding inside buttons */
            border-radius: 4px; /* Rounded corners for buttons */
            cursor: pointer; /* Pointer cursor on hover */
            width: 48%; /* Width for buttons */
        }
        input[type="submit"]:hover, input[type="reset"]:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
        .message {
            background-color: #d4edda; /* Light green background for success message */
            color: #155724; /* Dark green text */
            padding: 10px; /* Padding for the message */
            border: 1px solid #c3e6cb; /* Border color */
            border-radius: 4px; /* Rounded corners for the message */
            margin-bottom: 15px; /* Spacing below the message */
        }
        .ww {
            text-align: center; /* Center the back link */
            margin-top: 20px; /* Spacing above the back link */
        }
        a {
            text-decoration: none;
            color: brown; /* Color for the back link */
        }
        a:hover {
            color: red; /* Color on hover */
            
        }

        .ah{
                margin-left: 300pt;
            }
            .all{
                background-color:green;
                margin-top:-14pt;
                margin-left:-14pt;
                margin-right: -14pt;
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
        <h3 class="ah">Welcome to admin page</h3>
        <img src="hrm.png" width="1365pt" height="110pt">
        <nav class="navbar navbar-expand-lg navbar-light bg-color:green ">
        </nav>
    </div>






<div class="container">
    <form action="" method="POST">
    <h2><b>Update User Account</b></h2>

<!-- Display the update message if it exists -->
<?php if ($message): ?>
    <div class="message"><?php echo $message; ?></div>
<?php endif; ?>

<label for="username">Username:</label>
<input type="text" id="username" name="username" maxlength="16" required>

<label for="password">Password:</label>
<input type="text" id="password" name="password" maxlength="8" required>

<div class="button-container">
    <input type="submit" name="submit" value="Update">
    <input type="reset" name="cancel" value="Cancel">
</div>

<a href="admin.html">Back</a>
</form>
</div>


<script src="bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
</body>
</html>