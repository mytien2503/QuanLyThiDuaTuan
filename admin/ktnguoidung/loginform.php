<!DOCTYPE html>
<html lang="en">
<?php include "../include_ad/head.php"; ?>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4 mt-3">
				<form class="form-signin" name="f" method="POST" boder="1">
					<h1 class="h3 mb-3 font-weight-bold text-center" style="font-family:Arial; color:dodgerblue">ĐĂNG NHẬP</h1>

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

					<label>Email</label>
					<input type="email" name="txtemail" class="form-control mb-3" placeholder="Email" required autofocus>
					<label>Mật khẩu</label>
					<input type="password" name="txtmatkhau" id="inputPassword" class="form-control" placeholder="Mật khẩu" required>
					<div class="checkbox mb-3 mt-3">
						<label>
							<input type="checkbox" name="HienPass"> Hiện mật khẩu
						</label>
					</div>
					<button class="btn btn-lg btn-primary btn-block" type="submit">Đăng nhập</button>
					<input type="hidden" name="action" value="xldangnhap">
					<div class="row">
						<div class="col-sm-4 ml-3"></div>
						<div class="col-sm-4">
							<small><i><a style="color:#0080FF;" href="index.php?action=quenmatkhau">Quên mật khẩu</a></i></small>
						</div>
					</div>
				</form>
			</div>
			<script>
				f.HienPass.onclick = function(e) {
					if (this.checked) {
						$("#inputPassword").attr("type", "text");
					} else {
						$("#inputPassword").attr("type", "password");
					}
				};
			</script>
			<div class="col-sm-4 ">
			</div>
		</div>
</body>

</html>