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
					<div class="col-sm-6">
						<form class="form-inline mb-3" method="POST" id="formthem">
							<input type="number" class="form-control" name="txtkhoi" min="1" max="12" step="1" placeholder="Nhập khối" style="width:200px;" required>
							<input type="submit" class="btn btn-warning ml-3" value="Thêm" id="btnthemkhoi">
							<input type="hidden" name="action" value="xulythemkhoi">

						</form>
					</div>
					<div class="col-sm-2"></div>
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
					<table class="table table-hover" id="bangkhoi">
						<thead>
							<tr class="thead-dark">
								<th scope="col">STT</th>
								<th scope="col">Khối</th>
								<th scope="col">Sửa</th>
								<th scope="col">Xóa</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$stt = 1;
							foreach ($khoi as $k) :
								if ($k["id"] == $idsua) {
							?>
									<form method="post">
										<tr>
											<td><?php echo $stt ?></td>
											<td width="80%"><input class="alert alert-primary" role="alert" name="txtten" type="number" step="1" min="1" max="12" class="form-control" value="<?php echo $k["khoi"] ?>" required></td>
											<td>
												<input type="hidden" name="txtid" value="<?php echo $k["id"]; ?>">
												<a class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">Cập nhật</a>

												<input type="hidden" name="action" value="xulysuakhoi">

												<!-- hỏi -->
												<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
													<div class="modal-dialog" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="exampleModalLabel">Cảnh báo</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<div class="modal-body">
																Bạn có chắc muốn thay đổi?
															</div>
															<div class="modal-footer">
																<input class="btn btn-warning" type="submit" value="Cập nhật">
																<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
															</div>
														</div>
													</div>
												</div>
											</td>
											<td> <a class="text-danger" href="" data-toggle="modal" data-target="#exampleModal2"><i class="far fa-trash-alt"></i></a>
											</td>
										</tr>
									</form>
								<?php
								} else {
								?>
									<tr>
										<td><?php echo $stt ?></td>
										<td><?php echo $k["khoi"] ?></td>
										<td><a class="btn btn-warning" href="index.php?action=suakhoi&id=<?php echo $k["id"]; ?>"><i class="far fa-edit"></i></a></td>
										<td><a class="btn btn-danger" href="index.php?action=xoakhoi&id=<?php echo $k["id"]; ?>" onclick="return confirm('Bạn có chắc muốn xóa Khối <?php echo $k['khoi']   ?> ?')"><i class="far fa-trash-alt"></i></a></td>
									</tr>
							<?php

								}
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