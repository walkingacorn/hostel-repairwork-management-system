<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hostel_repair_system";

try{

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }

// Close connection
// echo "Connected successfully";

//mysqli_close($conn);

}catch(mysqli_sql_exception){
    echo "Could not get connected.";
}

// if($conn){
//     echo "You have connected successfully";
// }


?>