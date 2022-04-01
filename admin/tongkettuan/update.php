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
        select,
        #tuan {
            width: 100px;
            height: 30px;
            margin-left: 1rem;
        }

        #selectkhoi {
            margin-left: 52px;
        }

        #tuan {
            margin-left: 50px;
        }

        #selectlop {
            margin-left: 58px;
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
                <h5 class="card-header">SỬA TỔNG KẾT TUẦN</h5>
                <div class="mb-1">
                    Năm học:
                    <select name="selectnamhoc" id="select2" class="combobox">
                        <?php
                        foreach ($dsnamhoc as $n) :
                            if ($n["id"] == $selectnamhoc) {


                        ?>
                                <option value="<?php echo $n["id"]; ?>" selected="selected"><?php echo $n["namhoc"]; ?></option>
                        <?php
                            }
                        endforeach;
                        ?>
                    </select>
                    <div class=" mt-1 mb-1">
                        Tuần <input type="text" id="tuan" name="txttuan" value="<?php echo $txttuan ?>" required readonly /></tr>
                    </div>
                    <div class="mb-1">
                        Khối
                        <select name="selectkhoi" id="selectkhoi" class="combobox">
                            <?php
                            foreach ($khoi as $k) :
                                if ($selectkhoi == $k["id"]) {
                            ?>
                                    <option value="<?php echo $k["id"]; ?>" selected="selected"><?php echo $k["khoi"]; ?></option>
                            <?php
                                }
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="mb-1">
                        Lớp
                        <select name="selectlop" id="selectlop" class="combobox">
                            <?php
                            foreach ($lop as $l) :
                                if ($l["id"] == $selectlop) {
                            ?>
                                    <option value="<?php echo $l["id"]; ?>" selected="selected"><?php echo $l["lop"]; ?></option>
                            <?php
                                }
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>
                <script>
                    function DiemSDB() {
                        if (f.txtSDB2.value != null && f.txtSDB2.value != "" && f.txtSDB2.value != " ") {
                            var t2 = parseFloat(f.txtSDB2.value);
                        } else {
                            var t2 = 0;
                        }
                        if (f.txtSDB3.value != null && f.txtSDB3.value != "" && f.txtSDB3.value != " ") {
                            var t3 = parseFloat(f.txtSDB3.value);
                        } else {
                            var t3 = 0;
                        }
                        if (f.txtSDB4.value != null && f.txtSDB4.value != "" && f.txtSDB4.value != " ") {
                            var t4 = parseFloat(f.txtSDB4.value);
                        } else {
                            var t4 = 0;
                        }
                        if (f.txtSDB5.value != null && f.txtSDB5.value != "" && f.txtSDB5.value != " ") {
                            var t5 = parseFloat(f.txtSDB5.value);
                        } else {
                            var t5 = 0;
                        }
                        if (f.txtSDB6.value != null && f.txtSDB6.value != "" && f.txtSDB6.value != " ") {
                            var t6 = parseFloat(f.txtSDB6.value);
                        } else {
                            var t6 = 0;
                        }
                        if (f.txtSDB7.value != null && f.txtSDB7.value != "" && f.txtSDB7.value != " ") {
                            var t7 = parseFloat(f.txtSDB7.value);
                        } else {
                            var t7 = 0;
                        }
                        var diemSDB = t2 + t3 + t4 + t5 + t6 + t7;

                        f.txtDSDB.value = diemSDB;
                        DiemDatDuoc();
                        DiemTB();
                    }

                    function DiemDatDuoc() {
                        f.txtDiemDatDuoc.value = parseFloat(f.txtDSDB.value) - parseFloat(f.txtDiemTru.value);

                    }
                    var diemtt = 0;

                    function DiemTB() {
                        f.txtTrungBinh.value = parseFloat(f.txtDiemDatDuoc.value) / parseFloat(f.txtSoTiet.value);

                    }
                </script>

                <div>
                    <form name="f" method="POST">
                        <div class="form-row">
                            <div class="col">
                                <label for="txtDSDB">Thứ 2</label>
                                <input type="number" class="form-control" name="txtSDB2" onchange="DiemSDB();" id="txtSDB2" value="<?php echo $xephanghientai["thu2"] ?>" step="0.05">
                            </div>
                            <div class="col">
                                <label for="txtDSDB">Thứ 3</label>
                                <input type="number" class="form-control" name="txtSDB3" onchange="DiemSDB();" id="txtSDB3" value="<?php echo $xephanghientai["thu3"] ?>" step="0.05">
                            </div>
                            <div class="col">
                                <label for="txtDSDB">Thứ 4</label>
                                <input type="number" class="form-control" name="txtSDB4" onchange="DiemSDB();" id="txtSDB4" value="<?php echo $xephanghientai["thu4"] ?>" step="0.05">
                            </div>
                            <div class="col">
                                <label for="txtDSDB">Thứ 5</label>
                                <input type="number" class="form-control" name="txtSDB5" onchange="DiemSDB();" id="txtSDB5" value="<?php echo $xephanghientai["thu5"] ?>" step="0.05">
                            </div>
                            <div class="col">
                                <label for="txtDSDB">Thứ 6</label>
                                <input type="number" class="form-control" name="txtSDB6" onchange="DiemSDB();" id="txtSDB6" value="<?php echo $xephanghientai["thu6"] ?>" step="0.05">
                            </div>
                            <div class="col">
                                <label for="txtDSDB">Thứ 7</label>
                                <input type="number" class="form-control" name="txtSDB7" onchange="DiemSDB();" id="txtSDB7" value="<?php echo $xephanghientai["thu7"] ?>" step="0.05">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtDSDB">Tổng điểm sổ đầu bài</label>
                            <input type="number" class="form-control" name="txtDSDB" min="0.25" step="0.25" value="<?php echo $xephanghientai["diemSDB"] ?>" onchange="DiemDatDuoc(); DiemTB();" readonly>
                            <input type="text" name="txtid" value="<?php echo $xephanghientai["id"] ?>" hidden>
                            <input type="text" name="txttuan_id" value="<?php echo $xephanghientai["tuan_id"] ?>" hidden>
                            <input type="text" name="txtkhoi_id" value="<?php echo $xephanghientai["khoi_id"] ?>" hidden>
                            <input type="text" name="txtlop_id" value="<?php echo $xephanghientai["lop_id"] ?>" hidden>
                        </div>
                        <div class="form-group">
                            <label for="txtSoTiet">Tổng số tiết</label>
                            <input type="number" class="form-control" name="txtSoTiet" onchange="DiemDatDuoc(); DiemTB();" step="1" value="<?php echo $xephanghientai["sotiet"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="txtDiemTru">Tổng điểm trừ</label>
                            <input type="text" class="form-control" name="txtDiemTru" value="<?php echo $xephanghientai["tongdiemtru"]; ?>" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="txtDiemTru">Tổng điểm đạt được</label>
                            <input type="number" class="form-control" name="txtDiemDatDuoc" min="0.001" step="0.001" readonly value="<?php echo $xephanghientai["diemdatduoc"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="txtTrungBinh">Điểm trung bình</label>
                            <input type="number" class="form-control" name="txtTrungBinh" min="0.001" step="0.001" readonly value="<?php echo $xephanghientai["trungbinh"] ?>">
                        </div>

                        <input type="hidden" name="action" value="xylysuatongkettuan">
                        <button type="submit" class="btn btn-primary" id="them">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<?php require "../include_ad/footer.php" ?>

</html>