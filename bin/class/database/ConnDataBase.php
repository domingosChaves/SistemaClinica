<?php 
/**
 * 
 */
class ConnDataBase
{
	function __construct(){
	$host = 'localhost';
	$dbname ='sisclinica';
	$username = "root";
	$password = "";

	try {
  		$conn = new PDO('mysql:host='.$host.';dbname='.$dbname, $username, $password);
 		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 		
 		$this->conn = $conn;
 		
		} catch(PDOException $e) { echo 'ERROR: ' . $e->getMessage();}

	}
}

?>