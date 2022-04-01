<?php 
require_once("../../model/database.php");
require_once("../../model/md_khoi.php");
require_once("../../model/md_lop.php");
require_once("../../model/md_vipham.php");
require_once("../../model/md_tructuan.php");
require_once("../../model/md_xephang.php");
require_once("../../model/md_tuan.php");
require_once("../../model/md_namhoc.php");
require_once("../../model/md_hocsinh.php");
require_once("../../model/md_tructuan.php");

$kh = new KHOI();
$lp = new LOP();
$vp = new VIPHAM();
$xh = new XEPHANG();
$t = new TUAN();
$nh = new NAMHOC();
$hs=new HOCSINH();
$tt=new TRUCTUAN();
// Xét xem có thao tác nào được chọn
if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
else{
    $action="danhsach";
}
switch($action){
    case "trangchu":
        header("location:../../index.php");
        break;
    case "xldangxuat":
        header("location:../../admin/ktnguoidung/index.php?action=xldangxuat");
        break;
    case "thongtin":
        if(isset($_SESSION["nguoidung"]) && $_SESSION["nguoidung"]["loai"]==0)
        {
            header("location:../../public/tongkettuan/index.php");
        }
        elseif(isset($_SESSION["nguoidung"]) && $_SESSION["nguoidung"]["loai"]==1)
        {
            header("location:../tongkettuan/index.php");
        }
        else
        {
            header("location:../tongkettuan/index.php");
        }
        break;
    case "tongkettuan":
        header("location:../../admin/tongkettuan/index.php");
        break;
    case "tructuan":
        if(isset($_SESSION["nguoidung"]) && $_SESSION["nguoidung"]["loai"]==0)
        {
            header("location:../../admin/tructuan/index.php");
        }
        elseif(isset($_SESSION["nguoidung"]) && $_SESSION["nguoidung"]["loai"]==1)
        {
            header("location:../../admin/tructuan/index.php");
        }
        else
        {
            header("location:../../index.php");
        }
        break;
    case "noiquy":
         if(isset($_SESSION["nguoidung"]) && $_SESSION["nguoidung"]["loai"]==0)
        {
            header("location:../../public/noiquy/index.php");
        }
        elseif(isset($_SESSION["nguoidung"]) && $_SESSION["nguoidung"]["loai"]==1)
        {
            header("location:../../admin/noiquy/index.php");
        }
        else
        {
            header("location:../tongkettuan/index.php");
        }
        break; 
    case "dangnhap":
        header("location:../../admin/ktnguoidung/index.php");
        break;
    case "danhsach":
        if(isset($_SESSION["nguoidung"]) && $_SESSION["nguoidung"]["loai"]==1)
        {
            header("location:../../admin/noiquy/index.php");
        }
        else
        {
            $vipham=$vp->laydanhsachvipham();
            include("main.php");
        }
        break;     
    default:
    break;
}
