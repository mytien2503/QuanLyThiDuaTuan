<?php 
require("model/database.php");
require("model/md_khoi.php");
require("model/md_lop.php");
require("model/md_namhoc.php");

// Xét xem có thao tác nào được chọn
if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
else{
    $action="trangchu";
}
$idsua=0;
$kh = new KHOI();
$lp=new LOP();
$nh=new NAMHOC();

switch($action){
    case "trangchu":
        include("main.php");
        break;
    case "thongtin":
        header("location:public/tongkettuan/index.php");
        break;
    case "xldangxuat":
        header("location:admin/ktnguoidung/index.php?action=xldangxuat");
        break;
    case "noiquy":
        header("location:public/noiquy/index.php");
        break;   
    case "tructuan":
        header("location:admin/tructuan/index.php");
        //include("tructuan.php");
        break;
    case "tongkettuan":
        header("location:admin/tongkettuan/index.php");
        break;
    case "bangdieukhien":
        header("location:admin/tongkettuan/index.php");
        break;
    case "dangnhap":
        header("location:admin/ktnguoidung/index.php");
        break;    
    case "danhsach":         
        include("main.php");
        break;
    default:
        break;
}
?>
