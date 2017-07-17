<?php
session_start();
require_once '../config/dbconfig.php';
require_once '../class/class.user.php';
require_once '../class/class.manage.php';
$user_home = new USER();
$manage_home = new Manage();
$page = "security";
if(!$user_home->is_logged_in())
{
	$user_home->redirect('../login.php');
}

$stmt = $user_home->runQuery("SELECT * FROM pm_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html class="no-js">

    <head>
        <title>Tài khoản của bạn | <?php echo $siteTitle ?></title>
        <?php include("../template/header.php") ?>



    </head>

    <body>
	  <div class="app app-default">
			  <?php include("../template/menu_side.php"); ?>
     <div class="app-container">
			 <?php include("../template/menu_ac.php"); ?>
	 </br></br>


<?php
	$c1 = 0; //Total of accounts
	$c2 = 0; //Total of secure accounts
for ($i=1;$i < $manage_home->countCategory()+1; $i++) {
	$query = $user_home->runQuery("SELECT * from pm_accounts where userID=:userID");
	$query->execute(array(":userID"=>$row['userID']));
	// Display search result
	         if (!$query->rowCount() == 0) {
	            while ($results = $query->fetch()) {
								  $c1++;
									$manage_home->checkPassword($results['password'],$ar);
									if (empty($ar)) {
										$c2++;
									}
									$ar = "";
	            }
	        } else {
	            echo '<p>Bạn chưa có tài khoản nào, hãy thêm một tài khoản mới?</p>';
	        }
}
$rate = round((($c2 / $c1)*100),1);

?>
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body app-heading">
<div class="row">
<div class="col-md-3">
<?php if ($rate >70) { ?>
<img class="img-responsive" src="<?php echo $url_path."assets/img/secure-status.png"; ?>">
</div>
<div class="col-md-9">
<div class="app-title">
	<div class="title"><span class="highlight">Mức độ bảo mật tài khoản: <?php echo $rate ; ?>%</span></div>
	<div class="description">Chúc mừng, hầu như các tài khoản của bạn đều đang ở mức bảo mật tốt. Tuy nhiên đừng quên các quy tắc về bảo mật thông tin và bạn nên thay đổi mật khẩu sau mỗi 6 tháng.</div>
</div>
</div>
<?php } elseif (($rate <70) && ($rate >=45)) { ?>
<img class="img-responsive" src="<?php echo $url_path."assets/img/warning-status.png"; ?>">
</div>
<div class="col-md-9">
<div class="app-title">
	<div class="title"><span class="highlight" style="color: #FFC153;">Mức độ bảo mật tài khoản: <?php echo $rate ; ?>%</span></div>
	<div class="description">Các tài khoản của bạn đều đang ở mức bảo mật trung bình. Một số tài khoản của bạn không đảm bảo các yêu cầu bảo mật. Khuyến nghị bạn nên đặt mật khẩu dài > 8 kí tự, có chữ hoa, chữ thường kèm theo chữ số và nên có thêm kí tự đặc biệt.</div>
</div>
</div>
<?php } elseif (($rate <45)) {   ?>
<img class="img-responsive" src="<?php echo $url_path."assets/img/alert-status.png"; ?>">
</div>
<div class="col-md-9">
<div class="app-title">
	<div class="title"><span class="highlight" style="color: #E74C3C;">Mức độ bảo mật tài khoản: <?php echo $rate ; ?>%</span></div>
	<div class="description">Các tài khoản của bạn đều đang ở mức bảo mật kém. Đề nghị bạn tiến hành ngay lập tức thay đổi bằng các mật khẩu đảm bảo yêu cầu bảo mật như mật khẩu dài, có chữ hoa, chữ thường kèm theo chữ số và kí tự đặc biệt.</div>
</div>
</div>
<?php } ?>

</div>
</div>
</div>
</div>
</div>
 <?php include("../template/footer_ac.php") ?>
	 </div>
 </div>
       <?php include("../template/misc.php") ?>

    </body>

</html>
