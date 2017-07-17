<?php
session_start();
require '../config/dbconfig.php';
require_once '../class/class.user.php';
require_once '../class/class.manage.php';
require_once '../class/class.error.php';
$user_activity = new USER();
$manage_home = new Manage();
$eror_activity = new ErrorRep();
$page = "profile";
if(!$user_activity->is_logged_in())
{
	$user_activity->redirect('../login.php');
}

$stmt = $user_activity->runQuery("SELECT * FROM pm_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])) {
 $unpass = addslashes($_POST['unpass']);
 $ucpass = addslashes($_POST['ucpass']);
 $uncpass = addslashes($_POST['uncpass']);
 $name = addslashes($_POST['uname']);
 if (($unpass != "") or ($uncpass != ""))  {
	 if ($row['userPass'] == md5($ucpass)) {
		 if ($unpass == $uncpass) {
         $manage_home->editProfile($row['userID'],$name,$unpass,2);
		 }
		 else {
			 header("Location: profile.php?error=2A");
			 exit;
		 }
	 } else {
		 header("Location: profile.php?error=3A");
		 exit;
	 }

 }
 else {
	 	if ((empty($name))) {
	 			header("Location: profile.php?error=1A");

	 	}
		$manage_home->editProfile($row['userID'],$name,"",1);
		header("Location: profile.php?success=6C");

	 }
 }

?>

<!DOCTYPE html>
<html class="no-js">

    <head>
        <title>Sửa thông tin cá nhân - PiggyBank</title>
        <?php include("../template/header.php") ?>

    </head>

    <body>
			<div class="app app-default">
				  <?php include("../template/menu_side.php"); ?>
	     <div class="app-container">
				 <?php include("../template/menu_ac.php"); ?>
	 </br></br>

	  <?php
        if(isset($_GET['error']))
			if ($eror_activity->exist($_GET['error']))
				{
					?>
						<div class='alert alert-warning'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong><?php $eror_activity->ectt($_GET['error']); ?></strong>
						</div>
					<?php
				}
					?>
	   <?php
        if(isset($_GET['success']))
			if ($eror_activity->exist($_GET['success']))
				{
					?>
						<div class='alert alert-success'>
						<button class='close' data-dismiss='success'>&times;</button>
						<strong><?php $eror_activity->ectt($_GET['success']); ?></strong>
						</div>
					<?php
				}
					?>
  <h2>Thông tin cá nhân</h2>
		<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					Thêm tài khoản
				</div>
				<div class="card-body">
					<form class="form form-horizontal" method="post">
		<div class="form-group">
			<label class="col-md-3 control-label">Tên của bạn</label>
			<div class="col-md-9">
				  <input type="text" class="form-control" value="<?php echo $row['userName']; ?>" name="uname" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-3 control-label">Email</label>
			<div class="col-md-9">
					<input type="email" class="form-control" value="<?php echo $row['userEmail']; ?>" name="email" disabled />
			</div>
		</div>

		<div class="form-group">
		  <label class="col-md-3 control-label">Mật khẩu hiện tại</label>
			<div class="col-md-9">
					  <input type="password" class="form-control" name="ucpass" placeholder="Không đổi" />
			</div>
		</div>



		<div class="form-group">
			<label class="col-md-3 control-label">Mật khẩu mới</label>
			<div class="col-md-9">
						<input type="password" class="form-control" name="unpass" />
			</div>
		</div>

		<div class="form-group">
			    <label class="col-md-3 control-label">Xác nhận mật khẩu mới</label>
				<div class="col-md-9">
						<input type="password" class="form-control" name="uncpass" />
				</div>
		</div>

		<div class="form-footer">
 		 <div class="form-group">
 			 <div class="col-md-9 col-md-offset-3">
 				   <button class="btn btn-large btn-primary" type="submit" name="submit">Lưu</button>
 			 </div>
 		 </div>
 	 </div>
      </form>
		</div></div></div></div>
  </br>



       <?php include("../template/footer_ac.php") ?>
		 </div>
	 </div>
       <?php include("../template/misc.php") ?>

    </body>

</html>
