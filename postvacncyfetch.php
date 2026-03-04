<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$database = "hrms";

$conn = mysqli_connect($servername, $username, $password, $database);
if($conn){
   // echo "connected successfully!";

}
else {
    echo "not connected!";
}

$sql = "SELECT * FROM post ORDER BY posted_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<h2 style='color:green;'>  " . $row["title"] . "</h2>";
        echo "<b>Department: </b>" . htmlspecialchars($row['department']);
        echo "<p>" . $row["description"] . "</p>";
        echo "<p><em>posted on: " . $row["posted_at"] . "</em></p>";
        echo "<hr>";
    }
} else {
    echo "No vacances found.";
}

// Close connection
$conn->close();
?>