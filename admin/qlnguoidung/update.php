<!DOCTYPE html>
<html lang="en">

<head>
    <?php require("../include_ad/head.php");
    require("../include_ad/nav.php");
    ?>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3">
                <?php
                require("../leftlayout_ad/menuleft.php");
                ?>
            </div>
            <div class="col-sm-8">
            <h5 class="card-header text-center mb-3">CẬP NHẬT NGƯỜI DÙNG</h5>
                <div class="alert alert-danger text-center" id="hienthi">
                    <input id="thongbao" class="text-danger form-control " value="<?php echo $thongbao ?>" hidden>
                    <a href="#" id="thongbao" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Thông báo!</strong> <?php echo $thongbao ?>
                </div>
                <script>
                    $(document).ready(function() {
                        if (document.getElementById("thongbao").value == '') {
                            $("#hienthi").hide();
                        } else {
                            $("#hienthi").show();
                            $('#txtemail').focus();
                        }
                    });
                </script>
                <form class="form-group" method="post">
                    <input type="text" name="txtid" value="<?php echo $nguoidunghientai["id"] ?>" hidden>
                    <label for="txthoten">Họ tên</label>
                    <input type="text" class="form-control mb-3" name="txthoten" placeholder="Nhập họ tên" value="<?php echo $nguoidunghientai["hoten"] ?>" readonly>
                    <label for="txthoten">Email</label>
                    <input type="email" class="form-control mb-3" name="txtemail" id="txtemail" placeholder="Nhập email" value="<?php echo $nguoidunghientai["email"] ?>" readonly>
                    <label for="ttxquyen">Quyền</label>
                    <select name="txtquyen" class="form-control mb-3">
                        <?php
                        if ($nguoidunghientai["loai"] == 0) {
                        ?>
                            <option value="0" selected="selected">Học sinh</option>
                        <?php
                        } else {
                        ?>
                            <option value="1" selected="selected">Quản trị</option>
                        <?php
                        } ?>
                    </select>
                    <label for="txtlop">Lớp</label>
                    <input type="text" class="form-control mb-3" name="txtlop" placeholder="Nhập lớp" required value="<?php echo $nguoidunghientai["lop"] ?>">
                    <div class="text-center">
                        <input type="submit" class="btn btn-warning" value="Cập nhật người dùng">
                        <input type="hidden" name="action" value="xlsuanguoidung">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>