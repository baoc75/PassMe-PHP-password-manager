<?php
session_start();
require '../config/dbconfig.php';
require_once '../class/class.user.php';
require_once '../class/class.manage.php';
require_once '../class/class.error.php';
$page = "add";
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


if(isset($_POST['add']))
{
	   // chọn loại tài khoản khác
	    if ($_POST['services'] == "0") {
				if ((empty($_POST['username'])) or (empty($_POST['password'])) or (empty($_POST['services2'])) or (!filter_var($_POST['url'], FILTER_VALIDATE_URL)) or (($_POST['cat']) > $manage_home->countCategory())) {
 					 	header("Location: add.php?error=1A");
						exit;
				}
			} else {
				if ((empty($_POST['username'])) or (empty($_POST['password'])) or (($_POST['cat'])> $manage_home->countCategory())) {
 					 	header("Location: add.php?error=1A");
						exit;
				}
			}


			$userid = addslashes($row['userID']);
			$user = addslashes($_POST['username']);
			$pass = addslashes($_POST['password']);
			$cat = addslashes($_POST['cat']);
			if ($_POST['services'] == "0") {
				$type = addslashes($_POST['services2']);
				$url = addslashes($_POST['url']);
				$manage_home->addAccount($userid,"0",$type,$user,$pass,$url,$cat);
				header("Location: add.php?success=4C");
			} else {
		  	$type = addslashes($_POST['services']);
				$manage_home->addAccount($userid,$type,"",$user,$pass,"",$cat);
				header("Location: add.php?success=4C");
		  }


}



?>

    <!DOCTYPE html>
    <html class="no-js">

    <head>
        <title>Thêm tài khoản mới |
            <?php echo $siteTitle ?>
        </title>
        <?php include("../template/header.php") ?>
    </head>

    <body>
        <div class="app app-default">
            <?php include("../template/menu_side.php"); ?>
            <div class="app-container">
                <?php include("../template/menu_ac.php"); ?>
                </br>
                </br>
                <center>
                    <h1 style="font-size: 30px; ">Thêm một tài khoản mới</h1>
                    <p style="font-weight: 400; width:50%;">Thêm một tài khoản của bạn vào PassMe để dễ dàng quản lý và truy cập tất cả cùng một nơi!</p>
                </center>
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
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        Thêm tài khoản
                                    </div>
                                    <div class="card-body">
                                        <form class="form form-horizontal" method="post">
                                            <div class="section">
                                                <div class="section-title">Thông tin dịch vụ</div>
                                                <div class="section-body">
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Loại tài khoản</label>
                                                        <div class="col-md-4">
                                                            <div class="input-group">
                                                                <?php
 						 		echo "<select class='select2' name='services'>";
 						 		for ($i = 0;$i < $manage_home->countService(); $i++) {
                                  $ar = $manage_home->getService_id($i);
                                  if($i==0){
                                  	echo "<option value='".$i."'>".$ar['fullname']."</option>";
                                  }else{
                                  	echo "<option value='".$i."' id='btnOther'>".$ar['fullname']."</option>";
                                  }		
 						 		}
 						 		echo "</select>";
 						 		?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group inpInfo">
                                                        <label class="col-md-3 control-label">Tên dịch vụ đăng nhập</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" name="services2" autocomplete="off">
                                                        </div>
                                                    </div> 
                                                    <div class="form-group inpInfo">
                                                        <label class="col-md-3 control-label">Trang web dịch vụ</label>
                                                        <div class="col-md-9">
                                                            <input type="url" class="form-control" name="url" autocomplete="off">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Chuyên mục</label>
                                                        <div class="col-md-4">
                                                            <div class="input-group">
                                                                <?php
 								 		 echo "<select class='select2' name='cat'>";
 							          for ($i = 1;$i < $manage_home->countCategory()+1; $i++) {
                                          	echo "<option value='".$i."'>".$manage_home->getCategory($i)."</option>";        
 							          }
 								  echo "</select>";
 								?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="section">
                                                <div class="section-title">Thông tin tài khoản</div>
                                                <div class="section-body">
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Email/tên tài khoản đăng nhập</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" name="username" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Mật khẩu</label>
                                                        <div class="col-md-9">
                                                            <input type="password" class="form-control" name="password" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-footer">
                                                <div class="form-group">
                                                    <div class="col-md-9 col-md-offset-3">
                                                        <button type="submit" class="btn btn-primary" name="add">Thêm</button>
                                                        <button type="button" class="btn btn-default">Hủy bỏ</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </br>
                        <p style="color: #01AB4F"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Thông tin tài khoản của bạn hiện đang được bảo mật bởi SSL </p>


                        <?php include("../template/footer_ac.php") ?>
            </div>
        </div>
        <?php include("../template/misc.php") ?>
        <script type="text/javascript">
            $(document).ready(function() {
$('.select2').change(function(){
if($(this).val()!=0){
$('.inpInfo').hide();
}
if($(this).val()==0){
$('.inpInfo').show();
}
})
            })
        </script>
    </body>

    </html>