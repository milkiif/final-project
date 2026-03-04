<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "hrms";

$conn = mysqli_connect($servername, $username, $password, $database);
if($conn){
    //echo "connected successfully!";
} else {
    echo "not connected!";
}

if(isset($_POST['submit'])){
    $job_id = $_POST['id'];
    $title = $_POST['title'];
    $dept = $_POST['dep'];
    $desc = $_POST['desc'];

    $sql = "insert into post(id, title, department, description) values('$job_id', '$title', '$dept', '$desc')";
    $result = mysqli_query($conn, $sql);
    if($result){
       // echo "posted successfully!";
    } else {
       // echo "account is not created!";
    }
}

if(isset($_POST['delete'])){
    $username = $_POST['title'];
    $sql = "delete from post where title ='$username'";
    $result = mysqli_query($conn, $sql);
    if($result){
      //  echo "user account is successfully deleted!";
    } else {
       // echo "account is not deleted!";
    }
}

if(isset($_POST['edit'])){
    $title = $_POST['title'];
    $dep = $_POST['dep'];
    $descrip = $_POST['desc'];

    $sql = "update post set department = '$dep', description = '$descrip' where title = '$title'";
    $result = mysqli_query($conn, $sql);
    if($result){
        //echo "account is successfully changed!";
    } else {
        //echo "account is not changed!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Vacancy</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" href="mau image.ico" type="image/x-icon"> 
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <style>
        .all {
            margin-top: -14pt;
            margin-left: -14pt;
            margin-right: -14pt;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-left:70pt;
            margin-top:8pt;
        }
        h4 {
            text-align: center;
            color: white;
            background-color: black;
            padding: 10px;
            border-radius: 5px;
        }
        form {
            margin: 20px 0;
        }
        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"], textarea {
            width: calc(100% - 22px); /* Adjust width to account for padding and border */
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        /* Button styles */
        .button-container {
            display: flex;
            justify-content: space-between; /* Space buttons evenly */
            margin-top: 10px; /* Add some space above the buttons */
        }
        input[type="submit"], input[type="reset"] {
            background-color: green;
            color: white;
            border: none;
            padding: 5px 10px; /* Reduced padding for smaller buttons */
            border-radius: 5px;
            cursor: pointer;
            flex: 1; /* Allow buttons to grow equally */
            margin: 0 5px; /* Add some space between buttons */
            min-width: 80px; /* Set a minimum width for buttons */
        }
        input[type="submit"]:hover, input[type="reset"]:hover {
            background-color: darkgreen;
        }
        .vacancy-list {
            margin-top: 20px;
        }
        .vacancy-item {
            background: #e9ecef;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
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
        .ah {
            margin-left: 300pt;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function fetchvacancy() {
            $.ajax({
                url: 'postvacncyfetch.php', // PHP script to fetch messages
                method: 'GET',
                success: function(data) {
                    $('#vacancy').html(data); // Update the messages div with the fetched data
                }
            });
        }

        // Fetch messages every 5 seconds
        setInterval(fetchvacancy, 5000);

        // Fetch messages on page load
        $(document).ready(function() {
            fetchvacancy();
        });
    </script>
</head>
<body class="alladmin">
        
    <div class="all">
        <h3 class="ah">Welcome to manager page</h3>
    <img src="hrm.png" width="1365pt" height="110pt">
    <nav class="navbar navbar-expand-lg navbar-light bg-color:green ">
    </div>
<div class="container">
    <h4>WELCOME TO POST VACANCIES PAGE!!</h4>
    <form action="" method="POST">
        <label for="id">Job ID:</label>
        <input type="text" name="id" placeholder="Please enter job ID!">
        
        <label for="title">Job Title:</label>
        <input type="text" name="title" placeholder="Please enter title of your job!" required>
        
        <label for="dep">Department:</label>
        <input type="text" name="dep" placeholder="Please enter department!">
        
        <label for="desc">Job Description:</label>
        <textarea name="desc" rows="5" placeholder="Please enter job description..."></textarea>
        
        <div class="button-container">
            <input type="submit" name="submit" value="POST">
            <input type="submit" name="delete" value="DELETE">
            <input type="submit" name="edit" value="EDIT">
            <input type="reset" name="cancel" value="CANCEL">
        </div>
    </form>
    
    <h2>Available Vacancies</h2>
    <div id="vacancy" class="vacancy-list">
        <!-- Messages will be displayed here -->
    </div>
    <a href="hr manager.html">Back</a>
    
</div>

<script src="bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
</body>
</html>