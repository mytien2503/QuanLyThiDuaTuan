<!DOCTYPE html>
<html lang="en">

<head>
    <?php require "../include_ad/head.php" ?>
    <?php require "../include_ad/nav.php" ?>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3">
                <?php require "../leftlayout_ad/menuleft.php" ?>
            </div>
            <div class="col-sm-8 text-center">
                <div class="text-center">
                    <h5 class="card-header">NỘI QUY TRƯỜNG</h5>
                    <div class="row">
                        <div class="col-sm-2 mt-3">
                            <input class="btn btn-success" value="Thêm vi phạm" id="buttonthem">
                        </div>
                    </div>
                    <div class="row" id="formthem">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">
                            <form class="form-group" method="post">
                                <input type="text" class="form-control mb-3" name="txtvipham" placeholder="Nhập tên vi phạm" required>
                                <input type="number" class="form-control mb-3" name="txtdiemtru" min="0.5" step="0.5" required>
                                <input type="hidden" name="action" value="themvipham">
                                <input type="submit" class="btn btn-warning" value="Thêm vi phạm">
                            </form>
                        </div>
                        <div class="col-sm-2"></div>
                    </div>
                    <!--Form sua -->
                    <?php if(isset($idsua) && $idsua!=0){

                     ?>
                    <div class="row mt-1">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">
                            <form class="form-group" method="post">
                                <input type="text" hidden class="form-control mb-3" name="txtid" value="<?php echo $viphamhienhanh["id"]; ?>">
                                <input type="text" class="form-control mb-3" name="txtvipham" value="<?php echo $viphamhienhanh["vipham"]; ?>" placeholder="Nhập tên vi phạm" required>
                                <input type="number" class="form-control mb-3" name="txtdiemtru" min="0.5" value="<?php echo $viphamhienhanh["diemtru"]; ?>" step="0.5" required>
                                <input type="hidden" name="action" value="capnhat">
                                <input type="submit" class="btn btn-warning" value="Cập nhật vi phạm">
                            </form>
                        </div>
                        <div class="col-sm-2"></div>
                    </div>
                    <?php } ?>
                    <!-- Ket thuc Form sua -->
                    <div class="alert alert-danger mt-2" id="hienthi">
                        <input id="thongbao" class="text-danger form-control text-center" value="<?php echo $thongbao ?>" hidden>
                        <a href="#" id="thongbao" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Thông báo!</strong> <?php echo $thongbao ?>
                    </div>
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
                    <table class="table table-hover" id="table2excel">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Vi Phạm</th>
                                <th scope="col">Điểm trừ</th>
                                <th scope="col" class="noExl">Sửa</th>
								<th scope="col" class="noExl">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stt = 1;
                            foreach ($vipham as $v) :
                            ?>
                                    <tr>
                                        <td><?php echo $stt ?></td>
                                        <td><?php echo $v["vipham"]; ?></td>
                                        <td><?php echo $v["diemtru"]; ?></td>
                                        <td><a class="btn btn-warning" href="index.php?action=sua&id=<?php echo $v["id"] ?>"><i class="far fa-edit"></i></a></td>
                                        <td><a class="btn btn-danger" href="index.php?action=xoa&id=<?php echo $v["id"] ?>" onclick="return confirm('Bạn có chắc muốn xóa Vi phạm: <?php echo $v['vipham']; ?> ?')"><i class="far fa-trash-alt"></i></a> </td>
                                    </tr>
                            <?php
                                $stt++;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-success" id="btnXuat">Xuất File Excel</button>
            </div>
        </div>
    </div>
    <script>
        $("#btnXuat").click(function() {
            $("#table2excel").table2excel({
                exclude: ".noExl",
                name: "Worksheet Name",
                filename: "Noi_Quy",
                fileext: ".xlsx"
            })
        });
    </script>
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
        if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
    </script>
</body>
<div style="margin-top: 400px">
    <?php require "../include_ad/footer.php" ?>
</div>

</html>