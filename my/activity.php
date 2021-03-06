<?php
session_start();
require '../config/dbconfig.php';
require_once '../class/class.user.php';
require_once '../class/class.error.php';
$user_activity = new USER();
$eror_activity = new ErrorRep();
if(!$user_activity->is_logged_in())
{
	$user_activity->redirect('../login.php');
}

$stmt = $user_activity->runQuery("SELECT * FROM pm_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$dateFrom = date("d/m/Y");
$dateTo = date("d/m/Y");

if(isset($_POST['date-search'])) 
{
   $dateFrom = addslashes($_POST['timeCheckIn']);
   $dateTo = addslashes($_POST['timeCheckOut']);
   if ((checkdate((int)substr($dateFrom,4,2),(int)substr($dateFrom,1,2),(int)substr($dateFrom,7,4))) AND (checkdate((int)substr($dateTo,4,2),(int)substr($dateTo,1,2),(int)substr($dateTo,7,4)))) 
	   if ((strlen($dateTo)==10) AND (strlen($dateFrom)==10))
			{	
				
			}
   else
   {
	   header("Location: activity.php?error=4C");
	   exit;
   }
}
?>

<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title>Lịch sử giao dịch - PiggyBank</title>
        <?php include("../template/header.php") ?>
		<link href="../bootstrap/css/datepicker.css" rel="stylesheet" />

    </head>
    
    <body>
	 <?php include("../template/menu_ac.php") ?>
	 </br></br>
       <div class="container">
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
  <h2>Lịch sử giao dịch</h2>
   <div class="row"> <form method="post">
  <div class="col-md-4">
  <div class="col-md-6">
      
	       <input type="text" name="timeCheckIn" id="timeCheckIn" class="form-control" value="<?php echo $dateFrom ?>" />

  </div>
  <div class="col-md-6">
  
         <div class="input-group">
      <input type="text" name="timeCheckOut" id="timeCheckOut" class="form-control" value="<?php echo $dateTo ?>" />
      <span class="input-group-btn">
       <button type="submit" name="date-search" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
      </span>
    </div>
  </div>
 
  </div>
  <div class="col-md-8">
  </div>
  </form> 
  </div>
  </br>

	<?php 
$query = $user_activity->runQuery("SELECT * from activity where (fromEmail=:userEmail OR toEmail=:userEmail) AND (date BETWEEN :dateFrom AND :dateTo)  ORDER BY `activity`.`id`");
$dateFromc = date("Y-m-d", strtotime($dateFrom));
$dateToc = date("Y-m-d", strtotime($dateTo));


$query->execute(array(":userEmail"=>$row['userEmail'],":dateFrom"=>$dateFromc,":dateTo"=>$dateToc));
// Display search result
         if (!$query->rowCount() == 0) {
				echo "<table class=\"table table-hover\">";	
                echo "<tr><th>Thời gian</th><th>Người gửi</th><th>Người nhận</th><th>Số tiền</th><th>Nội dung</th></tr>";				
            while ($results = $query->fetch()) {
				echo "<tr><td>";			
                echo "".date("d-m-Y", strtotime($results['date']));
				echo "</td><td>";
				if (($results['fromEmail'])==($row['userEmail'])) 
				{
					echo "<b>Bạn</b>";
					echo "</td><td>";
				}
				else 
				{
					echo "".$user_activity->emailtoname($results['toEmail']);
					echo "</td><td>";
				}
				if (($results['toEmail'])==($row['userEmail'])) 
				{
					echo "<b>Bạn</b>";
					echo "</td><td>";
					echo "+".$results['cash'].'đ';
					echo "</td><td>";
				}
				else 
				{
					echo "".$user_activity->emailtoname($results['toEmail']);
					echo "</td><td>";
					echo "-".$results['cash'].'đ';
					echo "</td><td>";
				}
				echo $results['content'];
				echo "</td><td>";
				echo "</td></tr>";	
			    
            }
				echo "</table>";		
        } else {
            echo '<h3>Không có giao dịch nào trong thời gian này! </br>Bạn sắp mua gì đó? Hãy xem qua khuyến mại của PiggyBank</h3>';
        }
	?>


	   </div>
       <?php include("../template/footer_ac.php") ?> 
       <?php include("../template/misc.php") ?>
       <script src="../bootstrap/js/bootstrap-datepicker.js"></script> 
	     <script>
        $(function () {
            'use strict';
            var nowTemp = new Date();
            var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

            var checkin = $('#timeCheckIn').datepicker({
                onRender: function (date) {
                    return date.valueOf() < now.valueOf() ? 'disabled' : '';
                }
            }).on('changeDate', function (ev) {
                if (ev.date.valueOf() > checkout.date.valueOf()) {
                    var newDate = new Date(ev.date)
                    newDate.setDate(newDate.getDate() + 1);
                    checkout.setValue(newDate);
                }
                checkin.hide();
                $('#timeCheckOut')[0].focus();
            }).data('datepicker');
            var checkout = $('#timeCheckOut').datepicker({
                onRender: function (date) {
                    return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
                }
            }).on('changeDate', function (ev) {
                checkout.hide();
            }).data('datepicker');
        });   
				    $('#timeCheckIn#timeCheckOut').datepicker({
    format: 'mm/dd/yyyy',
});
 $('#timeCheckIn').datepicker({
    startDate: '-infinity'
});
    </script>

    </body>

</html>