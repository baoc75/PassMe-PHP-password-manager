<?php
session_start();
require 'config/dbconfig.php';
require_once 'class/class.user.php';
require_once 'class/class.error.php';

$reg_user = new USER();
$reg_error = new ErrorRep();

if($reg_user->is_logged_in()!="")
{
	$reg_user->redirect('my/home.php');
}


if(isset($_POST['btn-signup']))
{
	$uname = addslashes($_POST['txtuname']);
	$email = addslashes($_POST['txtemail']);
	$upass = addslashes($_POST['txtpass']);
	$code = md5(uniqid(rand()));
	if(filter_var($email,FILTER_VALIDATE_EMAIL))
	{
	$stmt = $reg_user->runQuery("SELECT * FROM pm_users WHERE userEmail=:email_id");
	$stmt->execute(array(":email_id"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	if($stmt->rowCount() > 0)
	{
		header("Location: signup.php?error=4B");
		exit;
	}
	else
	{
		if($reg_user->register($uname,$email,$upass,$code))
		{
			$id = $reg_user->lasdID();
			$key = base64_encode($id);
			$id = $key;

			$message = "
						Xin chào, $uname,
						<br /><br />
						Chúc mừng bạn đã đăng ký thành công PassMe!<br/>
						Để hoàn tất việc đăng ký, xin hãy bấm vào đường link sau<br/>
						<br /><br />
						<a href='https://www.hidecontent.ml/passme/verify.php?id=$id&code=$code'>Xác nhận tài khoản</a>
						<br /><br />
						Cảm ơn bạn đã sử dụng dịch vụ của PassMe.";

			$subject = "Xác nhận email - PassMe";

			$reg_user->send_mail($email,$message,$subject);
			header("Location: signup.php?success=5B");
		    exit;
		}
		else
		{
			header("Location: signup.php?error=C1");
		    exit;
		}
	}
	}
	else
	{
		header("Location: signup.php?error=2C");
	}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Đăng ký | <?php echo $siteTitle ?></title>
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
      <form class="form-signin" method="post">
	   <?php
        if(isset($_GET['error']))
		{
			?>
            <div class='alert alert-warning'>
				<button class='close' data-dismiss='alert'>&times;</button>
				<strong><?php $reg_error->ectt($_GET['error']); ?></strong>
			</div>
            <?php
		}
		?>
	<?php
        if(isset($_GET['success']))
		{
			?>
            <div class='alert alert-success'>
				<button class='close' data-dismiss='success'>&times;</button>
				<strong><?php $reg_error->ectt($_GET['success']); ?></strong>
			</div>
            <?php
		}
		?>
        <h2 class="form-signin-heading">Đăng ký</h2><hr />
        <input type="text" class="input-block-level" placeholder="Tên của bạn" name="txtuname" required />
        <input type="email" class="input-block-level" placeholder="Địa chỉ email" name="txtemail" required />
        <input type="password" class="input-block-level" placeholder="Mật khẩu" name="txtpass" required />
     	<hr />
        <button class="btn btn-large btn-primary" type="submit" name="btn-signup">Đăng ký</button>
        <a href="login" style="float:right;" class="btn btn-large">Đăng nhập</a>
      </form>

    </div> <!-- /container -->
    <?php include("template/misc.php") ?>
  </body>
</html>
