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
                <h5 class="card-header text-center">BIỂU ĐỒ THỐNG KÊ VI PHẠM TUẦN <?php echo $txttuan ?></h5>
                <form method="POST" class="mt-5">
                    <input type="text" name="txttuan" value="<?php echo $txttuan ?>" hidden>
                    <input type="text" name="selectnamhoc" value="<?php echo $selectnamhoc ?>" hidden>
                    <input type="submit" class="btn btn-success" value="Danh sách">
                    <input name="action" value="danhsachthongke" hidden>
                </form>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <div id="piechart">
                            <script type="text/javascript">
                                // Load google charts
                                google.charts.load('current', {
                                    'packages': ['corechart']
                                });
                                google.charts.setOnLoadCallback(drawChart);
                                // Draw the chart and set the chart values
                                function drawChart() {
                                    var data = google.visualization.arrayToDataTable([
                                        ['Vi phạm', 'Thống kê vi phạm'],
                                        <?php
                                        $i = 1;
                                        $sum = count($result);
                                        foreach ($result as $val) :
                                            if ($i == $sum)
                                                $comma = "";
                                            else
                                                $comma = ",";
                                            echo "['" . $val['vipham'] . "'," . $val['soluot'] . " ]" . $comma;
                                            $i++;
                                        endforeach;
                                        ?>
                                    ]);
                                    // Optional; add a title and set the width and height of the chart
                                    var options = {
                                        'title': 'Biểu đồ thống kê vi phạm',
                                        'width': 1000,
                                        'height': 800
                                    };
                                    // Display the chart inside the <div> element with id="piechart"
                                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                                    chart.draw(data, options);
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
<div style="margin-top: 400px">
    <?php require "../include_ad/footer.php" ?>
</div>


</html>