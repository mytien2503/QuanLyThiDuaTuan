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
<br>
<body>
    <div class="container-fluid">
        <div class="row">
        <div class="col-sm-3">
				<?php require "../leftlayout_ad/menuleft.php" ?>
			</div>
            <div class="col-sm-8">
                <h3 style="text-align:center;">CẬP NHẬT HỌC SINH</h3>
                <div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="text-center mb-1">
                        <label>Năm học</label>
                        <select name="selectnamhoc" id="select2" class="combobox" readonly>
                            <?php
                                foreach($dsnamhoc as $n):
                                    if($n["id"]==$selectnamhoc)
                                    {
                                
                            ?>							
                                <option value="<?php echo $n["id"];?>" selected="selected"><?php echo $n["namhoc"]; ?></option>
                            <?php
                                    }                                 
                                endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="text-center mb-1">
                        <label>Khối </label>									
                        <select name="selectkhoi" id="selectkhoi" class="combobox" readonly >
                            <?php
                                foreach($khoi as $k):
                                    if($selectkhoi==$k["id"])
                                    {
                            ?>						
                                <option value="<?php echo $k["id"];?>" selected="selected"><?php echo $k["khoi"]; ?></option>
                            <?php
                                    }												
                                endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="text-center mb-1">
                        <label>Lớp </label>	
                        <select name="selectlop" id="selectlop" class="combobox" readonly>
                            <?php
                                foreach($lop as $l):
                                    if($l["id"]==$selectlop)
                                    {												
                            ?>							
                                <option value="<?php echo $l["id"];?>" selected="selected"><?php echo $l["lop"]; ?></option>
                            <?php
                                    }
                                endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="form-line">
                        <input type="text" name="txtid" value="<?php echo $hocsinhhientai["id"] ?>" hidden>
                        <label>Họ và tên lót</label>
                        <input type="text" class="form-control" name="txtho" required value="<?php echo $hocsinhhientai["ho"] ?>">
                        <label>Tên</label>
                        <input type="text" class="form-control" name="txtten" required value="<?php echo $hocsinhhientai["ten"] ?>">
                    </div>
                    <div class="form-group">
                        <label>Giới tính: </label>
                        <?php
                            if($hocsinhhientai["gioitinh"]=="Nam")
                            {
                        ?>
                            <input type="radio" name="gioitinh" value="Nam" checked="check" class="ml-3">
                            <label for="Nam">Nam</label>
                            <input type="radio" name="gioitinh" value="Nữ" class="ml-3">
                            <label for="Nữ">Nữ</label>
                        <?php
                            }
                            else
                            {
                        ?>
                            <input type="radio" name="gioitinh" value="Nam" class="ml-3">
                            <label for="Nam">Nam</label>
                            <input type="radio" name="gioitinh" value="Nữ" checked="check" class="ml-3">
                            <label for="Nữ">Nữ</label>
                        <?php
                            }
                        ?>                     
                    </div>
                    <div class="form-group">
                        <label>Ngày sinh</label>
                        <?php
                            $source = $hocsinhhientai["ngaysinh"];
                            $date = new DateTime($source);											
                        ?>
                        <input type="date" class="form-control" name="txtngaysinh" value="<?php echo $date->format('Y-m-d')?>">
                    </div>                   
                    <input type="hidden" name="action" value="xulysuahocsinh">
                    <input type="submit" class="btn btn-primary" value="Lưu">
                </form>
            </div>
        </div>
    </div>
</body>
	<div style="margin-top: 100px">
		<?php include "../include_ad/footer.php"; ?>
	</div>
</html>