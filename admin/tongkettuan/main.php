<!DOCTYPE html>
<html lang="en">

<head>
    <?php require("../include_ad/head.php");
    if (isset($_SESSION["nguoidung"]) && $_SESSION["nguoidung"]["loai"] == 1) {
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
                if ( isset($_SESSION["nguoidung"]) && $_SESSION["nguoidung"]["loai"] == 1) {
                    require("../leftlayout_ad/menuleft.php");
                }
                ?>
            </div>
            <div class="col-sm-10">
                <div class="col-sm-12 text-center">
                    <h5 class="card-header">TỔNG KẾT TUẦN</h5>
                    <form method="post">
                        <div class="mb-1">
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
                            <label>Tuần</label>
                            <input type="number" id="tuan" name="txttuan" value="<?php echo $txttuan ?>" min="1" step="1" required />
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
                            <div>
                            <input type="submit" class="btn btn-success" name="btnXacNhan" value="Tìm kiếm" />
                            <input type="hidden" name="action" value="danhsachthiduatuan">
                            </div>
                            
                        </div>
                    </form>
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
                    <div class="row">
                        <div class="col-sm-2">
                            <a class="btn btn-success" href="index.php?action=themtongkettuan">Thêm mới</a>
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-success" id="btnXuat">Xuất File Excel</button>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-hover" id="xuatexcel">
                            <thead>
                                <tr class="thead-dark">
                                    <th scope="col">STT</th>
                                    <th scope="col">Lớp</th>
                                    <th scope="col">Tổng SĐB</th>
                                    <th scope="col">Tổng trừ</th>
                                    <th scope="col">Tổng điểm</th>
                                    <th scope="col">Số tiết</th>
                                    <th scope="col">Trung bình</th>
                                    <th scope="col">Hạng</th>
                                    <th scope="col" class="noExl">Sửa</th>
							        <th scope="col" class="noExl">Xóa</th>
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
                                                <td><a class="btn btn-warning" href="index.php?action=sua&id=<?php echo $x["id"] ?>"><i class="far fa-edit"></i></a></td>
                                                <td><a class="btn btn-danger" href="index.php?action=xoa&id=<?php echo $x["id"] ?>" onclick="return confirm('Bạn có chắc muốn xóa Tổng kết tuần của lớp <?php echo $lk['lop']   ?> ?')"><i class="far fa-trash-alt"></i></a></td>
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
            </div>
        </div>
    </div>
</body>
<script>   
    $("#btnXuat").click(function() {
        var e=document.getElementById("selectkhoi");
        var khoi=e.options[e.selectedIndex].text;
        var file="Tong_Ket_Tuan<?php echo $txttuan?>_Khoi";
        $("#xuatexcel").table2excel({
            exclude: ".noExl",
            name: "Worksheet Name",
            filename: file+khoi,
            fileext: ".xlsx"
        })
    });
</script>
<div  style="margin-top: 400px">
<?php require "../include_ad/footer.php" ?>
</div>


</html>