<!DOCTYPE html>
<html lang="en">

<head>
    <?php require( "../include_ad/head.php");
	include("../include_ad/nav.php");?>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3">
                <?php require "../leftlayout_ad/menuleft.php" ?>
            </div>
            <div class="col-sm-8 mt-3">
           <?php require "groupbutton.php" ?>
           <!-- <a class="btn btn-success " id="btnnamhoc">Thêm năm học</a>
					<a class="btn btn-success" id="btnkhoi">Thêm khối</a>
					<a class="btn btn-success" id="btnlop">Thêm lớp</a>-->
            </div>
        </div>
    </div>


</body>
<div style="margin-top: 400px">
	<?php require "../include_ad/footer.php" ?>
</div>
	
</html>