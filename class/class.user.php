<?php



class USER
{

	private $conn;

	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }

	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}

	public function lasdID()
	{
		$stmt = $this->conn->lastInsertId();
		return $stmt;
	}

	function emailtoname($email)
	{
		$stmt = $this->conn->prepare("SELECT * FROM pm_users WHERE userEmail=:email");
		$stmt->execute(array(":email"=>$email));
		$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $userRow['userName'];
	}

	public function register($uname,$email,$upass,$code)
	{
		try
		{
			$password = md5($upass);
			$stmt = $this->conn->prepare("INSERT INTO pm_users(userName,userEmail,userPass,tokenCode)
			                                             VALUES(:user_name, :user_mail, :user_pass, :active_code)");
			$stmt->bindparam(":user_name",$uname);
			$stmt->bindparam(":user_mail",$email);
			$stmt->bindparam(":user_pass",$password);
			$stmt->bindparam(":active_code",$code);
			$stmt->execute();
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}


	public function login($email,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM pm_users WHERE userEmail=:email_id");
			$stmt->execute(array(":email_id"=>$email));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

			if($stmt->rowCount() == 1)
			{
				if($userRow['userStatus']=="Y")
				{
					if($userRow['userPass']==md5($upass))
					{
						$_SESSION['userSession'] = $userRow['userID'];
						return true;
					}
					else
					{
						header("Location: login.php?error=2B");
						exit;
					}
				}
				else
				{
					header("Location: login.php?error=3B");
					exit;
				}
			}
			else
			{
				header("Location: login.php?error=1B");
				exit;
			}
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}


	public function is_logged_in()
	{
		if(isset($_SESSION['userSession']))
		{
			return true;
		}
	}

	public function redirect($url)
	{
		header("Location: $url");
	}

	public function logout()
	{
		session_destroy();
		$_SESSION['userSession'] = false;
	}

	function send_mail($email,$message,$subject)
	{
		require_once('mailer/PHPMailerAutoload.php');
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->CharSet = 'UTF-8';
		$mail->SMTPDebug  = 0;
		$mail->SMTPAuth   = true;
		$mail->SMTPSecure = "tls";
		$mail->Host       = "smtp.zoho.com";
		$mail->Port       = 587;
		$mail->isSMTP();
		$mail->AddAddress($email);
		$mail->Username="hotro@lop67.tk";
		$mail->Password="chibaophucbao2804";
		$mail->SetFrom('hotro@lop67.tk','PassMe hỗ trợ người dùng');
		$mail->AddReplyTo("hotro@lop67.tk","PassMe hỗ trợ người dùng");
		$mail->Subject    = $subject;
		$mail->MsgHTML($message);
		$mail->IsHTML(true);
		$mail->XMailer = ' ';
		$mail->Send();
	}	
}
