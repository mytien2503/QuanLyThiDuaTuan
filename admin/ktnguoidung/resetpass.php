<!DOCTYPE html>
<html lang="en">
<?php include "../include_ad/head.php"; ?>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <form method="post" class="form-signin" name="f">
                    <img class="mb-4 ml auto" src="../../images/icon.png" alt="" width="72" height="72" style="display: block; margin:auto;">
                    <h1 class="h3 mb-3 font-weight-normal text-center">Please sign in</h1>
                    <div class="alert alert-danger" id="hienthi">
                        <input id="thongbao" class="text-danger form-control text-center" value="<?php echo $thongbao ?>" hidden>
                        <a href="#" id="thongbao" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Thông báo!</strong> <?php echo $thongbao ?>
                    </div>
                    <script>
                        $(document).ready(function() {
                            if (document.getElementById("thongbao").value == '') {
                                $("#hienthi").hide();
                            } else {
                                $("#hienthi").show();
                            }
                        });
                    </script>
                    <div class="form-group">
                        <label>Mật khẩu mới</label>
                        <input class="form-control" type="password" name="txtmatkhaumoi" id="txtmatkhaumoi" placeholder="Mật khẩu mới" required>
                    </div>
                    <div class="form-group">
                        <label>Xác nhận mật khẩu mới</label>
                        <input class="form-control" type="password" name="txtxacnhanmatkhau" id="txtxacnhanmatkhau" placeholder="Xác nhận mật khẩu" required>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="txtemail" value="<?php echo $mailnhan; ?>">
                        <div class="row">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4">
                                <input type="submit" class="btn btn-primary" value="Lưu" />
                                <input type="hidden" name="action" value="resetpass" />
                                <input class="btn btn-warning" type="reset" value="Hủy">
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="col-sm-4 ">
            </div>
        </div>
</body>

</html>