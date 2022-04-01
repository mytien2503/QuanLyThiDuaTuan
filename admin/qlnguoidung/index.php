<?php
require("../../model/database.php");
require("../../model/md_nguoidung.php");

$isLogin=isset($_SESSION["nguoidung"]);
// Xét xem có thao tác nào được chọn
if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}elseif (!isset($_SESSION["nguoidung"]) || (isset($_SESSION["nguoidung"]) && $_SESSION["nguoidung"]["loai"] == 0)) {
    unset($_SESSION["nguoidung"]);
    $action = "dangnhap";
}
else{
    $action="xem";
}

$nd=new NGUOIDUNG();
$idsua=0;
switch($action){
    case "xem":
        $nguoidung=$nd->laydanhsachnguoidung();    
        include("main.php");
        break;
    case "dangnhap":
        header("location:../ktnguoidung/index.php?action=dangnhap");
        break;
    case "themnguoidung":
        $thongbao='';
        $hoten='';
        $sodienthoai='';
        $email='';
        $lop='';
        $loai=0;
        $matkhau='';    
        include("add.php");
        break;
    case "xlthemnguoidung":
        $hoten=$_POST["txthoten"];
        $sodienthoai=$_POST["txtdienthoai"];
        $email=$_POST["txtemail"];
        $lop=mb_strtoupper($_POST["txtlop"], 'UTF-8');
        $loai=$_POST["txtquyen"];
        $matkhau=$_POST["txtmatkhau"];
        if($nd->laythongtinnguoidung($email)!=null)
        {
            $thongbao="Email này đã được đăng ký. Vui lòng kiểm tra lại!!!";
            include("add.php");
        }
        else
        {
            $nd->themnguoidung($hoten,$email,$matkhau,$lop,$loai,$sodienthoai);
            $nguoidung=$nd->laydanhsachnguoidung();
            header("location:index.php");
        }     
        break;
    case "sua":
        $idsua=$_GET["id"];
        $nguoidunghientai=$nd->laydanhsachnguoidungtheoid($idsua);
        $thongbao='';
        include("update.php");
        break;
    case "xlsuanguoidung":
        $id=$_POST["txtid"];
        $lop=mb_strtoupper($_POST["txtlop"], 'UTF-8');
        $loai=$_POST["txtquyen"];
        $nd->capnhatloai_lop($id,$loai, $lop);
        $nguoidung=$nd->laydanhsachnguoidung();
        header("location:index.php");   
        break;
    case "khoa":
        $id=$_GET["id"];
        $trangthai=$_GET["trangthai"];
        $nd->doitrangthai($id,$trangthai);
        $nguoidung=$nd->laydanhsachnguoidung();    
        include("main.php");
        break;  
    case "xoa":
        $id=$_GET["id"];
        $nd->xoanguoidung($id);
        $nguoidung=$nd->laydanhsachnguoidung();    
        include("main.php");
        break;      
        
    default:
        break;
}
?>