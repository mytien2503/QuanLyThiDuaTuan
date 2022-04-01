<nav class="navbar navbar-expand-lg navbar-light sticky-top" style="background-color: #03658B;">
  <a class="navbar-brand  font-weight-bold " href="index.php?action=trangchu" style="color: yellow">THCS Nguyễn Kim Nha</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link text-light font-weight-bold" href="index.php?action=trangchu">Trang chủ <span class="sr-only">(current)</span></a>
      </li>
      <?php
      if (!isset($_SESSION["nguoidung"]) || (isset($_SESSION["nguoidung"]) && $_SESSION["nguoidung"]["loai"] == 0)) {
      ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-light font-weight-bold" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Danh sách
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="width: 100px !important">
            <a class="dropdown-item " href="?action=thongtin">Thi đua tuần</a>
            <a class="dropdown-item" href="?action=noiquy">Nội quy</a>
          </div>
        </li>
      <?php
      }
      ?>
      <?php
      if (isset($_SESSION["nguoidung"]) && $_SESSION["nguoidung"]["loai"] == 0) {
      ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-light font-weight-bold" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Trực tuần
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="?action=tructuan">Trực tuần</a>
            <a class="dropdown-item" href="?action=tongkettuan">Tổng kết tuần</a>
          </div>
        </li>
      <?php
      } else if (isset($_SESSION["nguoidung"]) && $_SESSION["nguoidung"]["loai"] == 1) {
      ?>
        <li class="nav-item">
          <a class="nav-link text-light font-weight-bold" href="?action=bangdieukhien">Bảng điều khiển<span class="sr-only">(current)</span></a>
        </li>

      <?php
      }
      ?>
    </ul>
    <?php
    if (isset($_SESSION["nguoidung"])) {
    ?>
      <form class="form-inline ml-auto">
        <a style="color:yellow;"><?php include("menutaikhoan.php") ?></a>
      </form>
    <?php
    } else {
    ?>
      <form class="form-inline ml-auto">
        <a style="color:yellow;" class="font-weight-bold" href="../../admin/ktnguoidung/index.php?action=dangnhap">Đăng nhập</a>
      </form>
    <?php
    }
    ?>
  </div>
</nav>
<!--form cap nhat ho so-->
<div class="modal fade" id="fcapnhatthongtin" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cập nhật hồ sơ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="../../../admin/ktnguoidung/index.php?action=capnhat" enctype="multipart/form-data">
          <div class="text-center">
              <img class="img-circle" src="../../images/<?php if ($_SESSION["nguoidung"]["hinhanh"]==NULL) echo "user.png"; else echo $_SESSION["nguoidung"]["hinhanh"]; ?>" alt="<?php echo $_SESSION["nguoidung"]["hoten"]; ?>" width="100px">
          </div>
          <div class="form-group">
            <label>Họ tên</label>
            <input class="form-control" type="text" name="txthoten" placeholder="Họ tên" value="<?php echo $_SESSION["nguoidung"]["hoten"]; ?>" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input class="form-control" type="email" name="txtemail" placeholder="Email" value="<?php echo $_SESSION["nguoidung"]["email"]; ?>">
          </div>
          <div class="form-group">
            <label>Số điện thoại</label>
            <input class="form-control" type="number" name="txtdienthoai" placeholder="Email" value="<?php echo $_SESSION["nguoidung"]["sodienthoai"]; ?>">
          </div>
          <?php if($_SESSION["nguoidung"]["lop"]!=null){ ?>
          <div class="form-group">
            <label>Lớp</label>
            <input class="form-control" type="text" name="txtlop" value="<?php echo $_SESSION["nguoidung"]["lop"]; ?>" readonly>
          </div>
          <?php } ?>
          <div class="form-group">
              <label>Hình ảnh</label>
              <input type="hidden" name="txthinhcu" value="<?php echo  $_SESSION["nguoidung"]["hinhanh"]; ?>">
              <input type="file" class="form-control" name="filehinhanh">          
          </div>
          <div class="form-group">
            <input type="hidden" name="txtid" value="<?php echo $_SESSION["nguoidung"]["id"]; ?>">
            <!--<input type="hidden" name="action" value="capnhat"> -->
            <input class="btn btn-primary" type="submit" value="Lưu">
            <input class="btn btn-warning" type="reset" value="Hủy">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>
<!--form doi mat khau -->
<div class="modal fade" id="fdoimatkhau" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Đổi mật khẩu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" id="hienthithongbao">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Thông báo! Mật khẩu không khớp!!!
        </div>
        <form method="post" action="../../../admin/ktnguoidung/index.php?action=doimatkhau" id="myform">
          <div class="form-group">
            <label>Mật khẩu mới</label>
            <input class="form-control" type="password" name="txtmatkhaumoi" id="txtmatkhaumoi" placeholder="Mật khẩu mới" required>
          </div>
          <div class="form-group">
            <label>Xác nhận mật khẩu mới</label>
            <input class="form-control" type="password" name="txtxacnhanmatkhau" id="txtxacnhanmatkhau" placeholder="Xác nhận mật khẩu" required>
          </div>
          <div class="form-group">
            <input type="hidden" name="txtemail" value="<?php echo $_SESSION["nguoidung"]["email"]; ?>">
            <input type="button" class="btn btn-primary" onclick="submitForm();" value="Lưu" />

            <!--<input class="btn btn-primary" type="submit" value="Lưu"> -->
            <input class="btn btn-warning" type="reset" value="Hủy">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    //Mặc đinh ẩn form
    $("#hienthithongbao").hide();
  });

  function submitForm() {
    if (document.getElementById('txtmatkhaumoi').value != document.getElementById('txtxacnhanmatkhau').value) {
      document.getElementById('hienthithongbao').style.display = 'block';
    } else {
      document.getElementById('myform').submit();
      document.getElementById('hienthithongbao').style.display = 'none';

    }
  }
</script>