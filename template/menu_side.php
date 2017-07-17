<aside class="app-sidebar" id="sidebar">
  <div class="sidebar-header">
    <a class="sidebar-brand" href="home" style="text-decoration: none;"><h1>PassMe</h1></a>
    <button type="button" class="sidebar-toggle">
      <i class="fa fa-times"></i>
    </button>
  </div>
  <div class="sidebar-menu">
    <ul class="sidebar-nav">
      <li <?php if ($page =="home") { echo "class='active'";} ?>>
        <a href="home">
          <div class="icon">
            <i class="fa fa-tasks" aria-hidden="true"></i>
          </div>
          <div class="title">Quản lý</div>
        </a>
      </li>
      <li <?php if ($page =="add") { echo "class='active'";} ?>>
        <a href="add">
          <div class="icon">
            <i class="fa fa-plus" aria-hidden="true"></i>
          </div>
          <div class="title">Thêm tài khoản</div>
        </a>
      </li>
      <li <?php if ($page =="security") { echo "class='active'";} ?>>
        <a href="security">
          <div class="icon">
            <i class="fa fa-shield" aria-hidden="true"></i>
          </div>
          <div class="title">Bảo mật</div>
        </a>
      </li>
    <!--   <li <?php if ($page =="apps") { echo "class='active'";} ?>>
        <a href="apps">
          <div class="icon">
            <i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i>
          </div>
          <div class="title">Ứng dụng</div>
        </a>
      </li> -->
        <li <?php if ($page =="help") { echo "class='active'";} ?>>
        <a href="../help">
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
