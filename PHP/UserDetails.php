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

$querry = "SELECT * FROM `tb_cloudgen_user` WHERE `user_id` =  = {$user_id}";

if ($result=mysqli_query($conn, $querry)) {
        if(mysqli_num_rows($result)==0){
		die("404");
	}
	 while($row = $result->fetch_assoc()) {
        echo $row["first_name"].":::"; //0
		echo $row["last_name"].":::";//1
		echo $row["phone_number"].":::";//2
		echo $row["email_addr"].":::";//3
		echo $row["company_name"].":::";//4
		echo $row["designation"];//5
		
    }
} else {
	echo "Error: " . $querry . "<br>" . mysqli_error($conn);
}
$conn->close();
?>  