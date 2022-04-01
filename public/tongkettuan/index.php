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
        header("location:../tongkettuan/index.php");
        //include("thongtin.php");
        break;
    case "noiquy":
        header("location:../noiquy/index.php");
        //include("noiquy.php");
        break; 
    case "tongkettuan":
        header("location:../../admin/tongkettuan/index.php");
        break;
    case "dangnhap":
        header("location:../../admin/ktnguoidung/index.php");
        break;
    case "bangdieukhien":
        header("location../daunam/index.php");
    case "tructuan":
        header("location:../../admin/tructuan/index.php");
        //include("tructuan.php");
        break;
    case "danhsach":
        if(isset($_SESSION["nguoidung"]) && $_SESSION["nguoidung"]["loai"]==1)
        {
            header("location:../../admin/tongkettuan/index.php");
        }
        else
        {
            $khoi = $kh->laydanhsachkhoi();
            $vipham = $vp->laydanhsachvipham();
            $khoidau = $kh->layidkhoidau();
            $txttuan="";
            //lay nam hoc cuoi
            $namcuoi = $nh->laynamhoc();
            $dsnamhoc = $nh->laydanhsachnamhoc();
            $xephang = $xh->laydanhsachxephang(0,0);
            $laynamhoctheoid=$nh->laynamhoctheoid($namcuoi["max(id)"]);
            $khoangcach=$t->laytuanminmax($namcuoi["max(id)"]);
            $tuanmax=$khoangcach["max(tuan)"];
            $tuanmin=$khoangcach["min(tuan)"];
            if($tuanmax==null)
            {
                $thongbao='Năm học '.$laynamhoctheoid['namhoc'].' không có tuần '. $txttuan;
            }
            else
            {
                $thongbao='';
            }
            include("main.php");
            break;
        }
    case "danhsachthiduatuan":
        $khoi = $kh->laydanhsachkhoi();
        $vipham = $vp->laydanhsachvipham();
        $khoidau = $kh->layidkhoidau();
        //lay nam hoc cuoi
        $namcuoi = $nh->laynamhoc();
        $dsnamhoc = $nh->laydanhsachnamhoc();

        $loptheokhoi = $lp->layloptheokhoi($_POST["selectkhoi"]);
        $selectkhoi = $_POST["selectkhoi"];
        $selectnamhoc=$_POST["selectnamhoc"];
        $tuan_id = $t->laytuantheoid($_POST["selectnamhoc"], $_POST["txttuan"]);
        $xephang = $xh->laydanhsachxephang($tuan_id["id"], $selectkhoi);
        $txttuan = $_POST["txttuan"];

        $laynamhoctheoid=$nh->laynamhoctheoid($selectnamhoc);
        $khoangcach=$t->laytuanminmax($selectnamhoc);
        $tuanmax=$khoangcach["max(tuan)"];
        $tuanmin=$khoangcach["min(tuan)"];
        if($tuanmax==null)
        {
            $thongbao='Năm học '.$laynamhoctheoid['namhoc'].' không có tuần '. $txttuan;
        }
        else
        {
            $thongbao='';
        }
        include("main.php");
        break;
    default:
        break;
    }
