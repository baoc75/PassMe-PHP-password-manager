<?php
require 'config/dbconfig.php';
require_once 'class/class.user.php';
$user = new USER();

if(empty($_GET['id']) && empty($_GET['code']))
{
	$user->redirect('login.php');
}

if(isset($_GET['id']) && isset($_GET['code']))
{
	$id = base64_decode($_GET['id']);
	$code = $_GET['code'];

	$statusY = "Y";
	$statusN = "N";

	$stmt = $user->runQuery("SELECT userID,userStatus FROM pm_users WHERE userID=:uID AND tokenCode=:code LIMIT 1");
	$stmt->execute(array(":uID"=>$id,":code"=>$code));
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	if($stmt->rowCount() > 0)
	{
		if($row['userStatus']==$statusN)
		{
			$stmt = $user->runQuery("UPDATE pm_users SET userStatus=:status WHERE userID=:uID");
			$stmt->bindparam(":status",$statusY);
			$stmt->bindparam(":uID",$id);
			$stmt->execute();

			$msg = "
		           <div class='alert alert-success'>
				   <button class='close' data-dismiss='alert'>&times;</button>
					 <strong>Chúc mừng!</strong> Tài khoản của bạn đã được kích hoạt. Xin vui lòng <a href='login.php'>Đăng nhập</a>.
			       </div>
			       ";
		}
		else
		{
			$msg = "
		           <div class='alert alert-error'>
				   <button class='close' data-dismiss='alert'>&times;</button>
					  <strong>Rất tiếc!</strong> Tài khoản của bạn đã được kích hoạt rồi. Xin vui lòng <a href='login.php'>Đăng nhập</a>.
			       </div>
			       ";
		}
	}
	else
	{
		$msg = "
		       <div class='alert alert-error'>
			   <button class='close' data-dismiss='alert'>&times;</button>
			   <strong>Rất tiếc!</strong> Không tìm thấy tài khoản nào khớp với thông tin trên. Xin hãy <a href='signup.php'>Đăng ký tài khoản mới</a>.
			   </div>
			   ";
	}
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Xác nhận email | <?php echo $siteTitle ?></title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/styles.css" rel="stylesheet" media="screen">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </head>
  <body id="login">
    <div class="container">
		<?php if(isset($msg)) { echo $msg; } ?>
    </div> <!-- /container -->
    <?php include("template/misc.php") ?>
  </body>
</html>
