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


$isLogin = isset($_SESSION["nguoidung"]);
// Xét xem có thao tác nào được chọn
if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
elseif($isLogin == FALSE){
    $action = "dangnhap";
}
else{
    $action="danhsach";
}
switch($action){
    case "trangchu":
        header("location:../../index.php");
        break;
    case "xldangxuat":
        header("location:../ktnguoidung/index.php?action=xldangxuat");
        break;
    case "thongtin":
        header("location:../../public/tongkettuan/index.php");
    break;
    case "noiquy":
            header("location:../../public/noiquy/index.php");
        break; 
    case "tongkettuan":
        header("location:../tongkettuan/index.php");
        break;
    case "bangdieukhien":
        header("location../daunam/index.php");
    case "tructuan":
        header("location:../tructuan/index.php");
        //include("tructuan.php");
        break;
    case "dangnhap":
        header("location:../ktnguoidung/index.php?action=dangnhap");
        break;
    case "danhsach":
        $khoi = $kh->laydanhsachkhoi();
        $vipham = $vp->laydanhsachvipham();
        $khoidau = $kh->layidkhoidau();
        $txttuan="";
        //lay nam hoc cuoi
        $namcuoi = $nh->laynamhoc();
        $dsnamhoc = $nh->laydanhsachnamhoc();
        $xephang = $xh->laydanhsachxephang(0,0);
        $thongbao='';
        $khoangcach=$t->laytuanminmax($namcuoi["max(id)"]);
        $tuanmax=$khoangcach["max(tuan)"];
        $tuanmin=$khoangcach["min(tuan)"];
        include("main.php");
        break;
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
        if($txttuan>$tuanmax)
        {
            $thongbao='Năm học '.$laynamhoctheoid['namhoc'].' chỉ có '. $tuanmax.' tuần';
        }
        else
        {
            $thongbao='';
        }
        include("main.php");    
        break;
    case "xacnhan":
        $txttuan=$_POST["txttuan"];
        $selectnamhoc=$_POST["selectnamhoc"];
        $khoangcach=$t->laytuanminmax($selectnamhoc);
        $tuanmax=$khoangcach["max(tuan)"];
        $tuanmin=$khoangcach["min(tuan)"];
        $laynamhoctheoid=$nh->laynamhoctheoid($selectnamhoc);
        if($txttuan>$tuanmax)
        {
            $thongbao='Năm học '.$laynamhoctheoid['namhoc'].' chỉ có '. $tuanmax.' tuần';
        }   
        $selectkhoi=$_POST["selectkhoi"];

        $khoi=$kh->laydanhsachkhoi();
        $vipham=$vp->laydanhsachvipham();
        $khoidau=$kh->layidkhoidau();
        //lay nam hoc cuoi
        $namcuoi=$nh->laynamhoc();
        $dsnamhoc=$nh->laydanhsachnamhoc();
        $lop=$lp->layloptheokhoi($selectkhoi);
        if(isset($_POST["selectlop"]))
        {
            $selectlop=$_POST["selectlop"];
        }
        else
        {
            $selectlop=0;
        }
        $kttuan=$t->laytuantheoid($selectnamhoc, $txttuan);
        if (isset($_POST["txttuan"]) && isset($_POST["selectkhoi"]) && isset($_POST["selectlop"]) && $selectlop!=0) 
        {
            $tuan = $txttuan;
            $tuan_id = $t->laytuantheoid($_POST["selectnamhoc"], $tuan);
            $khoi_id = $_POST["selectkhoi"];
            $lop_id = $_POST["selectlop"];
            //Lấy lớp theo khối
            $ktlop=$lp->layloptheoid($lop_id);
            $hocsinh = $hs->layhocsinh_tructuan($_POST["selectnamhoc"], $lop_id);
            $tructuan = $tt->laydanhsachtructuan($tuan_id["id"],$lop_id);
            //Kiểm tra xem lớp đã nhập chưa
            if(($xh->kiemtraxephang($tuan_id["id"], $lop_id)) && $ktlop["khoi_id"]==$khoi_id)
            {
                $laylop=$lp->layloptheoid($lop_id);
                $thongbao='Lớp '. $laylop["lop"].' đã được thêm tổng kết tuần!!!';
            }
            $diemtru = 0;
            foreach ($tructuan as $truc) :
                foreach ($hocsinh as $h) :
                    if ($truc["hocsinh_id"] == $h["id"]) {
                        $diemtru += $truc["tongdiemtru"];
                    }
                endforeach;
            endforeach;
        } else {
            $khoi_id = 0;
            $lop_id = 0;
            $tuan_id = 0;
            $diemtru = 0;
        }
        if(!isset($thongbao))
        {
            $thongbao='';
        }
        if(isset($ktlop))
        {
            $tongketlop=$ktlop["lop"];
        }
        else
        {
            $tongketlop="";
        }
        
        include("add.php");
        break;
    case "themtongkettuan":   
        $khoi=$kh->laydanhsachkhoi();
        $vipham=$vp->laydanhsachvipham();
        $khoidau=$kh->layidkhoidau();
        //lay nam hoc cuoi
        $namcuoi=$nh->laynamhoc();
        $dsnamhoc=$nh->laydanhsachnamhoc();
        $hocsinh = $hs->layhocsinh(0,0);
        $lop=$lp->layloptheokhoi(0);
        $khoi_id = 0;
        $lop_id = 0;
        $tuan_id = 0;
        $diemtru = 0;     
        $txttuan='';
        $thongbao='';
        $laynamhoctheoid=$nh->laynamhoctheoid($namcuoi["max(id)"]);
        $khoangcach=$t->laytuanminmax($namcuoi["max(id)"]);
        $tuanmax=$khoangcach["max(tuan)"];
        $tuanmin=$khoangcach["min(tuan)"];
        $thongbao='';
        $tongketlop='';
        include("add.php");
        break;
    case "xylythemtongkettuan":
        if($_POST["txtSDB2"]!=null)      
            $thu2=$_POST["txtSDB2"];
        else
            $thu2=0;

        if($_POST["txtSDB3"]!=null)
            $thu3=$_POST["txtSDB3"];
        else
            $thu3=0;

        if($_POST["txtSDB4"]!=null)
            $thu4=$_POST["txtSDB4"];
        else
            $thu4=0;

        if($_POST["txtSDB5"]!=null)
            $thu5=$_POST["txtSDB5"];
        else
            $thu5=0;

        if($_POST["txtSDB6"]!=null)
            $thu6=$_POST["txtSDB6"];
        else
            $thu6=0;

        if($_POST["txtSDB7"]!=null)
            $thu7=$_POST["txtSDB7"];
        else
            $thu7=0;
        $diemSDB=$_POST["txtDSDB"];
        $tongdiemtru=$_POST["txtDiemTru"];
        $diemdatduoc=$_POST["txtDiemDatDuoc"];
        $sotiet=$_POST["txtSoTiet"];
        $trungbinh=$_POST["txtTrungBinh"];
        $tuan_id=$_POST["txttuan_id"];
        $lop_id=$_POST["txtlop_id"];
        $khoi_id=$_POST["txtkhoi_id"];

        //dữ liệu
        $txt=$t->laytuantheotuanid($_POST["txttuan_id"]);
        $txttuan=$txt["tuan"];
        $selectnamhoc=$txt["namhoc_id"];
        $selectkhoi=$_POST["txtkhoi_id"];

        $khoi=$kh->laydanhsachkhoi();
        $vipham=$vp->laydanhsachvipham();
        $khoidau=$kh->layidkhoidau();
        //lay nam hoc cuoi
        $namcuoi=$nh->laynamhoc();
        $dsnamhoc=$nh->laydanhsachnamhoc();
        $loptheokhoi = $lp->layloptheokhoi($selectkhoi);
        $xephang = $xh->laydanhsachxephang( $tuan_id,$selectkhoi);
        
        $laynamhoctheoid=$nh->laynamhoctheoid($selectnamhoc);
        $khoangcach=$t->laytuanminmax($selectnamhoc);
        $tuanmax=$khoangcach["max(tuan)"];
        $tuanmin=$khoangcach["min(tuan)"];
        //kết thức dữ liệu
        $xh->themxephang($thu2, $thu3, $thu4,$thu5,$thu6,$thu7,$diemSDB,$tongdiemtru,$diemdatduoc,$sotiet,$trungbinh,$tuan_id,$lop_id,$khoi_id);
        $thongbao='';
        include("main.php");     
        break;
    case "sua":
        $khoi=$kh->laydanhsachkhoi();
        $vipham=$vp->laydanhsachvipham();
        $khoidau=$kh->layidkhoidau();
        //lay nam hoc cuoi
        $namcuoi=$nh->laynamhoc();
        $dsnamhoc=$nh->laydanhsachnamhoc();     
        $thongbao='';

        $xephanghientai=$xh->laydanhsachxephangtheoid($_GET["id"]);
        
        $selectkhoi = $xephanghientai["khoi_id"];
        $tuan_id = $t->laytuantheotuanid($xephanghientai["tuan_id"]);
        $selectnamhoc=$tuan_id["namhoc_id"];      
        $xephang = $xh->laydanhsachxephang($tuan_id["id"], $selectkhoi);
        $txttuan = $tuan_id["tuan"];
        $selectlop=$xephanghientai["lop_id"];
        $lop=$lp->layloptheokhoi($selectkhoi);
        $laynamhoctheoid=$nh->laynamhoctheoid($selectnamhoc);
        $khoangcach=$t->laytuanminmax($selectnamhoc);
        $tuanmax=$khoangcach["max(tuan)"];
        $tuanmin=$khoangcach["min(tuan)"];
        $thongbao='';    
        include("update.php");
        break;
    case "xylysuatongkettuan":
        $id=$_POST["txtid"];
        if($_POST["txtSDB2"]!=null)      
            $thu2=$_POST["txtSDB2"];
        else
            $thu2=0;

        if($_POST["txtSDB3"]!=null)
            $thu3=$_POST["txtSDB3"];
        else
            $thu3=0;

        if($_POST["txtSDB4"]!=null)
            $thu4=$_POST["txtSDB4"];
        else
            $thu4=0;

        if($_POST["txtSDB5"]!=null)
            $thu5=$_POST["txtSDB5"];
        else
            $thu5=0;

        if($_POST["txtSDB6"]!=null)
            $thu6=$_POST["txtSDB6"];
        else
            $thu6=0;

        if($_POST["txtSDB7"]!=null)
            $thu7=$_POST["txtSDB7"];
        else
            $thu7=0;

       
        $diemSDB=$_POST["txtDSDB"];
        $diemdatduoc=$_POST["txtDiemDatDuoc"];
        $sotiet=$_POST["txtSoTiet"];
        $trungbinh=$_POST["txtTrungBinh"];
       
        $xh->suaxephang($id,$thu2, $thu3, $thu4,$thu5,$thu6,$thu7,$diemSDB, $diemdatduoc, $sotiet, $trungbinh);

        $txt=$t->laytuantheotuanid($_POST["txttuan_id"]);
        $txttuan=$txt["tuan"];
        $selectnamhoc=$txt["namhoc_id"];
        $selectkhoi=$_POST["txtkhoi_id"];

        $khoi=$kh->laydanhsachkhoi();
        $vipham=$vp->laydanhsachvipham();
        $khoidau=$kh->layidkhoidau();
        //lay nam hoc cuoi
        $namcuoi=$nh->laynamhoc();
        $dsnamhoc=$nh->laydanhsachnamhoc();
        $loptheokhoi = $lp->layloptheokhoi($selectkhoi);
        $xephang = $xh->laydanhsachxephang($_POST["txttuan_id"],$selectkhoi);
        $laynamhoctheoid=$nh->laynamhoctheoid($selectnamhoc);
        $khoangcach=$t->laytuanminmax($selectnamhoc);
        $tuanmax=$khoangcach["max(tuan)"];
        $tuanmin=$khoangcach["min(tuan)"];
        $thongbao='';
        include("main.php");
        break;
    case "xoa":
        $khoi=$kh->laydanhsachkhoi();
        $vipham=$vp->laydanhsachvipham();
        $khoidau=$kh->layidkhoidau();
        //lay nam hoc cuoi
        $namcuoi=$nh->laynamhoc();
        $dsnamhoc=$nh->laydanhsachnamhoc();     
        $xephanghientai=$xh->laydanhsachxephangtheoid($_GET["id"]);
        
        $selectkhoi = $xephanghientai["khoi_id"];
        $tuan_id = $t->laytuantheotuanid($xephanghientai["tuan_id"]);
        $txttuan = $tuan_id["tuan"];
        $selectnamhoc=$tuan_id["namhoc_id"];
        $loptheokhoi=$lp->layloptheokhoi($selectkhoi);
        $laynamhoctheoid=$nh->laynamhoctheoid($selectnamhoc);
        $khoangcach=$t->laytuanminmax($selectnamhoc);
        $tuanmax=$khoangcach["max(tuan)"];
        $tuanmin=$khoangcach["min(tuan)"];
        $thongbao=''; 
        $xh->xoaxephang($_GET["id"]);      
        $xephang = $xh->laydanhsachxephang($tuan_id["id"], $selectkhoi);
        include("main.php");
        break;
    default:
        break;
}
