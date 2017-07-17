<?php


class Manage
{
	private $conn;
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }

	function isExist($name)
  {
		$ar = ["Facebook","Twitter","Google","zingid","Sgdtp"];
		if (in_array($name,$ar)) {
			return true;
		}
		else
		  return false;
	}

	function countService() {
		return 15;
	}

	function countCategory() {
		return 5;
	}

  function getCategory($id)
	{
		switch ($id)
		{
			case 1:
				return "Chung";
			case 2:
				return "Mạng xã hội";
  		case 3:
				return "Dịch vụ trực tuyến";
			case 4:
	  		return "Công việc";
			case 5:
				return "Tài chính thanh toán";
		}
	}

  // Return Services FUll Name and it's url via its short name
  function getService_name($name)
	{
		$stmt = $this->conn->prepare("SELECT * FROM pm_services WHERE name=:name");
		$stmt->execute(array(":name"=>$name));
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}

	function getService_id($id)
	{
		$stmt = $this->conn->prepare("SELECT * FROM pm_services WHERE id=:id");
		$stmt->execute(array(":id"=>$id));
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}

	function getInfo($accountid)
	{
		$stmt = $this->conn->prepare("SELECT * FROM pm_accounts WHERE id=:id");
		$stmt->execute(array(":id"=>$accountid));
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}

	public function checkPassword($pwd, &$errors) {
    $errors_init = $errors;

    if (strlen($pwd) < 8) {
        $errors[] = "Password too short!";
    }

    if (!preg_match("#[0-9]+#", $pwd)) {
        $errors[] = "Password must include at least one number!";
    }

    if (!preg_match("#[a-zA-Z]+#", $pwd)) {
        $errors[] = "Password must include at least one letter!";
    }

    return ($errors == $errors_init);
}

	function canAccess($userID,$accountID) {
		$stmt = $this->conn->prepare("SELECT * FROM pm_accounts WHERE id=:accountid");
		$stmt->execute(array(":accountid"=>$accountID));
		$a=$stmt->fetch(PDO::FETCH_ASSOC);


		if (($a['userID']) == ($userID)) {
			return true;
		}
		else {
			return false;
		}

	}

	function addAccount($userid,$serviceID,$name,$user,$pass,$url="",$cat=1)
	{
			 $query = $this->conn->prepare("INSERT INTO pm_accounts (userid,serviceID,name,username,password,url,category) VALUES (:userid,:serviceid,:name,:user,:pass,:url,:cat)");
			 $query->bindparam(":userid",$userid);
			 $query->bindparam(":user",$user);
			 $query->bindparam(":pass",$pass);
			 $blank = Null;
			 if ($serviceID == "0") {
				$query->bindparam(":name",$name);
			 	$query->bindparam(":url",$url);
			 }
			 else {
				 $query->bindparam(":name",$blank);
 			 	 $query->bindparam(":url",$blank);
			 }
			 $query->bindparam(":serviceid",$serviceID);
			 $query->bindparam(":cat",$cat);
			 $query->execute();

	}

	function editAccount($accountid,$user,$pass,$cat=1) {
		$query = $this->conn->prepare("UPDATE pm_accounts SET username=:username, password=:password, category=:cat WHERE id=:id");
		$query->bindparam(":username",$user);
		$query->bindparam(":password",$pass);
		$query->bindparam(":cat",$cat);
		$query->bindparam(":id",$accountid);
		$query->execute();

	}

	function editProfile($id,$name,$password="",$type) {
		if ($type==1) {
		$query = $this->conn->prepare("UPDATE pm_users SET userName=:username WHERE userID=:id");
		$query->bindparam(":username",$name);
		$query->bindparam(":id",$id);
		$query->execute();
	} elseif ($type==2) {
		$query = $this->conn->prepare("UPDATE pm_users SET userName=:username, userPass=:password WHERE userID=:id");
		$query->bindparam(":username",$name);
		$pass = md5($password);
    $query->bindparam(":password",$pass);
		$query->bindparam(":id",$id);
		$query->execute();

	}
	}

	function deleteAccount($accountid) {
		$query = $this->conn->prepare("DELETE FROM pm_accounts WHERE id=:id");
		$query->bindparam(":id",$accountid);
		$query->execute();

	}
}

?>
