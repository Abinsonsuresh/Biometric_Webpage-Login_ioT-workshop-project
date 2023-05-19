<?php
session_start();
$servername = "localhost";
$username = "root";
$password = " ";
$dbname = "biometric";


        
$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT rfid,stats FROM rf_info WHERE stats='1'" ;
$result = $conn->query($sql);
$sql="UPDATE rf_info set stats=0 where id=1";
mysqli_query($conn,$sql); 

 
if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) 
    {
        echo "RFID: " . $row["rfid"] . "<br>";
        
        
       
        if ($row["rfid"] == '5' && $row["stats"] == '1') {
        
            session_start();
            
            // $_SESSION["srfid"] = $row["rfid"];
            header("Location: WEB/login.html");
            exit();
        }
    }
        
    
        
} else {
    echo "0 results";
}



header("refresh:2");
$conn->close();
?>