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
    #selectlop,#selectkhoi,#selectnamhoc,#tuan{
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
    input[datalist]{
        width: 400px;
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
            <div class="col-sm-9 text-center">
                <h4 class="text-center">THÊM TRỰC TUẦN</h4>
                <form name="f" method="POST">
                    <div class="text-center mb-1">
                        <label>Năm học</label>
                        <select name="selectnamhoc" id="select2" class="combobox" readonly>
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
                    </div>
                    <div class="text-center mb-1">
                    <label>Tuần</label> <input type="number" id="tuan" name="txttuan" value="<?php echo $txttuan ?>" readonly /></tr>
                    </div>
                    <div class="text-center">
                        <label>Khối</label>
                        <select name="selectkhoi" id="selectkhoi" class="combobox" readonly>
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
                    <div class="text-center mb-1">
                        <label>Lớp</label>
                        <select name="selectlop" id="selectlop" class="combobox" readonly>
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
                    <div class="form-group">
                        <label for="selecthoten" style="float:left">Họ và tên</label>
                        <input type="text" class="form-control" list="hoten" name="selecthoten" autocomplete="off" require>
                        <div class="form-group">
                            <datalist id="hoten">
                                <?php
                                    foreach ($dshs as $ds) :
                                ?>
                                    <option value="<?php echo $ds['ho'].' '.$ds['ten']; ?>"></option>
                                <?php
                                    endforeach;
                                ?>
                            </datalist>
                        </div>                   
                    </div>
                    <div class="form-group">
                        <label for="selectvipham" style="float:left">Vi phạm</label>
                        <select type="text" name="selectvipham" id="selectvipham" class="form-control" aria-autocomplete="both" onchange="SoLan(); Tongtru();">
                            <?php
                            foreach ($vipham as $v) :
                            ?>
                                <option value="<?php echo $v["id"]; ?>"><?php echo $v["vipham"]; ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <!--Lấy điểm trừ -->
                    <div class="form-group" hidden>
                        <select type="text" name="selectdiemtru" id="selectdiemtru" class="form-control" aria-autocomplete="both">
                            <?php
                            foreach ($vipham as $vi) :
                            ?>
                                <option value="<?php echo $vi["id"]; ?>"><?php echo $vi["diemtru"]; ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="txtSoLan" style="float:left">Số lần</label>
                        <input type="number" class="form-control" name="txtSoLan" step="1" min="1" onchange="Tongtru();">
                    </div>
                    <script>
                        function SoLan(){
                            f.txtSoLan.value=1;
                        }
                        function Tongtru() {
                            var e1=document.getElementById("selectvipham").selectedIndex;
                            var e2 = document.getElementById("selectdiemtru");
                            var selectdiemtru = parseFloat(e2.options[e1].text);
                            if(f.txtSoLan.value!=null && f.txtSoLan.value!="" && f.txtSoLan.value!=" ")
                            {
                                var solan=parseFloat(f.txtSoLan.value);
                            }
                            else
                            {
                                var solan=0;
                            }
                            f.txtTongTru.value = parseFloat(selectdiemtru) * solan;
                        }
                    </script>
                    <div class="form-group">
                        <label for="txtTongTru" style="float:left">Tổng trừ</label>
                        <input type="number" class="form-control" name="txtTongTru" step="0.5" readonly>
                    </div>

                    <button type="submit" class="btn btn-primary text-center">Thêm</button>
                    <input type="hidden" name="action" value="xulythemtructuan">
                </form>
            </div>
        </div>
    </div>
</body>
<?php require "../../include/footer.php" ?>

</html>