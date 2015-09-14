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

$sql = "Replace INTO `tb_cloudgen_user`( `first_name`, `last_name`, `phone_number`, `email_addr`, `company_name`, `designation`) VALUES ('".GET_PARAM("first_name","")."','".GET_PARAM("last_name","")."','".GET_PARAM("phone_no","")."','".GET_PARAM("email_id","")."','".GET_PARAM("company_name","")."','".GET_PARAM("designation","")."');";
if (mysqli_query($conn, $sql)) {
		echo '200';
} else {
	echo '400';
}

mysqli_close($conn);
?>