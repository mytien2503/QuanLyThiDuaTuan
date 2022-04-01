<!DOCTYPE html>
<html lang="en">

<head>
	<?php require("../include_ad/head.php");
	if ($_SESSION["nguoidung"]["loai"] == 1) {
		require("../include_ad/nav.php");
	} else {
		require("../../include/nav.php");
	}
	?>
	<style type="text/css">
		select,#tuan {
			width: 100px;
			height: 30px;
			margin-left: 1rem;
		}

		#selectkhoi {
			margin-left: 50px;
		}

		#tuan {
			margin-left: 48px;
		}

		#selectlop {
			margin-left: 56px;
		}
	</style>
</head>

<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2">
				<?php
				if ($_SESSION["nguoidung"]["loai"] == 1) {
					require "../leftlayout_ad/menuleft.php";
				} ?>
			</div>
			<div class="col-sm-10">
				<h4 class="card-header text-center">TRỰC TUẦN</h4>
				<div class="row">
					<div class="col-sm-4"></div>
					<div class="col-sm-4 text-center">
						<?php
						if (isset($txttuan) && isset($selectkhoi) && isset($selectlop) && $selectlop != 0) {
						?>
							<div>
								<form method="post">
									<div class="mb-1">
										<label class="text-left">Năm học</label>
										<select name="selectnamhoc" id="select2" class="combobox">
											<?php
											foreach ($dsnamhoc as $n) :
												if ($n["id"] == $selectnamhoc) {

											?>
													<option value="<?php echo $n["id"]; ?>" selected="selected"><?php echo $n["namhoc"]; ?></option>
												<?php
												} else {
												?>
													<option value="<?php echo $n["id"]; ?>"><?php echo $n["namhoc"]; ?></option>
											<?php
												}
											endforeach;
											?>
										</select>
									</div>
									<div class="mb-1">
										<label class="text-left">Tuần</label>
										<input type="number" id="tuan" name="txttuan" value="<?php echo $txttuan ?>" min="1" step="1" required />
									</div>
									<div class="mb-1">
										<label>Khối</label>
										<select name="selectkhoi" id="selectkhoi" class="combobox" onchange="autoclick();">
											<?php
											foreach ($khoi as $k) :
												if ($selectkhoi == $k["id"]) {
											?>
													<option value="<?php echo $k["id"]; ?>" selected="selected"><?php echo $k["khoi"]; ?></option>
												<?php
												} else{
												?>
												<option value="<?php echo $k["id"]; ?>"><?php echo $k["khoi"]; ?></option>
											<?php
											}
											endforeach;
											?>
										</select>
									</div>
									<div class="mb-1">
										<label>Lớp</label>
										<select name="selectlop" id="selectlop" class="combobox">
											<?php
											foreach ($lop as $l) :
												if ($l["id"] == $selectlop) {
											?>
													<option value="<?php echo $l["id"]; ?>" selected="selected"><?php echo $l["lop"]; ?></option>
												<?php
												} else {
												?>
													<option value="<?php echo $l["id"]; ?>"><?php echo $l["lop"]; ?></option>
											<?php
												}
											endforeach;
											?>
										</select>
									</div>
									<input type="submit" class="btn btn-success" name="submit" id="btnXacnhan" value="Xác nhận">
									<input type="hidden" name="action" value="xacnhan">
								</form>
							</div>
						<?php
						} else if (isset($txttuan) && isset($selectkhoi)) {
						?>
							<div>
								<form method="post">
									<div class="mb-1">
										<label>Năm học</label>
										<select name="selectnamhoc" id="select2" class="combobox">
											<?php
											foreach ($dsnamhoc as $n) :
												if ($n["id"] == $selectnamhoc) {

											?>
													<option value="<?php echo $n["id"]; ?>" selected="selected"><?php echo $n["namhoc"]; ?></option>
												<?php
												} else {
												?>
													<option value="<?php echo $n["id"]; ?>"><?php echo $n["namhoc"]; ?></option>
											<?php
												}
											endforeach;
											?>
										</select>
									</div>
									<div class="mb-1">
										<label>Tuần</label>
										<input type="number" id="tuan" name="txttuan" value="<?php echo $txttuan ?>" min="1 >" step="1" required />
									</div>
									<div class="mb-1">
										<label>Khối</label>
										<select name="selectkhoi" id="selectkhoi" class="combobox" onchange="autoclick();">
											<?php
											foreach ($khoi as $k) :
												if ($selectkhoi == $k["id"]) {
											?>
													<option value="<?php echo $k["id"]; ?>" selected="selected"><?php echo $k["khoi"]; ?></option>
												<?php
												} else{
												?>
												<option value="<?php echo $k["id"]; ?>"><?php echo $k["khoi"]; ?></option>
											<?php
											}
											endforeach;
											?>
										</select>
									</div>
									<div class="mb-1">
										<label>Lớp</label>
										<select name="selectlop" id="selectlop" class="combobox">
											<?php
											foreach ($lop as $l) :
												if ($l["id"] == $selectlop) {
											?>
													<option value="<?php echo $l["id"]; ?>" selected="selected"><?php echo $l["lop"]; ?></option>
												<?php
												} else {
												?>
													<option value="<?php echo $l["id"]; ?>"><?php echo $l["lop"]; ?></option>
											<?php
												}
											endforeach;
											?>
										</select>
									</div>
									<input type="submit" class="btn btn-success" name="submit" id="btnXacnhan" value="Xác nhận">
									<input type="hidden" name="action" value="xacnhan">
								</form>
							</div>
						<?php
						} else {
						?>
							<div>
								<form method="post">
									<div class="mb-1">
										<label>Năm học</label>
										<select name="selectnamhoc" id="select2" class="combobox">
											<?php
											foreach ($dsnamhoc as $n) :
												if ($n["id"] == $namcuoi["max(id)"]) {

											?>
													<option value="<?php echo $n["id"]; ?>" selected="selected"><?php echo $n["namhoc"]; ?></option>
												<?php
												} else {
												?>
													<option value="<?php echo $n["id"]; ?>"><?php echo $n["namhoc"]; ?></option>
											<?php
												}
											endforeach;
											?>
										</select>
									</div>
									<div class="mb-1">
										<label>Tuần</label> <input type="number" id="tuan" name="txttuan" value="<?php echo $txttuan ?>" min="1" step="1" required />
									</div>
									<div class="mb-1">
										<label>Khối</label>
										<select name="selectkhoi" id="selectkhoi" class="combobox">
											<?php
											foreach ($khoi as $k) :
												if ($selectkhoi == $k["id"]) {
											?>
													<option value="<?php echo $k["id"]; ?>" selected="selected"><?php echo $k["khoi"]; ?></option>
												<?php
												} else{
												?>
												<option value="<?php echo $k["id"]; ?>"><?php echo $k["khoi"]; ?></option>
											<?php
											}
											endforeach;
											?>
										</select>
									</div>
									<input type="submit" class="btn btn-success" name="submit" id="btnXacnhan" value="Xác nhận">
									<input type="hidden" name="action" value="xacnhan">
								</form>
							</div>
						<?php
						}
						?>
					</div>
				</div>
				<?php
				if ($thongbao != '') {
				?>
					<div class="alert alert-danger" id="hienthi">
						<input id="thongbao" class="text-danger form-control text-center" value="<?php echo $thongbao ?>" hidden>
						<a href="#" id="thongbao" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Thông báo!</strong><?php echo $thongbao ?>
					</div>
				<?php
				}
				?>
				<?php
				if (isset($txttuan) && isset($selectkhoi) && isset($selectlop) && $selectlop != 0 && $thongbao != 'Năm học ' . $laynamhoctheoid['namhoc'] . ' chỉ có ' . $tuanmax . ' tuần') {
				?>
					<div class="row ">
						<div class="col-sm-2">
							<form method="post">
								<input type="text" name="namhoc" value="<?php echo $selectnamhoc ?>" hidden>
								<input type="text" name="lop" value="<?php echo $selectlop ?>" hidden>
								<input type="text" name="tuan" value="<?php echo $txttuan ?>" hidden>
								<input type="submit" class="btn btn-success" value="Thêm">
								<input type="hidden" name="action" value="themtructuan">
							</form>
							
						</div>
						<div  class="col-sm-2">
							<button class="btn btn-success" id="btnXuat">Xuất File Excel</button>
						</div>
					</div>
				<?php
				}
				?>
				<div class="card-body">
					<table class="table table-bordered" id="excel">
						<thead class="thead-dark">
							<tr>
								<th scope="col" >STT</th>
								<th scope="col">Họ và tên</th>
								<th scope="col">Vi Phạm</th>
								<th scope="col">Tổng số lần</th>
								<th scope="col">Điểm Trừ</th>
								<th scope="col" class="noExl">Sửa</th>
								<th scope="col" class="noExl">Xóa</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$stt = 1;					
							$hocsinh_id1 = "";
							$hocsinh_id2 = "";
							foreach ($tructuan as $t) :
								foreach ($counthocsinh as $count) :
									if ($t["hocsinh_id"] == $count["hocsinh_id"]) {
										if ($t["hocsinh_id"] != $hocsinh_id2) {
							?>
											<tr>
												<th scope="row" style="vertical-align: middle;" rowspan="<?php echo $count["count(hocsinh_id)"] ?>"><?php echo $stt; ?></th>
												<td rowspan="<?php echo $count["count(hocsinh_id)"] ?>" style="vertical-align: middle;"><?php echo $t["ho"] . " " . $t["ten"]; ?> </td>
												<td><?php echo $t["vipham"]; ?></td>
												<td><?php echo $t["solan"]; ?></td>
												<td><?php echo $t["tongdiemtru"]; ?></td>
												<td><a  class="btn btn-warning noExl" href="index.php?action=sua&id=<?php echo $t["id"] ?>"><i class="far fa-edit"></i></a></td>
												<td><a class="btn btn-danger noExl" href="index.php?action=xoa&id=<?php echo $t["id"] ?>" onclick="return confirm('Bạn có chắc muốn xóa Vi phạm: <?php echo $t['vipham']; ?> của Học sinh: <?php echo $t['ho'] . ' ' . $t['ten'] ?> ?')"><i class="far fa-trash-alt"></i></a></td>

											</tr>
										<?php
										$tt=0;
										} else {
											$tt=1;
										?>
											<tr>
												<td hidden></td>
												<td hidden></td>
												<td><?php echo $t["vipham"]; ?></td>
												<td><?php echo $t["solan"]; ?></td>
												<td><?php echo $t["tongdiemtru"]; ?></td>
												<td><a class="btn btn-warning noExl" href="index.php?action=sua&id=<?php echo $t["id"] ?>"><i class="far fa-edit"></i></a></td>
												<td><a class="btn btn-danger noExl" href="index.php?action=xoa&id=<?php echo $t["id"] ?>" onclick="return confirm('Bạn có chắc muốn xóa Vi phạm: <?php echo $t['vipham']; ?> của Học sinh: <?php echo $t['ho'] . ' ' . $t['ten'] ?> ?')"><i class="far fa-trash-alt"></i></a>
												</td>
											</tr>
							<?php
										}
									}
								endforeach;
								$hocsinh_id2 = $t["hocsinh_id"];
								if($tt==0){
									$stt++;
								}
								
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
	$("#btnXuat").click(function() {
		var e1 = document.getElementById("selectlop");
		var lop = e1.options[e1.selectedIndex].text;

		var file = "Truc_Tuan<?php echo $txttuan ?>";
		$("#excel").table2excel({
			exclude: ".noExl",
			name: "Worksheet Name",
			filename: file + "_Lop" + lop,
			fileext: ".xlsx"
		})
	});
	if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
<div style="margin-top: 400px">
	<?php require "../../include/footer.php" ?>

</div>

</html>