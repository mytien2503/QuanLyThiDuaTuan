<!DOCTYPE html>
<html lang="en">

<head>
    <?php require "../include_ad/head.php";
    require "../include_ad/nav.php"; ?>

    <style type="text/css">
        select,
        #tuan {
            width: 100px;
            height: 30px;
            margin-left: 1rem;
        }

        #tuan {
            margin-left: 48px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3">
                <?php require "../leftlayout_ad/menuleft.php" ?>
            </div>
            <div class="col-sm-9">
                <h5 class="card-header text-center mb-3">THỐNG KÊ VI PHẠM</h5>
                <div class="col-sm-12 text-center">
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
                            <input type="number" id="tuan" name="txttuan" id="txttuan" value="<?php echo $txttuan ?>" min="1" step="1" required />
                        </div>
                        <input type="submit" class="btn btn-success" name="btnXacNhan" value="Tìm kiếm" />
                        <input type="hidden" name="action" value="danhsachthongke">
                        <div class="alert alert-danger" id="hienthi">
                            <input id="thongbao" class="text-danger form-control text-center" value="<?php echo $thongbao??"" ?>" hidden>
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
                    </form>
                    <div class="row">
                        <div class="col-sm-2">
                            <button class="btn btn-success" id="btnXuat">Xuất File Excel</button>
                        </div>
                        <div class="col-sm-2">
                            <form action="index.php?action=bieudo" method="post">
                                <input type="text" name="txttuan" value="<?php echo $txttuan ?>" hidden>
                                <input type="text" name="selectnamhoc" value="<?php echo $selectnamhoc ?>" hidden>
                                <button class="btn btn-success" type="sumit">Biểu đồ</button>
                            </form>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-hover" id="table2excel">
                            <thead>
                                <tr class="thead-dark">
                                    <th scope="col">STT</th>
                                    <th scope="col">Vi phạm</th>
                                    <th scope="col">Tổng số lượt</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stt = 1;
                                foreach ($thongke as $t) :
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $stt; ?></th>
                                        <td><?php echo $t["vipham"]; ?></td>
                                        <td><?php echo $t["soluot"]; ?></td>
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
</body>
<script>
    var file = "Thong_Ke_Tuan<?php echo $txttuan ?>";
    $("#btnXuat").click(function() {
        $("#table2excel").table2excel({
            exclude: ".noExl",
            name: "Worksheet Name",
            filename: file,
            fileext: ".xlsx"
        })
    });
</script>
<div style="margin-top: 400px">
    <?php require "../include_ad/footer.php" ?>
</div>


</html>