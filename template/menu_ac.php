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
        <a class="navbar-brand" style="text-decoration: none" href="#"><h1>PassMe</h1></a>
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
      <li class="dropdown profile notification">
        <a href="/html/pages/profile.html" class="dropdown-toggle"  data-toggle="dropdown">
          <div class="icon"><i class="fa fa-user" aria-hidden="true"></i></div>
          <div class="title">Hồ sơ</div>
        </a>
        <div class="dropdown-menu">
          <div class="profile-info">
            <h4 class="username"><?php echo $row['userName'] ?></h4>
          </div>
          <ul class="action">
            <li>
              <a href="profile">
                Hồ sơ
              </a>
            </li>
            <li>
              <a href="logout">
                Đăng xuất
              </a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</div>
</nav>
