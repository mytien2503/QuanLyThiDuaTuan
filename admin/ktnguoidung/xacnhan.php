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
					<div class="alert alert-info" id="hienthi">
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
						<label for="text" class="sr-only form-control">Mã xác nhận</label>
						<input type="text" name="txtxacnhan" class="form-control mb-3" placeholder="Mã xác nhận" required autofocus>
						<button class="btn btn-lg btn-primary btn-block" type="submit">xác nhận</button>
						<input type="hidden" name="action" value="maxacnhan">
						<input type="hidden" name="txtmaxacnhan" value="<?php echo $maxacnhan?>">
                        <input type="hidden" name="txtemail" value="<?php echo $mailnhan?>">
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