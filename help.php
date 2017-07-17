<?php
require_once 'config/dbconfig.php';
?>

<!DOCTYPE html>
<html class="no-js">

    <head>
        <title>Trung tâm hỗ trợ | <?php echo $siteTitle ?></title>
        <?php include("template/header.php") ?>



    </head>

    <body>
	  <div class="app app-default">
			<aside class="app-sidebar" id="sidebar">
			  <div class="sidebar-header">
			  <a class="sidebar-brand" href="home" style="text-decoration: none;"><h1>PassMe</h1></a>
			    <button type="button" class="sidebar-toggle">
			      <i class="fa fa-times"></i>
			    </button>
			  </div>
			  <div class="sidebar-menu">
			    <ul class="sidebar-nav">
			      <li>
			        <a href="./my/home">
			          <div class="icon">
			            <i class="fa fa-tasks" aria-hidden="true"></i>
			          </div>
			          <div class="title">Quản lý</div>
			        </a>
			      </li>
            <li>
			        <a href="./my/add">
			          <div class="icon">
			            <i class="fa fa-plus" aria-hidden="true"></i>
			          </div>
			          <div class="title">Thêm tài khoản</div>
			        </a>
			      </li>
			      <li>
			        <a href="./my/security">
			          <div class="icon">
			            <i class="fa fa-shield" aria-hidden="true"></i>
			          </div>
			          <div class="title">Bảo mật</div>
			        </a>
			      </li>
			      <li class="active">
			        <a href="help">
			          <div class="icon">
			            <i class="fa fa-question-circle" aria-hidden="true"></i>
			          </div>
			          <div class="title">Hỗ trợ</div>
			        </a>
			      </li>
			    </ul>
			  </div>
			  <div class="sidebar-footer">

			    <ul class="menu">
			      <li>
			        <a href="/" class="dropdown-toggle" data-toggle="dropdown">
			          <i class="fa fa-cogs" aria-hidden="true"></i>
			        </a>
			      </li>
			      <li><a href="#"><span class="flag-icon flag-icon-vn flag-icon-squared"></span></a></li>
			    </ul>
			  </div>
			</aside>

     <div class="app-container">
       <nav class="navbar navbar-default" id="navbar">
       <div class="container-fluid">
         <div class="navbar-collapse collapse in">
           <ul class="nav navbar-nav navbar-mobile">
             <li>
               <button type="button" class="sidebar-toggle">
                 <i class="fa fa-bars"></i>
               </button>
             </li>
             <li class="logo">
               <a class="navbar-brand" href="#" style="text-decoration:none;"><h1>PassMe</h1></a>
             </li>
             <li>
               <button type="button" class="navbar-toggle">
                 <img class="profile-img" src="./assets/images/profile.png">
               </button>
             </li>
           </ul>
           <ul class="nav navbar-nav navbar-left">

             <li class="navbar-search hidden-sm">
               <input id="search" type="text" placeholder="Tìm kiếm...">
               <button class="btn-search"><i class="fa fa-search"></i></button>
             </li>
           </ul>
           <ul class="nav navbar-nav navbar-right">
             <li>
               <a href="./my/">

                 <div class="title">Truy cập My PassMe</div>
               </a>
             </li>
           </ul>
         </div>
       </div>
       </nav>

	 </br></br>


<div class="row">
<div class="col-lg-12">
<div style="text-align: center"><h1>Trung tâm hỗ trợ </h1>
<p>Nhận các mẹo hữu ích, hướng dẫn sử dụng và trợ giúp từ PassMe</p></div>
<div class="card">
<div class="card-body app-heading">
<div class="row">
<div class="col-md-12">
<h2>Câu hỏi thường gặp (FAQ) </h2>




<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
      <b>PassMe được dùng để làm gì?</b></a>
      </h4>
    </div>
    <div id="collapse1" class="panel-collapse collapse in">
      <div class="panel-body">PassMe là ứng dụng giúp lưu trữ thông tin tài khoản của các dịch vụ trực tuyến chẳng hạn như Facebook, Google,... Giải quyết vấn đề khiến bạn phải nhớ nhiều mật khẩu cho các tài khoản khác nhau dễ gây nhầm lẫn hoặc quên hay giải quyết vấn đề đặt một mật khẩu chung cho các tài khoản vốn gây các nguy cơ tiềm tàng về bảo mật.</div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
    <b>Mật khẩu của tôi có an toàn khi lưu trên PassMe? PassMe có thể biết được các mật khẩu của tôi không?</b></a>
      </h4>
    </div>
    <div id="collapse2" class="panel-collapse collapse">
      <div class="panel-body">Mật khẩu của bạn khi lưu trữ trên PassMe đều được mã hóa và giải mã bằng chính mật khẩu PassMe hiện tại của bạn, chính vì vậy ngay cả hacker có thể truy cập vào dữ liệu của PassMe, họ cũng không thể tìm được mật khẩu của bạn.</div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
    <b>Cách thêm một tài khoản mới vào PassMe</b></a>
      </h4>
    </div>
    <div id="collapse3" class="panel-collapse collapse">
      <div class="panel-body">1) Bấm vào nút <b>Thêm tài khoản</b> ở thanh menu bên trái</br>2) Điền thông tin tài khoản</br>3) Bấm vào nút <b>Thêm tài khoản</b> bên dưới. </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
    <b>Cách sửa thông tin một tài khoản trong PassMe</b></a>
      </h4>
    </div>
    <div id="collapse4" class="panel-collapse collapse">
    <div class="panel-body">1) Bấm vào nút <b>Quản lý</b> ở thanh menu bên trái</br>2) Tìm tài khoản của bạn trong danh sách</br>3) Bấm vào nút <b>Thông tin</b> bên dưới rồi chọn <b>Sửa thông tin</b>. </div>
    </div>
  </div>
</div>
<h2>Vẫn còn câu hỏi? </h2>
<p>Liên hệ với PassMe qua:</br>Email: passme@lop67.tk </br>Điện thoại: 093 884 8549 (T2-T7)</p>
</div>

</div>
</div>
</div>
</div>
</div>
 <?php include("template/footer_ac.php") ?>
	 </div>
 </div>
       <?php include("template/misc.php") ?>

    </body>

</html>
