<?php
  require_once(__ROOT__ . "dbConnection.php");
?>

<?php
#user edit his profile ---HERE----
class User extends dbconnect {
    private $id;
    private $name;
	private $password;
    private $age;
    private $phone;
    private $urgentorNot;

  function __construct($id,$name="",$password="",$age="",$phone="",$urgentorNot="") {
    $this->id = $id;
	    $this->db = $this->connect();

    if(""===$name){
      $this->readUser($id);
    }else{
      $this->name = $name;
	  $this->password=$password;
      $this->age = $age;
      $this->phone = $phone;
      $this->urgentorNot=$urgentorNot;
    }
  }

  function getName() {
    return $this->name;
  }
  function setName($name) {
    return $this->name = $name;
  }
  
   function getPassword() {
    return $this->password;
  }
  function setPassword($password) {
    return $this->password = $password;
  }
  
  function getAge() {
    return $this->age;
  }
  function setAge($age) {
    return $this->age = $age;
  }
  
  function getPhone() {
    return $this->phone;
  }
  function setPhone($phone) {
    return $this->phone = $phone;
  }

  function getID() {
    return $this->id;
  }

  function getUrgent(){
    return $this->urgentorNot;
  }
  function setUrgent(){
    return $this->urgentorNot = $urgentorNot;
}

  function readUser($id){
    $sql = "SELECT * FROM user where ID=".$id;
    $db = $this->connect();
    $result = $db->query($sql);
    if ($result->num_rows == 1){
        $row = $db->fetchRow();
        $this->name = $row["Name"];
		$_SESSION["Name"]=$row["Name"];
		$this->password=$row["Password"];
        $this->age = $row["Age"];
        $this->phone = $row["Phone"];
        $this->urgentorNot=$row["urgentorNot"]
    }
    else {
        $this->name = "";
		$this->password="";
        $this->age = "";
        $this->phone = "";
        $this->urgentorNot="";
    }
  }
  
  function editUser($name, $password, $age, $phone,$urgentorNot){
      $sql = "update user set name='$name',password='$password', age='$age', phone='$phone',urgentorNot='$urgentorNot' where id=$this->id;";
        if($this->db->query($sql) === true){
            echo "updated successfully.";
            $this->readUser($this->id);
        } else{
            echo "ERROR: Could not able to execute $sql. " . $conn->error;
        }

  }
  
  function deleteUser(){
	  $sql="delete from user where id=$this->id;";
	  if($this->db->query($sql) === true){
            echo "deletet successfully.";
        } else{
            echo "ERROR: Could not able to execute $sql. " . $conn->error;
        }
	}
	 
}