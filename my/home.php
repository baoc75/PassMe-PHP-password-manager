<?php
session_start();
require_once '../config/dbconfig.php';
require_once '../class/class.user.php';
require_once '../class/class.manage.php';
$user_home = new USER();
$manage_home = new Manage();
$page = "home";
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

<style media="screen">
.card-text{margin: 10px;}
.btnhay{margin: -4px;}
.card-title{margin: 10px;}
</style>

    </head>

    <body>
	  <div class="app app-default">
			  <?php include("../template/menu_side.php"); ?>
     <div class="app-container">
			 <?php include("../template/menu_ac.php"); ?>
	 </br></br>


<?php
	$c = 0;
for ($i=1;$i < $manage_home->countCategory()+1; $i++) {
	echo "<div class='row'>";
	echo "<section><h3>".$manage_home->getCategory($i)."</h3><hr>";
	$query = $user_home->runQuery("SELECT * from pm_accounts where userID=:userID and category=:cat ORDER BY `pm_accounts`.`id` DESC");
	$query->execute(array(":userID"=>$row['userID'],":cat"=>$i));
	// Display search result
	         if (!$query->rowCount() == 0) {
	            while ($results = $query->fetch()) {
				 				$c++;
				 				if ($results['serviceID'] == 0) {
									echo "<div class='col-md-4'><div class='card'>";
												echo "<img class='img-fluid' src='".$url_path."assets/img/default.png' alt='Tài khoản của bạn'>";
												echo "<div class='card-block'>";
												echo "<h4 class='card-title'>".$results['name']."</h4>";
												echo "<p class='card-text'>Tên tài khoản/Email: ".$results['username']."</br>"."Trang web: ".$results['url']."</p>";
												echo"<div class='row btnhay'><div class='col-md-6'><a href='#' class='btn btn-default' data-toggle='modal' data-target='#info-".$c."'>Thông tin</a></div><div class='col-md-6'><a href='".$ar['url']."' target='blank' class='btn btn-primary'>Đăng nhập</a></div>";
												echo"</div></div></div></br>";

						 echo "<div id='info-".$c."' class=\"modal fade\" role=\"dialog\">\n";
					 echo "  <div class=\"modal-dialog\">\n";
					 echo "\n";
					 echo "    <!-- Modal content-->\n";
					 echo "    <div class=\"modal-content\">\n";
					 echo "      <div class=\"modal-header\">\n";
					 echo "        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>\n";
					 echo "        <h4 class=\"modal-title\">Thông tin tài khoản</h4>\n";
					 echo "      </div>\n";
					 echo "      <div class=\"modal-body\">\n";
					 echo "<p>Tên tài khoản:".$results['username']."</br>Mật khẩu: ".$results['password']."</br>Dịch vụ: ".$results['name']."</br>Trang web: ".$results['url']."</p>";
					 echo "      </div>\n";
					 echo "      <div class=\"modal-footer\">\n";
					 echo "        <button type=\"button\" class=\"btn btn-outline-info \" data-dismiss=\"modal\">Đóng</button><a href=".$url_path.'my/edit?id='.$results['id']."><button type=\"button\" class=\"btn btn-info\">Sửa thông tin</button></a>";
					 echo "      </div>\n";
					 echo "    </div>\n";
					 echo "\n";
					 echo "  </div>\n";
					 echo "</div></div>\n";
				 				} else {
				 				$ar = $manage_home->getService_id($results['serviceID']);
								echo "<div class='col-md-4'><div class='card'>";
											echo "<img class='img-fluid' src='".$url_path."assets/img/".$ar['img']."' alt='Tài khoản của bạn'>";
											echo "<div class='card-block'>";
											echo "<h4 class='card-title'>".$ar['fullname']."</h4>";
											echo "<p class='card-text'>Tên tài khoản/Email: ".$results['username']."</br>"."Trang web: ".$ar['url']."</p>";
											echo"<div class='row btnhay'><div class='col-md-6'><a href='#' class='btn btn-default' data-toggle='modal' data-target='#info-".$c."'>Thông tin</a></div><div class='col-md-6'><a href='".$ar['url']."' target='blank' class='btn btn-primary'>Đăng nhập</a></div>";
											echo"</div></div></div></br>";

					 echo "<div id='info-".$c."' class=\"modal fade\" role=\"dialog\">\n";
				 echo "  <div class=\"modal-dialog\">\n";
				 echo "\n";
				 echo "    <!-- Modal content-->\n";
				 echo "    <div class=\"modal-content\">\n";
				 echo "      <div class=\"modal-header\">\n";
				 echo "        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>\n";
				 echo "        <h4 class=\"modal-title\">Thông tin tài khoản</h4>\n";
				 echo "      </div>\n";
				 echo "      <div class=\"modal-body\">\n";
				 echo "<p>Tên tài khoản:".$results['username']."</br>Mật khẩu: ".$results['password']."</br>Dịch vụ: ".$ar['fullname']."</br>Trang web: ".$ar['url']."</p>";
				 echo "      </div>\n";
				 echo "      <div class=\"modal-footer\">\n";
				 echo "        <button type=\"button\" class=\"btn btn-outline-info \" data-dismiss=\"modal\">Đóng</button><a href=".$url_path.'my/edit?id='.$results['id']."><button type=\"button\" class=\"btn btn-info\">Sửa thông tin</button></a>";
				 echo "      </div>\n";
				 echo "    </div>\n";
				 echo "\n";
				 echo "  </div>\n";
				 echo "</div></div>\n";
							}
	            }
	        } else {
	            echo '<p>Bạn chưa có tài khoản nào, hãy thêm một tài khoản mới?</p>';
	        }
	echo "</section></div></br>";
}

?>
 <?php include("../template/footer_ac.php") ?>
	 </div>
 </div>
       <?php include("../template/misc.php") ?>

    </body>

</html>
