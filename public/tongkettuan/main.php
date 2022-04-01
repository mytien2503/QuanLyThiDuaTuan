<!DOCTYPE html>
<html lang="en">

<head>
<?php require ("../../include/head.php");
require("../../include/nav.php");
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
            <div class="col-sm-1"></div>
            <div class="col-sm-10 text-center">
                <h5 class="card-header">TỔNG KẾT TUẦN</h5>
                <form method="post">
                    <div>
                        <label>Năm học</label>
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
                        <lable>Tuần </lable>
                        <input type="number" id="tuan" name="txttuan" value="<?php echo $txttuan ?>" max="<?php echo $tuanmax ?>" min="<?php echo $tuanmin ?>" step="1" required />
                    </div>
                    <div class="mb-1">
                        <label>Khối</label>
                        <select name="selectkhoi" id="selectkhoi" class="combobox">
                            <?php
                            foreach ($khoi as $k) :
                                if ($k["id"] == $selectkhoi) {
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
                    </div>
                    <div class="mb-1">
                        <input type="submit" class="btn btn-success" name="btnXacNhan" value="Tìm kiếm" />
                        <input type="hidden" name="action" value="danhsachthiduatuan">
                    </div>
                </form>
                <div class="alert alert-danger" id="hienthi">
                    <input id="thongbao" class="text-danger form-control text-center" value="<?php echo $thongbao ?>" hidden>
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
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
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr class="thead-dark">
                                <th scope="col">STT</th>
                                <th scope="col">Lớp</th>
                                <th scope="col">Tổng điểm SĐB</th>
                                <th scope="col">Tổng điểm trừ</th>
                                <th scope="col">Tổng điểm đạt được</th>
                                <th scope="col">Tổng số tiết</th>
                                <th scope="col">Điểm trung bình</th>
                                <th scope="col">Hạng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stt = 1;
                            foreach ($xephang as $x) :
                                foreach ($loptheokhoi as $lk) :
                                    if ($lk["id"] == $x["lop_id"]) {
                                        $lop = $lp->layloptheoid($x["lop_id"]);
                            ?>
                                        <tr>
                                            <th scope="row"><?php echo $stt; ?></th>
                                            <td><?php echo $lop["lop"]; ?></td>
                                            <td><?php echo $x["diemSDB"]; ?></td>
                                            <td><?php echo $x["tongdiemtru"]; ?></td>
                                            <td><?php echo $x["diemdatduoc"]; ?></td>
                                            <td><?php echo $x["sotiet"]; ?></td>
                                            <td><?php echo $x["trungbinh"]; ?></td>
                                            <td><?php echo $x["hang"]; ?></td>
                                        </tr>
                            <?php
                                    }
                                endforeach;
                                $stt++;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
                
            </div>
            <div class="col-sm-1"></div>
        </div>
    </div>
</body>
<?php require "../../include/footer.php" ?>

</html>