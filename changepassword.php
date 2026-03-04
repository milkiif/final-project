<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "hrms";

$conn = mysqli_connect($servername, $username, $password, $database);
if($conn){
    echo "connected successfully!";

}
else {
    echo "not connected!";
}

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    $sql = "update users1 set password = '$password2' where password = '$password1'";

    $result = mysqli_query($conn, $sql);
    if($result){
        echo "account is successfully changed!";
    }
    else 
    {
        echo "account is not changed!";
    }
}
?>
