<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "../include_ad/head.php" ;
    require "../include_ad/nav.php" ;?>

    <style type="text/css">
            select{
				width:100px;
				height: 30px;
				margin-left: 1rem;
            }
			#selectkhoi{
				margin-left: 50px;
			}
			#selectlop{
				margin-left: 56px;
			}
    </style>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3">
				<?php require "../leftlayout_ad/menuleft.php" ?>
			</div>
			<div class="col-sm-8 text-center">
				<h5 class="card-header">DANH SÁCH HỌC SINH</h5>
				<?php
				if (isset($selectkhoi) && $selectkhoi != 0) {

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
								<label>Khối</label>
								<select name="selectkhoi" id="selectkhoi" class="combobox" onchange="autoclick();" style="width: 100px;">
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
							<input type="submit" class="btn btn-success" name="submit" id="btnTuan" value="Xác nhận">
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
							<input type="submit" class="btn btn-success" name="submit" id="btnTuan" value="Xác nhận">
							<input type="hidden" name="action" value="xacnhan">
						</form>
					</div>
				<?php
				}
				?>

				<?php
				if ($selectlop != 0) {
				?>
				<div class="modal fade" id="import" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Import file</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
					<form method="post" enctype="multipart/form-data" class="mt-3" id="myform">
						<input type="file" name="file" id="file" accept=".xlsx, .xls">
						<input type="text" name="idnamhoc" value="<?php echo $selectnamhoc ?>" hidden>
						<input type="text" name="idlop" value="<?php echo $selectlop ?>" hidden>
						<input type="text" name="idkhoi" value="<?php echo $selectkhoi ?>" hidden>
						<input type="button" class="btn btn-primary" onclick="submitForm()" value="Import" />
						<input type="hidden" name="action" value="importfile">
						<div class="alert alert-danger" id="hienthi">
							<input id="thongbao" class="text-danger form-control text-center" value="<?php echo $thongbao ?>" hidden>
							<a href="#" id="thongbao" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Vui lòng chọn file</strong><p id="noidung"></p>
						</div>
					</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
					</div>
					</div>
				</div>
				</div>
					<div class="row mt-3">
						<div class="col-sm-2">
							<form action="index.php?action=themhocsinh" method="post">
								<input type="text" name="namhoc" value="<?php echo $selectnamhoc ?>" hidden>
								<input type="text" name="khoi" value="<?php echo $selectkhoi ?>" hidden>
								<input type="text" name="lop" value="<?php echo $selectlop ?>" hidden>
								<button type="submit" class="btn btn-success">Thêm mới</button>
							</form>
							
						</div>
						<div class="col-sm-2">
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#import">Import file</button>
						</div>
						<div class="col-sm-2">
						<button class="btn btn-success" id="btnXuat">Xuất File</button>
						</div>
						
					</div>
				<?php
				}
				?>
				<div class="card-body">
					<table class="table table-hover" id="table2excel">
						<thead>
							<tr hidden>
								<th scope="col"></th>
								<th scope="col"></th>
								<?php
								foreach ($lop as $l) :
									if ($selectlop == $l["id"]) {
								?>
										<th scope="col" span="6">Danh sách học sinh lớp: <?php echo $l["lop"]; ?>

									<?php
									}
								endforeach;
									?>
										</th>
										<th scope="col"></th>
										<th scope="col"></th>
										<th scope="col"></th>
							</tr>
							<tr class="thead-dark">
								<th scope="col">STT</th>
								<th scope="col">Họ</th>
								<th scope="col">Tên</th>
								<th scope="col">Giới tính</th>
								<th scope="col">Ngày sinh</th>
								<th scope="col" class="noExl">Sửa</th>
								<th scope="col" class="noExl">Xóa</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$stt = 1;
							foreach ($hocsinh as $h) :
							?>
								<tr>
									<th scope="row"><?php echo $stt; ?></th>
									<td><?php echo $h["ho"]; ?></td>
									<td><?php echo $h["ten"]; ?></td>
									<td><?php echo $h["gioitinh"]; ?> </td>
									<?php
									$source = $h["ngaysinh"];
									$date = new DateTime($source);
									?>
									<td><?php echo $date->format('d/m/Y'); ?></td>
									<td class="noExl"><a class="btn btn-warning" href="index.php?action=suahocsinh&id=<?php echo $h["id"]; ?>"><i class="far fa-edit"></i></a></td>
									<td class="noExl"><a class="btn btn-danger" href="index.php?action=xoahocsinh&id=<?php echo $h["id"]; ?>" onclick="return confirm('Bạn có chắc muốn xóa Học sinh: <?php echo $h['ho'] . ' ' . $h['ten']  ?> ?')"><i class="far fa-trash-alt"></i></a></td>
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
	</div>
	<script>
		var e1 = document.getElementById("selectlop");
		var lop = e1.options[e1.selectedIndex].text;
		$("#btnXuat").click(function() {
			$("#table2excel").table2excel({
				exclude: ".noExl",
				name: "Worksheet Name",
				filename: "DS_" + lop,
				fileext: ".xlsx"
			})
		});
	</script>
	<script>
		$(document).ready(function() {

			if (document.getElementById("thongbao").value == '') {
				$("#hienthi").hide();
			} else {
				$("#hienthi").show();
			}
		});
		function submitForm() {
			if( document.getElementById("file").files.length == 0 ){
      			document.getElementById('hienthi').style.display = 'block';
			}		
			 else {
      		document.getElementById('myform').submit();
      		document.getElementById('hienthi').style.display = 'none';
    		}
  		}
	</script>
</body>
<div style="margin-top: 400px">
	<?php include "../include_ad/footer.php"; ?>
</div>

</html>