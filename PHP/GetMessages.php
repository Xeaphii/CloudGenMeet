<?php
include 'deets.php';

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	 die("Connection failed: " . $conn->connect_error);
} 


if(isset($_GET['user_id']))
{
$user_id = $_GET['user_id'];
}else{
die("404");
}

$querry = "SELECT * FROM `tb_cloudgen_messages	` WHERE `user_id` =  = {$user_id} order by `date_time_message`";
$output="";
if ($result=mysqli_query($conn, $querry)) {
        if(mysqli_num_rows($result)==0){
		die("404");
	}
	 while($row = $result->fetch_assoc()) {
       $output= $output. "admin".":"; //0
		$output= $output. $row["message_body"].";";
		
    }
	echo rtrim($output,";");
} else {
	echo "Error: " . $querry . "<br>" . mysqli_error($conn);
}
$conn->close();
?>  