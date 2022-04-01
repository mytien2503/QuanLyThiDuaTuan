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
					<div class="col-sm-4"></div>
					<div class="col-sm-4">
						<form class="form-group mb-3" method="POST" id="formthem">
							<label>Năm học</label>
							<input type="number" class="form-control mb-3" name="txtnamhoc1" id="txtnamhoc1" min="1" placeholder="Năm bắt đầu" required>
							<input type="number" class="form-control mb-3" name="txtnamhoc2" id="txtnamhoc2" min="1" placeholder="Năm kết thúc" required>
							<label>Tổng tuần</label>
							<input name="txttuan" type="number" class="form-control " step="1" min="1" max="50" required>
							<input type="submit" class="btn btn-warning form-control  mt-3" value="Thêm" id="btnthemnamhoc">
							<input type="hidden" name="action" value="xulythemnamhoc">


						</form>
					</div>
					<div class="col-sm-4"></div>
				</div>
				<!-- Form sua -->
				<?php if(isset($idsua) && $idsua!=0){
				?>
				<div class="row">
					<div class="col-sm-4"></div>
					<div class="col-sm-4">
						<form class="form-group mb-3" method="POST">
							<label>Năm học</label>
							<input name="txtnam1" type="number" class="form-control mb-3" min="1" value="<?php echo $nam1?>" required>
							<input name="txtnam2" type="number" class="form-control" min="1" value="<?php echo $nam2?>" required>
							<input hidden name="txtid" type="number" value="<?php echo $namhienhanh["id"]?>">
							<label>Tổng tuần</label>
							<input name="txttuan" type="number" class="form-control" step="1" min="1" max="50" value="<?php echo $tongmax?>" required>
							<input type="submit" class="btn btn-warning form-control  mt-3" value="Cập nhật năm học">
							<input type="hidden" name="action" value="xulysuanamhoc">
						</form>
					</div>
					<div class="col-sm-4"></div>
				</div>
				<?php }?>
				<!-- Kết thúc form sửa -->

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
					<!--id="bangnamhoc" -->
					<table class="table table-hover" id="table2excel">
						<thead>
							<tr class="thead-dark">
								<th scope="col">STT</th>
								<th scope="col">Năm Học</th>
								<th scope="col">Tổng tuần</th>
								<th scope="col">Sửa</th>
								<th scope="col">Xóa</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$stt = 1;
							foreach ($namhoc as $n) :
								$tongtuan = $t->laytuanminmax($n["id"]);
								?>
									<tr>
										<td><?php echo $stt ?></td>
										<td><?php echo $n["namhoc"] ?></td>
										<?php
										if ($tongtuan["max(tuan)"] != 0) {
										?>
											<td><?php echo $tongtuan["max(tuan)"] ?></td>
										<?php
										} else {
										?>
											<td><?php echo '0' ?></td>
										<?php
										}
										?>
										<td><a class="btn btn-warning" href="index.php?action=suanamhoc&id=<?php echo $n["id"]; ?>"><i class="far fa-edit"></i></a></td>
										<td><a class="btn btn-danger" href="index.php?action=xoanamhoc&id=<?php echo $n["id"]; ?>" onclick="return confirm('Bạn có chắc muốn xóa Năm học <?php echo $n['namhoc']   ?> ?')"><i class="far fa-trash-alt"></i></a></td>
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