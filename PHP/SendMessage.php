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

$sql = "INSERT INTO `tb_cloudgen_messages`(`user_id`, `from`, `message_body`, `date_time_message`) VALUES ('0','".GET_PARAM("user_id","")."','".GET_PARAM("message_body","")."',now());";
if (mysqli_query($conn, $sql)) {
		echo '200';
} else {
	echo '400';
}

mysqli_close($conn);
?>