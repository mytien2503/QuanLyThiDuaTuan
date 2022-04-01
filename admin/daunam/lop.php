<!DOCTYPE html>
<html lang="en">

<head>
	<?php require("../include_ad/head.php");
	include("../include_ad/nav.php"); ?>
</head>

<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3">
				<?php require "../leftlayout_ad/menuleft.php" ?>
			</div>
			<div class="col-sm-8 mt-3">
				<?php require "groupbutton.php" ?>
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						<form class="form-inline mb-3" method="POST" id="formthem">
							<label>Khối</label>
							<select name="select1" id="select1" class="combobox ml-1">
								<?php
								foreach ($khoi as $k) :
									if ($khoichon == $k["id"]) {
								?>
										<option value="<?php echo $k["id"]; ?>" selected="selected"><?php echo $k["khoi"]; ?></option>

									<?php
									} else {
									?>
										<option value="<?php echo $k["id"]; ?>"><?php echo $k["khoi"]; ?></option>
								<?php
									}

								endforeach;
								?>
							</select>
							<input type="text" class="form-control ml-1" name="txtlop" placeholder="Nhập lớp" required>
							<input type="submit" class="btn btn-warning ml-1" value="Xác nhận" id="btnthemlop">
							<input type="hidden" name="action" value="xulythemlop">
						</form>
						<!--Form sửa -->
						<?php if(isset($idsua) && $idsua!=0){
						?>
						<form class="form-inline mb-3" method="POST">
							<label>Khối</label>
							<select name="select1" id="select1" class="combobox ml-1">
								<?php
								foreach ($khoi as $k) :
									if ( $lophienhanh["khoi_id"] == $k["id"]) {
								?>
									<option value="<?php echo $k["id"]; ?>" selected="selected"><?php echo $k["khoi"]; ?></option>
								<?php
									}
								endforeach;
								?>
							</select>
							<input type="text" class="form-control ml-1" name="txtlop" placeholder="Nhập lớp" value="<?php echo $lophienhanh["lop"] ?>" required>
							<input type="text" hidden class="form-control ml-1" name="txtid" value="<?php echo $lophienhanh["id"] ?>" required>
							<input type="submit" class="btn btn-warning ml-1" value="Cập nhật lớp">
							<input type="hidden" name="action" value="xulysualop">
						</form>
						<?php } ?>
						<!--Kết thúc Form sửa -->
					</div>
					<div class="col-sm-3"></div>
				</div>
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
				<div>
					<table class="table table-hover" id="table2excel">
						<thead>
							<tr class="thead-dark">
								<th scope="col">STT</th>
								<th scope="col">Lớp</th>
								<th scope="col">Sửa</th>
								<th scope="col">Xóa</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$stt = 1;
							foreach ($dslop as $l) :
							?>
								<tr>
									<td><?php echo $stt ?></td>
									<td><?php echo $l["lop"] ?></td>
									<td><a class="btn btn-warning" href="index.php?action=sualop&id=<?php echo $l["id"]; ?>"><i class="far fa-edit"></i></a></td>
									<td><a class="btn btn-danger" href="index.php?action=xoalop&id=<?php echo $l["id"]; ?>" onclick="return confirm('Bạn có chắc muốn xóa Lớp <?php echo $l['lop']   ?> ?')"><i class="far fa-trash-alt"></i></a></td>
								</tr>
							<?php
								$stt++;
							endforeach;
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>
<script>
	$(document).ready(function() {
		//Mặc đinh ẩn form
		$("#formthem").hide();

		//Hien thị form khi ấn thêm mới
		$("#buttonthem").click(function() {
			$("#formthem").toggle(1000); //toggle nếu ẩn là sẽ hiện và ngược lại
			$("#buttonthem").hide();
		});
	});
</script>
<div style="margin-top: 400px">
	<?php require "../include_ad/footer.php" ?>
</div>

</html>