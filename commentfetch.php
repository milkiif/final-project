<?php 
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

$sql = "SELECT * FROM comment ORDER BY send_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<h2> From: " . $row["name"] . "</h2>";
        echo "<p> ID: " . $row["id"] . "</p>";
        echo "<p>" . $row["comment"] . "</p>";
        echo "<p><em>send on: " . $row["send_at"] . "</em></p>";
        echo "<hr>";
    }
} else {
    echo "No comments found.";
    
}

// Close connection
$conn->close();
?>