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


$kh = new KHOI();
$lp = new LOP();
$vp = new VIPHAM();
$xh = new XEPHANG();
$t = new TUAN();
$nh = new NAMHOC();
$hs=new HOCSINH();
$tt=new TRUCTUAN();
$vp=new VIPHAM();

$idsua=0;		
		
// Xét xem có thao tác nào được chọn
if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
elseif (!isset($_SESSION["nguoidung"])) {
    $action = "dangnhap";
}else{
    $action="danhsach";
}
switch($action){
    case "trangchu":
        header("location:../../index.php");
        break;
    case "dangnhap":
        header("location:../ktnguoidung/index.php?action=dangnhap");
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
        header("location:../daunam/index.php");
    case "tructuan":
        header("location:../tructuan/index.php");
        break;
    case "danhsach":
        $khoi=$kh->laydanhsachkhoi();
		$vipham=$vp->laytoanbovipham();
		$khoidau=$kh->layidkhoidau();
		//lay nam hoc cuoi
		$namcuoi=$nh->laynamhoc();
		$dsnamhoc=$nh->laydanhsachnamhoc();
        $tructuan=$tt->laydanhsachtructuan(0,0);
        $counthocsinh=$tt->counthocsinh(0,0);
        $lop=$lp->layloptheokhoi(0);
        $txttuan='';
        $selectnamhoc=$namcuoi["max(id)"];
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
    case "xacnhan":
        $txttuan=$_POST["txttuan"];
        $selectnamhoc=$_POST["selectnamhoc"];
        $selectkhoi=$_POST["selectkhoi"];
        if(isset($_POST["selectlop"]))
        {
            $selectlop=$_POST["selectlop"];
        }
        else
        {
            $selectlop=0;
        }
        $khoi=$kh->laydanhsachkhoi();
        $vipham=$vp->laytoanbovipham();
        $khoidau=$kh->layidkhoidau();
        //lay nam hoc cuoi
        $namcuoi=$nh->laynamhoc();
        $dsnamhoc=$nh->laydanhsachnamhoc();
        $tuantheoid=$t-> laytuantheoid($selectnamhoc,$txttuan);
        $tructuan=$tt->laydanhsachtructuan($tuantheoid["id"],$selectlop);
        $counthocsinh=$tt->counthocsinh($tuantheoid["id"],$selectlop);
        $lop=$lp->layloptheokhoi($selectkhoi);
        $dshs=$hs->layhocsinh_tructuan($selectnamhoc,$selectlop);
        
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
    case "themtructuan":
        $txttuan=$_POST["tuan"];
        $selectnamhoc=$_POST["namhoc"];
        $selectlop=$_POST["lop"];
        $laykhoi=$lp->layloptheoid($selectlop);
        $selectkhoi=$laykhoi["khoi_id"];
  
        $khoi=$kh->laydanhsachkhoi();
        $vipham=$vp->laydanhsachvipham();
        $khoidau=$kh->layidkhoidau();
        //lay nam hoc cuoi
        $namcuoi=$nh->laynamhoc();
        $dsnamhoc=$nh->laydanhsachnamhoc();
        $tuantheoid=$t-> laytuantheoid($selectnamhoc,$txttuan);
        $tructuan=$tt->laydanhsachtructuan($tuantheoid["id"],$selectlop);
        $counthocsinh=$tt->counthocsinh($tuantheoid["id"],$selectlop);

        $lop=$lp->layloptheokhoi($selectkhoi);
        $dshs=$hs->layhocsinh($selectnamhoc,$selectlop);
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
        include("add.php");
        break;
    case "xulythemtructuan":
        $txttuan=$_POST["txttuan"];
        $selectnamhoc=$_POST["selectnamhoc"];
        $selectlop=$_POST["selectlop"];
        $selectkhoi=$_POST["selectkhoi"];
    
        $khoi=$kh->laydanhsachkhoi();
        $vipham=$vp->laytoanbovipham();
        $khoidau=$kh->layidkhoidau();
        //lay nam hoc cuoi
        $namcuoi=$nh->laynamhoc();
        $dsnamhoc=$nh->laydanhsachnamhoc();
        $tuantheoid=$t-> laytuantheoid($selectnamhoc,$txttuan);

        $lop=$lp->layloptheokhoi($selectkhoi);
        $dshs=$hs->layhocsinh_tructuan($selectnamhoc,$selectlop);
        $laynamhoctheoid=$nh->laynamhoctheoid($selectnamhoc);
        $khoangcach=$t->laytuanminmax($selectnamhoc);
        $tuanmax=$khoangcach["max(tuan)"];
        $tuanmin=$khoangcach["min(tuan)"];
        //Thêm
        $solan=$_POST["txtSoLan"];
        $tongdiemtru=$_POST["txtTongTru"];      
        $tuan_id=$tuantheoid["id"];
        $hoten= mb_strtoupper($_POST["selecthoten"], 'UTF-8');
        $layidhs=$hs->layhocsinhtheoten($selectnamhoc,$selectlop,$hoten);
        $hocsinh_id= $layidhs["id"];


        $vipham_id=$_POST["selectvipham"];
       

        if(!$tt->kiemtrahocsinh_vipham($tuan_id,$hocsinh_id,$vipham_id))
        {
            $tt->themtructuan($solan, $tongdiemtru, $tuan_id, $hocsinh_id,$vipham_id);
           
            $tructuan=$tt->laydanhsachtructuan($tuantheoid["id"],$selectlop);
            $counthocsinh=$tt->counthocsinh($tuantheoid["id"],$selectlop);
            if($xh->kiemtraxephang($tuan_id,$selectlop))
            {
                $diemtru=0;
                foreach($dshs as $ds)
                {
                    foreach($tructuan as $truc)
                    {
                        if($truc["hocsinh_id"]==$ds["id"])
                            $diemtru+=$truc["tongdiemtru"];
                    }
                }
                $xh->updatexephang($diemtru, $tuan_id, $selectlop);
            }
            $thongbao='';
        } 
        else
        {
            $tructuan=$tt->laydanhsachtructuan($tuantheoid["id"],$selectlop);
            $counthocsinh=$tt->counthocsinh($tuantheoid["id"],$selectlop);
            $tenvipham=$vp->layviphamtheoid($vipham_id);
            $thongbao=$hoten." đã có vi phạm ".$tenvipham["vipham"].". Muốn thay đổi vui lòng cập nhật từ số lượt vi phạm";
        }
        
        include("main.php");
        break;
    case "sua":
        $idsua=$_GET["id"];                   
        $khoi=$kh->laydanhsachkhoi();
        $vipham=$vp->laytoanbovipham();
        $khoidau=$kh->layidkhoidau();
        //lay nam hoc cuoi
        $namcuoi=$nh->laynamhoc();
        $dsnamhoc=$nh->laydanhsachnamhoc();
        
        $tructuan=$tt->laydanhsachtructuantheoid($_GET["id"]);
        $hocsinh=$hs->layhocsinhtheoid($tructuan["hocsinh_id"]);
        $selectlop=$hocsinh["lop_id"];
        $laykhoi=$lp->layloptheoid($selectlop);
        $selectkhoi=$laykhoi["khoi_id"];
        $tuan=$t->laytuantheotuanid($tructuan["tuan_id"]);
        $txttuan=$tuan["tuan"];
        $selectnamhoc=$tuan["namhoc_id"];
        $lop=$lp->layloptheokhoi($selectkhoi);
        $dshs=$hs->layhocsinh_tructuan($selectnamhoc,$selectlop);
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
        include("update.php");
        break;
    case "xulysuatructuan":                  
        $khoi=$kh->laydanhsachkhoi();
        $vipham=$vp->laytoanbovipham();
        $khoidau=$kh->layidkhoidau();
        //lay nam hoc cuoi
        $namcuoi=$nh->laynamhoc();
        $dsnamhoc=$nh->laydanhsachnamhoc();
       
        $txttuan=$_POST["txttuan"];
        $selectnamhoc=$_POST["selectnamhoc"];
        $selectlop=$_POST["selectlop"];
        $selectkhoi=$_POST["selectkhoi"];
        $tuantheoid=$t-> laytuantheoid($selectnamhoc,$txttuan);
        $dshs=$hs->layhocsinh_tructuan($selectnamhoc,$selectlop);
        $lop=$lp->layloptheokhoi($selectkhoi);
        //Sua
        $id=$_POST["txtid"];
        $solan=$_POST["txtSoLan"];
        $tongdiemtru=$_POST["txtTongTru"];      
        $tuan_id=$tuantheoid["id"];

        $hocsinh_id=$_POST["selecthoten"];
        $vipham_id=$_POST["selectvipham"];

        $tt->suatructuan($id,$solan, $tongdiemtru, $tuan_id, $hocsinh_id,$vipham_id);
        $tructuan=$tt->laydanhsachtructuan($tuantheoid["id"],$selectlop);
        $counthocsinh=$tt->counthocsinh($tuantheoid["id"],$selectlop);
        //update tongtru trong bang xephang
        if($xh->kiemtraxephang($tuan_id,$selectlop))
        {
            $diemtru=0;
            foreach($dshs as $ds)
            {
                foreach($tructuan as $truc)
                {
                    if($truc["hocsinh_id"]==$ds["id"])
                        $diemtru+=$truc["tongdiemtru"];
                }
            }
            $xh->updatexephang($diemtru, $tuan_id, $selectlop);
        }
        //kết thúc
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
    case "xoa":                  
        $khoi=$kh->laydanhsachkhoi();
        $vipham=$vp->laytoanbovipham();
        $khoidau=$kh->layidkhoidau();
        //lay nam hoc cuoi
        //lay nam hoc cuoi
        $namcuoi=$nh->laynamhoc();
        $dsnamhoc=$nh->laydanhsachnamhoc();      
        
        $tructuantheoid=$tt->laydanhsachtructuantheoid($_GET["id"]);
        $hocsinh=$hs->layhocsinhtheoid($tructuantheoid["hocsinh_id"]);
        $selectlop=$hocsinh["lop_id"];
        $laykhoi=$lp->layloptheoid($selectlop);
        $selectkhoi=$laykhoi["khoi_id"];
        $tuan=$t->laytuantheotuanid($tructuantheoid["tuan_id"]);
        $txttuan=$tuan["tuan"];
        $selectnamhoc=$tuan["namhoc_id"];
    
        $lop=$lp->layloptheokhoi($selectkhoi);
        $dshs=$hs->layhocsinh_tructuan($selectnamhoc,$selectlop);
        $tt->xoatructuan($_GET["id"]);
        $tuantheoid=$t->laytuantheoid($selectnamhoc,$txttuan);
        $tructuan=$tt->laydanhsachtructuan($tuantheoid["id"],$selectlop);
        $counthocsinh=$tt->counthocsinh($tuantheoid["id"],$selectlop);

        if($xh->kiemtraxephang($tuan["id"],$selectlop))
        {
            $diemtru=0;
            foreach($dshs as $ds)
            {
                foreach($tructuan as $truc)
                {
                    if($truc["hocsinh_id"]==$ds["id"])
                        $diemtru+=$truc["tongdiemtru"];
                }
            }
            $xh->updatexephang($diemtru, $tuan["id"], $selectlop);
        } 
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
    default:
        break;
    }
?>