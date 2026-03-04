<?php

$host = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "hrms"; 

$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $name = htmlspecialchars($_POST['name']);
    $id = htmlspecialchars($_POST['id']);
    $comment = htmlspecialchars($_POST['comment']);


    if (empty($name) || empty($id) || empty($comment)) {
        $error_message = "All fields are required. Please fill out the form completely.";
    } else {
    
        $sql = "INSERT INTO comment (name, id, comment) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        $stmt->bind_param("sis", $name, $id, $comment);

        if ($stmt->execute()) {
            $success_message = "Thank you, $name! Your comment has been successfully submitted.";
        } else {
            $error_message = "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .message-container {
            background-color: #ffffff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
        }

        .back-link {
            display: block;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        .back-link:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="message-container">
        <?php
        // Display success or error message
        if (isset($success_message)) {
            echo "<p class='success'>$success_message</p>";
        } elseif (isset($error_message)) {
            echo "<p class='error'>$error_message</p>";
        } else {
            echo "<p class='error'>Invalid request. Please submit the form.</p>";
        }
        ?>
        <a href="comment.html" class="back-link">Back to Comment Page</a>
    </div>
</body>
</html>