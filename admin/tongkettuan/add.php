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
             select,#tuan{
				width:100px;
				height: 30px;
				margin-left: 1rem;
            }
			#selectkhoi{
				margin-left: 50px;
			}
			#tuan{
				margin-left: 48px;
			}
			#selectlop{
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
                    require("../leftlayout_ad/menuleft.php");
                }
                ?>
			</div>
			<div class="col-sm-9 text-center">
				<h5 class="card-header">THÊM TỔNG KẾT TUẦN</h5>
				<?php
				if (isset($txttuan) && isset($selectkhoi) && isset($selectlop) && $selectlop != 0) {
				?>
					<div>
						<form method="post">
							<div class="mb-1">
								Năm học
								<select name="selectnamhoc" id="select2" class="combobox">
									<?php
									foreach ($dsnamhoc as $n) :
										if (isset($selectnamhoc) && $selectnamhoc != 0) {
											if ($n["id"] == $selectnamhoc) {
									?>
												<option value="<?php echo $n["id"]; ?>" selected="selected"><?php echo $n["namhoc"]; ?></option>
											<?php
											} else {
											?>
												<option value="<?php echo $n["id"]; ?>"><?php echo $n["namhoc"]; ?></option>
											<?php
											}
										} else {
											if ($n["id"] == $namcuoi["max(id)"]) {
											?>
												<option value="<?php echo $n["id"]; ?>" selected="selected"><?php echo $n["namhoc"]; ?></option>

											<?php
											} else {
											?>
												<option value="<?php echo $n["id"]; ?>"><?php echo $n["namhoc"]; ?></option>
									<?php
											}
										}
									endforeach;
									?>
								</select>
							</div>
							<div class="mb-1">
								Tuần <input type="number" id="tuan" name="txttuan" value="<?php echo $txttuan ?>" min="1" step="1" required />
							</div>
							<div class="mb-1">
								Khối
								<select name="selectkhoi" id="selectkhoi" class="combobox" onchange="autoclick();">
									<?php
									foreach ($khoi as $k) :
										if ($selectkhoi == $k["id"]) {
									?>
											<option value="<?php echo $k["id"]; ?>" selected="selected"><?php echo $k["khoi"]; ?></option>
										<?php
										} else
										?>
										<option value="<?php echo $k["id"]; ?>"><?php echo $k["khoi"]; ?></option>
									<?php
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
							<input type="submit" class="btn btn-success" name="submit" id="btnTuan" value="Xác nhận">
							<input type="hidden" name="action" value="xacnhan">
						</form>
					</div>
				<?php
				} else if (isset($txttuan) && isset($selectkhoi)) {

				?>
					<div>
						<form method="post">
							<div class="mb-1">
								Năm học
								<select name="selectnamhoc" id="select2" class="combobox">
									<?php
									foreach ($dsnamhoc as $n) :
										if (isset($selectnamhoc) && $selectnamhoc != 0) {
											if ($n["id"] == $selectnamhoc) {


									?>
												<option value="<?php echo $n["id"]; ?>" selected="selected"><?php echo $n["namhoc"]; ?></option>
											<?php
											} else {
											?>
												<option value="<?php echo $n["id"]; ?>"><?php echo $n["namhoc"]; ?></option>
											<?php
											}
										} else {
											if ($n["id"] == $namcuoi["max(id)"]) {
											?>
												<option value="<?php echo $n["id"]; ?>" selected="selected"><?php echo $n["namhoc"]; ?></option>

											<?php
											} else {
											?>
												<option value="<?php echo $n["id"]; ?>"><?php echo $n["namhoc"]; ?></option>
									<?php
											}
										}
									endforeach;
									?>
								</select>
							</div>
							<div class="mb-1">
								Tuần <input type="number" id="tuan" name="txttuan" value="<?php echo $txttuan ?>" min="1" step="1" required />
							</div>
							<div class="mb-1">
								Khối
								<select name="selectkhoi" id="selectkhoi" class="combobox" onchange="autoclick();">
									<?php
									foreach ($khoi as $k) :
										if ($selectkhoi == $k["id"]) {
									?>
											<option value="<?php echo $k["id"]; ?>" selected="selected"><?php echo $k["khoi"]; ?></option>
										<?php
										} else
										?>
										<option value="<?php echo $k["id"]; ?>"><?php echo $k["khoi"]; ?></option>
									<?php
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
							<input type="submit" class="btn btn-success" name="submit" id="btnTuan" value="Xác nhận">
							<input type="hidden" name="action" value="xacnhan">
						</form>
					</div>
				<?php
				} else {

				?>
					<div>
						<form method="post" class="text-center">
							<div class="mb-1">
								Năm học
								<select name="selectnamhoc" id="select2" class="combobox">
									<?php
									foreach ($dsnamhoc as $n) :
										if (isset($selectnamhoc) && $selectnamhoc != 0) {
											if ($n["id"] == $selectnamhoc) {


									?>
												<option value="<?php echo $n["id"]; ?>" selected="selected"><?php echo $n["namhoc"]; ?></option>
											<?php
											} else {
											?>
												<option value="<?php echo $n["id"]; ?>"><?php echo $n["namhoc"]; ?></option>
											<?php
											}
										} else {
											if ($n["id"] == $namcuoi["max(id)"]) {
											?>
												<option value="<?php echo $n["id"]; ?>" selected="selected"><?php echo $n["namhoc"]; ?></option>

											<?php
											} else {
											?>
												<option value="<?php echo $n["id"]; ?>"><?php echo $n["namhoc"]; ?></option>
									<?php
											}
										}
									endforeach;
									?>
								</select>
							</div>
							<div class="mb-1">
								Tuần <input type="number" id="tuan" name="txttuan" value="<?php echo $txttuan ?>" min="1" step="1" required />
							</div>
							<div class="mb-1">
								Khối
								<select name="selectkhoi" id="selectkhoi" class="combobox">
									<?php
									foreach ($khoi as $k) :
										if ($_POST["selectkhoi"] == $k["id"]) {
									?>
											<option value="<?php echo $k["id"]; ?>" selected="selected"><?php echo $k["khoi"]; ?></option>
										<?php
										} else
										?>
										<option value="<?php echo $k["id"]; ?>"><?php echo $k["khoi"]; ?></option>
									<?php
									endforeach;
									?>
								</select>
							</div>
							<input type="submit" class="btn btn-success" name="submit" id="btnTuan" value="Xác nhận">
							<input type="hidden" name="action" value="xacnhan">
						</form>
					</div>
				<?php
				}
				?>
				<script>
					function autoclick() {
						$('#submit').click();
					}
				</script>
				<script>
					function DiemSDB() {
						if(f.txtSDB2.value!=null && f.txtSDB2.value!="" && f.txtSDB2.value!=" ")
						{
							var t2=parseFloat(f.txtSDB2.value);
						}
						else
						{
							var t2=0;
						}
						if(f.txtSDB3.value!=null && f.txtSDB3.value!="" && f.txtSDB3.value!=" ")
						{
							var t3=parseFloat(f.txtSDB3.value);
						}
						else
						{
							var t3=0;
						}
						if(f.txtSDB4.value!=null && f.txtSDB4.value!="" && f.txtSDB4.value!=" ")
						{
							var t4=parseFloat(f.txtSDB4.value);
						}
						else
						{
							var t4=0;
						}
						if(f.txtSDB5.value!=null && f.txtSDB5.value!="" && f.txtSDB5.value!=" ")
						{
							var t5=parseFloat(f.txtSDB5.value);
						}
						else
						{
							var t5=0;
						}
						if(f.txtSDB6.value!=null && f.txtSDB6.value!="" && f.txtSDB6.value!=" ")
						{
							var t6=parseFloat(f.txtSDB6.value);
						}
						else
						{
							var t6=0;
						}
						if(f.txtSDB7.value!=null && f.txtSDB7.value!="" && f.txtSDB7.value!=" ")
						{
							var t7=parseFloat(f.txtSDB7.value);
						}
						else
						{
							var t7=0;
						}
						var diemSDB = t2+t3+t4+t5+t6+t7;

						f.txtDSDB.value = diemSDB;
						DiemDatDuoc();
						DiemTB();
					}

					function DiemDatDuoc() {
						f.txtDiemDatDuoc.value = parseInt(f.txtDSDB.value) - parseInt(f.txtDiemTru.value);

					}
					var diemtt = 0;

					function DiemTB() {
						f.txtTrungBinh.value = parseInt(f.txtDiemDatDuoc.value) / parseInt(f.txtSoTiet.value);

					}
				</script>
				<div class="row">
					<div class="col-sm-5">
					<label>Đang thêm tổng kết tuần cho lớp <?php echo $tongketlop?></label>
					</div>
				</div>
				<div>
					<form name="f" method="POST">
						<div class="alert alert-danger" id="hienthi">
							<input id="thongbao" class="text-danger form-control text-center" value="<?php echo $thongbao ?>" hidden>
							<a href="#" id="thongbao" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Thông báo!</strong> <?php echo $thongbao ?>
						</div>
						<div class="form-row">
							<div class="col">
								<label for="txtDSDB">Thứ 2</label>
								<input type="number" class="form-control" name="txtSDB2" onchange="DiemSDB();" id="txtSDB2" step="0.05">
							</div>
							<div class="col">
								<label for="txtDSDB">Thứ 3</label>
								<input type="number" class="form-control" name="txtSDB3" onchange="DiemSDB();" id="txtSDB3" step="0.05">
							</div>
							<div class="col">
								<label for="txtDSDB">Thứ 4</label>
								<input type="number" class="form-control" name="txtSDB4" onchange="DiemSDB();" id="txtSDB4" step="0.05">
							</div>
							<div class="col">
								<label for="txtDSDB">Thứ 5</label>
								<input type="number" class="form-control" name="txtSDB5" onchange="DiemSDB();" id="txtSDB5" step="0.05">
							</div>
							<div class="col">
								<label for="txtDSDB">Thứ 6</label>
								<input type="number" class="form-control" name="txtSDB6" onchange="DiemSDB();" id="txtSDB6" step="0.05">
							</div>
							<div class="col">
								<label for="txtDSDB">Thứ 7</label>
								<input type="number" class="form-control" name="txtSDB7" onchange="DiemSDB();" id="txtSDB7" step="0.05">
							</div>
						</div>
						<div class="form-group">
							<label for="txtDSDB">Tổng điểm sổ đầu bài</label>
							<input type="number" class="form-control" name="txtDSDB" id="txtDSDB" step="0.05" readonly>
						</div>
						<div class="form-group">
							<label for="txtSoTiet">Tổng số tiết</label>
							<input type="number" class="form-control" name="txtSoTiet" onchange="DiemDatDuoc(); DiemTB();" step="1">
						</div>
						<div class="form-group">
							<label for="txtDiemTru">Tổng điểm trừ</label>
							<input type="number" class="form-control" name="txtDiemTru" value="<?php echo $diemtru; ?>" readonly>
						</div>
						<div class="form-group">
							<label for="txtDiemTru">Tổng điểm đạt được</label>
							<input type="number" class="form-control" name="txtDiemDatDuoc" step="0.001" readonly>
						</div>
						<div class="form-group">
							<label for="txtTrungBinh">Điểm trung bình</label>
							<input type="number" class="form-control" name="txtTrungBinh" step="0.001" readonly>
						</div>
						<input type="text" name="txtkhoi_id" value="<?php echo $khoi_id ?>" hidden>
						<input type="text" name="txtlop_id" value="<?php echo $lop_id ?>" hidden>
						<input type="text" name="txttuan_id" value="<?php echo $tuan_id["id"] ?>" hidden>

						<input type="hidden" name="action" value="xylythemtongkettuan">
						<?php
						if ($thongbao == '' && $lop_id!=0) {
						?>
							<button type="submit" class="btn btn-primary" id="them">Thêm</button>
						<?php
						}
						?>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
<script>
	$(document).ready(function() {

		if (document.getElementById("thongbao").value == '') {
			$("#hienthi").hide();
		} else {
			$("#hienthi").show();
		}
	});
</script>
<?php require "../include_ad/footer.php" ?>

</html>