<?php

session_start();
  $current_user = $_SESSION['fullname'];
			
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
 $myusername = $_SESSION['username'];
 
 include 'db_config/connection.php';
 
$sql = "SELECT * FROM login where username='$myusername' or email='$myusername' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        $current_user_id = $row['username'];
    }
} else {
       header("../?login_err=You must be Administrator");
}
$conn->close();

} else {
    header("location:../?login_err=You must login first");
}
?>