<?php
  require_once 'beans.php';
//Ket noi co so du lieu
function connectMySql(){
	$conn= null;
	$servername =
	"localhost:3306";
	// "mysql.hostinger.vn";
	$database=
	"cn_web";
	// "u324139567_cnweb";
	$username = 
	// "u324139567_root";
	"root";
	$password =
	"";
	// "hanh_chu";
	// "huuhung_luyt";
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	            {
		// echo "<script>console.log('[ERROR]\t" . $e->getMessage()."')</script>";
	}finally{
		return $conn;
	}
}


//Tao ta bang du lieu
function getData($sqlStr){
	$conn= null;
	$stmt= null;
	try {
		$conn = connectMySql();
		$stmt = $conn->prepare($sqlStr);
		$obj= new Object();
		// set the resulting array to associative
		$stmt->setFetchMode(PDO::FETCH_INTO, $obj);
		$stmt->execute();
	}
	catch(PDOException $e) {
		//  echo "<script>console.log('[ERROR]\t" . $e->getMessage()."')</script>";
	}finally{
		$conn= null;
		return $stmt;
	}
}


//Update
function executeStatement($sqlStr){
	$conn= null;
	$count= 0;
	try{
		$conn= connectMySql();
		$stmt= $conn->prepare($sqlStr);
		$stmt->execute();
		$count= $stmt->rowCount();
	}catch(PDOException $e){
		// echo "<script>console.log('[ERROR]\t" . $e->getMessage()."')</script>";
	}finally{
		$conn= null;
		return $count;
	}
}

function adminLogin($username, $password){
	$data= getData("select * from admin where username='$username' and password='$password'");
	$customer= null;
	foreach($data as $obj){
		$customer= $obj;
	}
	return $customer;
}

function loginUser($username, $password){
	$data= getData("select * from user_acc where username='$username' and password='$password'");
	$customer= null;
	foreach($data as $obj){
		$customer= $obj;
	}
	return $customer;
}

function usernameIsExist($id, $username){
	return executeStatement("select * from user_acc where username='$username' and id<>'$id'");
}

?>