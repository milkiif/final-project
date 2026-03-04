<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "hrms";

$conn = mysqli_connect($servername, $username, $password, $database);
if($conn){
    

}
else {
    echo "not connected!";
}

if(isset($_POST['submit'])){
    $username = $_POST['username'];

    $sql = "delete from create_account where userid='$username'";

    $result = mysqli_query($conn, $sql);
    if($result){
        echo "user account is successfully deleted!";
    }
    else 
    {
        echo "account is not deleted!";
    }
}
?>