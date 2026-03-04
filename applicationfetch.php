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

$sql = "SELECT * FROM uploaded_files ORDER BY uploaded_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<h2>  " . $row["file_name"] . "</h2>";
       // echo "<p> " . $row["file_content"] . "</p>";
        echo "<p><em>uploaded on: " . $row["uploaded_at"] . "</em></p>";
        echo "<hr>";
    }
} else {
    echo "No vacances found.";
}

// Close connection
$conn->close();
?>