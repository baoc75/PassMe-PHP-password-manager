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

	$stmt = $user->runQuery("SELECT * FROM pm_users WHERE userID=:uid AND tokenCode=:token");
	$stmt->execute(array(":uid"=>$id,":token"=>$code));
	$rows = $stmt->fetch(PDO::FETCH_ASSOC);

	if($stmt->rowCount() == 1)
	{
		if(isset($_POST['btn-reset-pass']))
		{
			$pass = $_POST['pass'];
			$cpass = $_POST['confirm-pass'];

			if($cpass!==$pass)
			{
				$msg = "<div class='alert alert-block'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Rất tiếc!</strong>  Mật khẩu xác nhận không khớp, xin hãy thử lại.
						</div>";
			}
			else
			{
				$password = md5($cpass);
				$stmt = $user->runQuery("UPDATE pm_users SET userPass=:upass WHERE userID=:uid");
				$stmt->execute(array(":upass"=>$password,":uid"=>$rows['userID']));

				$msg = "<div class='alert alert-success'>
						<button class='close' data-dismiss='alert'>&times;</button>
						Đã thay đổi mật khẩu thành công.
						</div>";
				header("refresh:5;index.php");
			}
		}
	}
	else
	{
		$msg = "<div class='alert alert-success'>
				<button class='close' data-dismiss='alert'>&times;</button>
				Không có tài khoản nào khớp với thông tin này, xin hãy thử lại.
				</div>";

	}


}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Khôi phục mật khẩu | <?php echo $siteTitle ?></title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/styles.css" rel="stylesheet" media="screen">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body id="login">
    <div class="container">
    	<div class='alert alert-success'>
			<strong>Xin chào,</strong>  <?php echo $rows['userName'] ?>. Bạn hiện đang được tiến hành khôi phục mật khẩu
		</div>
        <form class="form-signin" method="post">
        <h3 class="form-signin-heading">Khôi phục mật khẩu.</h3><hr />
        <?php
        if(isset($msg))
		{
			echo $msg;
		}
		?>
        <input type="password" class="input-block-level" placeholder="Mật khẩu mới" name="pass" required />
        <input type="password" class="input-block-level" placeholder="Xác nhận mật khẩu mới" name="confirm-pass" required />
     	<hr />
        <button class="btn btn-large btn-primary" type="submit" name="btn-reset-pass">Khôi phục mật khẩu</button>

      </form>

    </div> <!-- /container -->
    <?php include("template/misc.php") ?>
  </body>
</html>
