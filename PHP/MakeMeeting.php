<?php
include 'deets.php';

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	 die("Connection failed: " . $conn->connect_error);
} 

function GET_PARAM($key, $default = "") {
    if(isset($_GET[$key])){
        return $_GET[$key];
    }else{
        return $default;
    }
}
$userName="";
$sql = "SELECT CONCAT(`first_name`, '  ', `last_name`) as name FROM tb_cloudgen_user where `user_id` = ".GET_PARAM("user_id","");
	if ($result = mysqli_query($conn, $sql)) {
		$row = $result->fetch_assoc();
		$userName = $row["name"];
	}

$sql = "INSERT INTO `tb_cloudgen_meeting`(`topic`, `user_id`, `date`, `time`) VALUES ('".GET_PARAM("topic","")."','".GET_PARAM("user_id","")."',CURDATE(),CURTIME());";
if (mysqli_query($conn, $sql)) {
	
	$sql = "INSERT INTO `tb_cloudgen_messages`(`user_id`, `from`, `message_body`, `date_time_message`) VALUES ('admin','".GET_PARAM("user_id","")."','Appointment from ".$userName." for topic".GET_PARAM("topic","")." at ".date("Y-m-d H:i:s")."',now());";
		if (mysqli_query($conn, $sql)) {
			
			$msg = "Appointment from ".$userName." for topic".GET_PARAM("topic","")." at ".date("Y-m-d H:i:s");

			// use wordwrap() if lines are longer than 70 characters
			$msg = wordwrap($msg,70);

			// send email
			mail("muhammadzeeshan020@gmail.com","New appintment",$msg);
		}
		echo '200';
} else {
	echo '400';
}

mysqli_close($conn);
?>