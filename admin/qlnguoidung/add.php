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
                <h5 class="card-header text-center mb-3">THÊM NGƯỜI DÙNG</h5>
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
                    <label for="txthoten">Họ tên</label>
                    <input type="text" class="form-control mb-3" name="txthoten" placeholder="Nhập họ tên" required value="<?php echo $hoten  ?>">
                    <label for="txthoten">Email</label>
                    <input type="email" class="form-control mb-3" name="txtemail" id="txtemail" placeholder="Nhập email" required value="<?php echo $email ?>">
                    <label for="txtdienthoai">Số điện thoại</label>
                    <input type="number" class="form-control mb-3" name="txtdienthoai" placeholder="Nhập số điện thoại" required value="<?php echo $sodienthoai ?>">
                    <label for="ttxquyen">Quyền</label>
                    <select name="txtquyen" id="txtquyen" class="form-control mb-3">
                        <?php
                        if ($loai == 0) {
                        ?>
                            <option value="0" selected="selected">Học sinh</option>
                            <option value="1">Quản trị</option>
                        <?php
                        } else {
                        ?>
                            <option value="0">Học sinh</option>
                            <option value="1" selected="selected">Quản trị</option>
                        <?php
                        } ?>
                    </select>
                    <div id="txtlop">
                        <label for="txtlop">Lớp</label>
                        <input type="text" class="form-control mb-3" name="txtlop" placeholder="Nhập lớp" require value="<?php echo $lop ?>">
                    </div>
                    <label for="txtmatkhau">Mật khẩu</label>
                    <input type="password" class="form-control mb-3" name="txtmatkhau" placeholder="Nhập mật khẩu" required value="<?php echo $matkhau ?>">
                    <div class="text-center">
                        <input type="submit" class="btn btn-warning" value="Thêm người dùng">
                        <input type="hidden" name="action" value="xlthemnguoidung">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    $("#txtquyen").click(function() {
        if($("#txtquyen").val()==0)
            $("#txtlop").show();
        else
        {
            $("#txtlop").text='';
            $("#txtlop").hide();
        }
            
    });
</script>

</html>