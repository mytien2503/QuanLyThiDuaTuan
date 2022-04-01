<head>
<style type="text/css">
  .ghetham:hover{
    background-color: #03658B;
    color: white;
  }
</style>
</head>

<div class="container">
  <div class="row content">
    <div class="dropdown " style="text-align: right;">
      <a class="dropdown-toggle text-light font-weight-bold" data-toggle="dropdown" href="#" >
        <i class="fas fa-user-tie"></i> Chào
        <?php
        if (isset($_SESSION["nguoidung"]))
          echo $_SESSION["nguoidung"]["hoten"];
        ?>
        <span class="caret"></span>
      </a>

      <ul class="dropdown-menu dropdown-menu-right">
        <li class="ghetham"><a class="ghetham" href="#" data-toggle="modal" data-toggle="modal" data-target="#fcapnhatthongtin"><i class="fas fa-id-card"></i> Hồ sơ cá nhân</a></li>
        <li class="ghetham"><a class="ghetham" href="#" data-toggle="modal" data-target="#fdoimatkhau"><i class="fas fa-key"></i> Đổi mật khẩu</a></li>
        <li class="divider"></li>
        <li class="ghetham"><a class="ghetham" href="../ktnguoidung/index.php?action=xldangxuat"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a></li>
      </ul>
    </div>
  </div>
</div>
