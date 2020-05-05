<?php
require_once(__ROOT__ . "dbConnection.php");
require_once(__ROOT__ . "User.php");

class Users extends dbconnect {
	private $users;
	function __construct() {
		$this->fillArray();
	}

	function fillArray() {
		$this->users = array();
		$this->db = $this->connect();
		$result = $this->readUsers();
		while ($row = $result->fetch_assoc()) {
			array_push($this->users, new User($row["ID"],$row["Name"],$row["username"],$row["Password"],$row["Age"],$row["Phone"]));
		}
	}

	function getUsers() {
		return $this->users;
	}

	function readUsers(){
		$sql = "SELECT * FROM user";

		$result = $this->db->query($sql);
		if ($result->num_rows > 0){
			return $result;
		}
		else {
			return false;
		}
	}
#table name is user which has name, username,pass,age,phone
	function insertUser($name,$username, $password, $age, $phone){
		$sql = "INSERT INTO user (name, password, age, phone,username) VALUES ('$name','$password', '$age', '$phone','$username')";
		if($this->db->query($sql) === true){
			echo "Records inserted successfully.";
			$this->fillArray();
		} 
		else{
			echo "ERROR: Could not able to execute $sql. " . $conn->error;
		}
	}
}