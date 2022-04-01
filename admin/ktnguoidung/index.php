<?php
session_start();
require("../../model/database.php");
require("../../model/md_nguoidung.php");
require("../../model/md_SendMail.php");
// Biến cho biết ng dùng đăng nhập chưa
$isLogin = isset($_SESSION["nguoidung"]);

if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
} elseif ($isLogin == FALSE) {
    $action = "dangnhap";
} else {
    $action = "macdinh";
}

$nguoidung = new NGUOIDUNG();
switch ($action) {
    case "macdinh":
        include("main.php");
        break;
    case "xldangxuat":
        unset($_SESSION["nguoidung"]);
        $thongbao = '';
        header('location:../../index.php');
        break;
    case "dangnhap":
        $thongbao = '';
        include("loginform.php");
        break;
    case "quenmatkhau":
        $thongbao = '';
        $maxacnhan='';
        include("forgotpass.php");
        break;
    case "yeucauxacnhan":
        $mailnhan = $_POST["txtemail"];
        $tamthoi=$nguoidung->laythongtinnguoidung($mailnhan);
        if ($tamthoi == null) {
            $thongbao = 'Email này chưa được đăng ký!!!';
            $maxacnhan='';
            include("forgotpass.php");
        } else {
            $thongbao = 'Vui lòng kiểm tra Mail để lấy mã xác nhận';
            $hoten =$tamthoi["hoten"];
            
            $maxacnhan=substr(md5(rand(0,999999)),0,8);
            sendmail($mailnhan,$hoten,$maxacnhan);   
            include("xacnhan.php");
        }
        break;
    case "maxacnhan":
        $mailnhan=$_POST["txtemail"];
        $xacnhan = $_POST["txtxacnhan"];
        $maxacnhan=$_POST["txtmaxacnhan"];
        if ($maxacnhan == $xacnhan) {
            $thongbao='';
            include("resetpass.php");
        } else {

            $thongbao="Mã xác nhận không khớp";
            include("xacnhan.php");
        }
        break;
    case "resetpass":
        $mailnhan=$_POST["txtemail"];
        if($_POST["txtxacnhanmatkhau"]!=$_POST["txtmatkhaumoi"])
        {
            $thongbao="Mật khẩu không khớp";
            include("resetpass.php");
        }
        else {
            $nguoidung->doimatkhau($_POST["txtemail"], $_POST["txtmatkhaumoi"]);
            $thongbao='';
            include("loginform.php");
            
        }     
        break;
    case "xldangnhap":
        $email = $_POST["txtemail"];
        $matkhau = $_POST["txtmatkhau"];
        if ($nguoidung->kiemtranguoidunghople($email, $matkhau) == TRUE) {
            $_SESSION["nguoidung"] = $nguoidung->laythongtinnguoidung($email);
            include("main.php");
        } else {
            $thongbao = "Đăng nhập không thành công!";
            include("loginform.php");
        }
        break;
    case "capnhat":
        $id = $_POST["txtid"];
        $email = $_POST["txtemail"];
        $sodienthoai = $_POST["txtdienthoai"];
        $hoten = $_POST["txthoten"];
        if ($_FILES["filehinhanh"] ["name"] == null) 
            $hinhanh = $_POST["txthinhcu"]; 
        else 
        {
            $hinhanh = "../../images/". basename ($_FILES ["filehinhanh"] ["name"]);
            move_uploaded_file ($_FILES ["filehinhanh"] ["tmp_name"], $hinhanh); 
        }

        $nguoidung->capnhatnguoidung($id, $hoten, $email, $sodienthoai,$hinhanh);

        $_SESSION["nguoidung"] = $nguoidung->laythongtinnguoidung($email);
        include("main.php");
        break;
    case "doimatkhau":
        if (isset($_POST["txtemail"]) && isset($_POST["txtmatkhaumoi"])) {
            $nguoidung->doimatkhau($_POST["txtemail"], $_POST["txtmatkhaumoi"]);
        }

        $_SESSION["nguoidung"] = $nguoidung->laythongtinnguoidung($_POST["txtemail"]);
        include("main.php");
        break;
     
    default:
        break;
}
