<?php
session_start();
require '../config/dbconfig.php';
require_once '../class/class.user.php';
require_once '../class/class.manage.php';
require_once '../class/class.error.php';
$page = "edit";
$user_home = new USER();
$manage_home = new Manage();
$error_home = new ErrorRep();
if(!$user_home->is_logged_in())
{
	$user_home->redirect('../index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM pm_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if (isset($_GET['id'])) {
	if (!$manage_home->canAccess($row['userID'],addslashes($_GET['id']))) {
			header("Location: home.php");
			exit;
	}
}
else {
	header("Location: home.php");
	exit;
}

if (isset($_POST['edit'])) {
	if ((empty($_POST['username'])) or (empty($_POST['password'])) or (($_POST['cat']) > $manage_home->countCategory())) {
			header("Location: edit.php?error=1A");
			exit;
	}
}

$info = $manage_home->getInfo(addslashes($_GET['id']));
$info2 = $manage_home->getService_id($info['serviceID']);

if(isset($_POST['edit'])) {
			 $manage_home->editAccount(addslashes($_GET['id']),addslashes($_POST['username']),addslashes($_POST['password']),addslashes($_POST['cat']));
			 header("Location: edit.php?success=5C");
}

if(isset($_POST['delete'])) {
			 $manage_home->deleteAccount(addslashes($_GET['id']));
			 header("Location: home.php");
}



?>

<!DOCTYPE html>
<html class="no-js">

    <head>
        <title>Quản lý thông tin đăng nhập | <?php echo $siteTitle ?></title>
        <?php include("../template/header.php") ?>
    </head>
    <body>
			<div class="app app-default">
					<?php include("../template/menu_side.php"); ?>
			 <div class="app-container">
				 <?php include("../template/menu_ac.php"); ?>
	</br></br>
  <!--  <center><h1 style="font-size: 30px; ">Thêm một tài khoản mới</h1>
	<p style="font-weight: 400; width:50%;">Thêm một tài khoản của bạn vào PassMe để dễ dàng quản lý và truy cập tất cả cùng một nơi!</p></center> -->
    </br>
   <?php
        if(isset($_GET['error']))
			if ($error_home->exist($_GET['error']))
				{
					?>
						<div class='alert alert-warning'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong><?php $error_home->ectt($_GET['error']); ?></strong>
						</div>
					<?php
				}
					?>
	   <?php
        if(isset($_GET['success']))
			if ($error_home->exist($_GET['success']))
				{
					?>
						<div class='alert alert-success'>
						<button class='close' data-dismiss='success'>&times;</button>
						<strong><?php $error_home->ectt($_GET['success']); ?></strong>
						</div>
					<?php
				}
					?>

					<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body app-heading">
					<div class="row">
					<div class="col-md-3">
          <img class="img-responsive" src="<?php echo $url_path."assets/img/".$info2['img']; ?>">
				</div>
				  <div class="col-md-9">
          <div class="app-title">
            <div class="title"><span class="highlight"><?php echo $info2['fullname']; ?></span></div>
            <div class="description"><?php echo $info2['url']; ?></div>
          </div>
				</div>
				</div>
        </div>
      </div>
    </div>
  </div>
					<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								Thêm tài khoản
							</div>
							<div class="card-body">
  <form method="post" class="form form-horizontal">
		<div class="section">
			<div class="section-title">Thông tin tài khoản</div>
			<div class="section-body">
				<div class="form-group">
					<label class="col-md-3 control-label">Email/tên tài khoản đăng nhập</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="username" value="<?php echo $info['username'] ?>" required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Mật khẩu</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="password" value="<?php echo $info['password'] ?>" required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Chuyên mục</label>
					<div class="col-md-4">
						<div class="input-group">
							<?php
							  $t = $info['category'];
								echo "<select class='select2' name='cat'>";
								echo "<option value='".$t."' selected>".$manage_home->getCategory($t)."</option>";
								for ($i = 1;$i < $manage_home->countCategory()+1; $i++) {
									 if ($i != $t) {
										echo "<option value='".$i."'>".$manage_home->getCategory($i)."</option>";
									 }
								}
								echo "</select>";
							?>

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="form-footer">
			<div class="form-group">
				<div class="col-md-9 col-md-offset-3">
					<button type="submit" name="edit" class="btn btn-primary">Lưu</button>
					<button type="submit" name="delete" class="btn btn-danger">Xóa tài khoản</button>
				</div>
			</div>
		</div>
</form>
</div></div></div></div>
</br>
<p style="color: #01AB4F"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Thông tin tài khoản của bạn hiện đang được bảo mật bởi SSL </p>


<?php include("../template/footer_ac.php") ?>
</div>
</div>
<?php include("../template/misc.php") ?>

    </body>

</html>
