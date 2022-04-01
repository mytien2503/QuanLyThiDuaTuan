<!DOCTYPE html>
<html lang="en">

<head>
    <?php require "../include_ad/head.php" ?>
    <?php require "../include_ad/nav.php" ?>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2">
                <?php require "../leftlayout_ad/menuleft.php" ?>
            </div>
            <div class="col-sm-10 text-center">
                <h5 class="card-header">DANH SÁCH NGƯỜI DÙNG</h5>
                <div class="row">
                    <div class="col-sm-2 mt-2 mb-2">
                        <a class="btn btn-success" href="index.php?action=themnguoidung">Thêm người dùng</a>
                    </div>
                </div>
                <!-- Danh sách người dùng -->
                <table class="table table-hover" id="table2excel">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Email</th>
                            <th scope="col">Tên</th>
                            <th scope="col">Lớp</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Khóa</th>
                            <th scope="col" class="noExl">Sửa</th>
							<th scope="col" class="noExl">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $stt = 1;
                            foreach ($nguoidung as $nd) :
                        ?>
                            <tr>
                                <td><?php echo $stt; ?></td>
                                <td><?php echo $nd["email"]; ?></td>
                                <td><?php echo $nd["hoten"]; ?></td>
                                <td><?php echo $nd["lop"]; ?></td>
                                <td>
                                    <?php 
                                        if ($nd["loai"] != 1) {
                                            if ($nd["trangthai"] == 1) 
                                                echo "Kích hoạt";
                                            else 
                                                echo "Khóa";
                                        } 
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if ($nd["loai"] != 1) {
                                            if ($nd["trangthai"] == 1) 
                                            { 
                                    ?>
                                            <a href="?action=khoa&trangthai=0&id=<?php echo $nd["id"]; ?>">Khóa</a>
                                    <?php
                                            } 
                                            else 
                                            {
                                    ?>
                                            <a href="?action=khoa&trangthai=1&id=<?php echo $nd["id"]; ?>">Kích hoạt</a>
                                </td>
                            <?php
                                        }
                                    }
                            ?>
                             <?php
                                    if ($nd["loai"] != 1) {
                                ?>
                            <td>                           
                                <a class="btn btn-warning" href="index.php?action=sua&id=<?php echo $nd["id"] ?>"><i class="far fa-edit"></i></a>
                            </td>
                            <td>
                                <a class="btn btn-danger" href="index.php?action=xoa&id=<?php echo $nd["id"] ?>"><i class="far fa-trash-alt"></i></a>
                            </td>
                            <?php
                                    }
                            else{
                                ?>
                            <td> </td>
                            <td> </td>
                            <?php
                                    }
                                ?>
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
</body>
<div style="margin-top: 400px">
    <?php require "../include_ad/footer.php" ?>
</div>

</html>