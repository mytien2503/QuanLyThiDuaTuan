<!DOCTYPE html>
<html lang="en">

<head>
    <?php require ("../../include/head.php");
require("../../include/nav.php");
     ?>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8 text-center">
                <h5 class="card-header">NỘI QUY TRƯỜNG</h5>
                <div class="card-body">
                    <table class="table table-hover" id="table2excel">
                        <thead >
                            <tr class="thead-dark">
                                <th scope="col">STT</th>
                                <th scope="col">Vi Phạm</th>
                                <th scope="col">Điểm trừ</th>
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
                                </tr>
                            <?php
                                $stt++;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
</body>
<div style="margin-top: 100px">
    <?php require "../../include/footer.php" ?>
</div>

</html>