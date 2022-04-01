<?php 
require("../../model/database.php");
require("../../model/md_khoi.php");
require("../../model/md_lop.php");
require("../../model/md_namhoc.php");
require("../../model/md_tuan.php");
require("../../model/md_hocsinh.php");
require("../../model/md_xephang.php");

// Xét xem có thao tác nào được chọn
if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
elseif(!isset($_SESSION["nguoidung"])){
    $action="dangnhap";     
}
elseif(isset($_SESSION["nguoidung"]) && $_SESSION["nguoidung"]["loai"]==0){
    unset($_SESSION["nguoidung"]);
    $action="dangnhap";
}
else{
    $action="danhsach";
}
$idsua=0;
$kh = new KHOI();
$lp=new LOP();
$nh=new NAMHOC();
$t=new TUAN();
$hs=new HOCSINH();
$xh=new XEPHANG();

switch($action){
    case "trangchu":
        include("../../main.php");
        break;
    case "dangnhap":
        header("location:../ktnguoidung/index.php?action=dangnhap");
        break; 
    case "danhsach":         
        include("main.php");
        break;
    //Năm học
    case "xemnam":     
        $namhoc=$nh->laydanhsachnamhoc();
        $location='nam'; 
        $thongbao='';      
        include("nam.php");
        break;
    case "xulythemnamhoc":
        $nam1=$_POST["txtnamhoc1"];
        $nam2=$_POST["txtnamhoc2"];
        $gannamhoc=trim($nam1)."-".trim($nam2);
        if($nam1>$nam2 || $nam1==$nam2 || ($nam2-$nam1 )!=1){
            $thongbao='Năm học không hợp lệ';
        }
        else if(($nh->laynamhoctheonam($gannamhoc))!=null)
        {
            $thongbao='Năm học: '.$gannamhoc.' đã tồn tại!!!';
        } 
        else
        {
            
            $nh->themnamhoc($gannamhoc);
            $namhoc_id=$nh->laynamhoctheonam($gannamhoc);
            for ($i = 1; $i <= $_POST["txttuan"]; $i++){
                $t->themtuan($i , $namhoc_id["id"]);
            }
            $thongbao='';
        }   
        $namhoc=$nh->laydanhsachnamhoc();
        $location='nam';
        include("nam.php");
        break;
    case "suanamhoc":
        $idsua= $_GET["id"];
        $namhienhanh=$nh->laynamhoctheoid($idsua);
        $tach=explode( '-', $namhienhanh["namhoc"] );
        $nam1= $tach[0];
        $nam2=$tach[1];
        $tong = $t->laytuanminmax($idsua);
        $tongmax=$tong["max(tuan)"];
        $namhoc=$nh->laydanhsachnamhoc(); 
        $location='nam';
        $thongbao='';     
        include("nam.php");
        break;
    case "xulysuanamhoc":
        $txttuan=$_POST["txttuan"];
        $nam1=$_POST["txtnam1"];
        $nam2=$_POST["txtnam2"];
        $gannamhoc=trim($_POST["txtnam1"])."-".trim($_POST["txtnam2"]);
        $tong = $t->laytuanminmax($_POST["txtid"]);
        $laynh=$nh->laynamhoctheonam($gannamhoc);
        if($nam1>$nam2 || $nam1==$nam2 || ($nam2-$nam1 )!=1)
        {
            $thongbao='Năm học không hợp lệ';
        }
        else if($laynh!=null && $laynh["id"]!=$_POST["txtid"])
        {
            $thongbao='Năm học: '.$gannamhoc.' đã tồn tại!!!';
        }
        else
        {
            $nh->suanamhoc($_POST["txtid"],$gannamhoc);

            if($txttuan>$tong["max(tuan)"])
            {
                for($tong["max(tuan)"];$tong["max(tuan)"]<$txttuan;$tong["max(tuan)"]++)
                {
                    $t->themtuan($tong["max(tuan)"]+1,$_POST["txtid"]);
                }
                $thongbao='';
            }
            else if($txttuan<$tong["max(tuan)"])
            {    
                $dem="";
                $tuanmax=$tong["max(tuan)"];
                for($tuanmax;$tuanmax>$txttuan;$tuanmax--)
                {
                    $idtuan=$t->laytuantheoid($_POST["txtid"], $tuanmax);
                    $kiemtratuan=$xh->laydanhsachxephangtheotuan_id($idtuan["id"]);
                   if($kiemtratuan!=null)
                   {
                       $dem=$tong["max(tuan)"];
                   }
                } 
                if($dem!=null)
                {
                    $thongbao='Năm học '.$gannamhoc.' vừa chỉnh sửa phải có tuần lớn hơn hoặc bằng '.$dem.' tuần'; 
                    
                }
                else
                {
                    $maxtuan=$tong["max(tuan)"];
                    for($maxtuan;$maxtuan>$txttuan;$maxtuan--)
                    {
                        $idtuan=$t->laytuantheoid($_POST["txtid"],$maxtuan);
                        $t->xoatuan($idtuan["id"]);
                        $layid=$idtuan["id"] ;                                 
                    }
                    $thongbao='';
                }                 
            }           
        }    
        $namhoc=$nh->laydanhsachnamhoc(); 
        $location='nam';       
        include("nam.php");
        break;
    case "xoanamhoc":
        $id=$_GET["id"];
        $kiemtranamhoc=$nh->kiemtranamhoc($id);
        $kiemtranamhoc_hocsinh=$nh->kiemtranamhoc_hocsinh($id);
        if($kiemtranamhoc!=null && $kiemtranamhoc_hocsinh!=null)
        {
            $t->xoatuan_namhocid($id);
            $nh->xoanamhoc($id);
            $thongbao='';
        }
        else
        {
            $thongbao='Để đảm bảo không mất dữ liệu, vui lòng không xóa năm học này';
        }
        $namhoc=$nh->laydanhsachnamhoc();
        $location='nam';
        
        include("nam.php");
        break;
    //Khối
    case "xemkhoi":
        $khoi=$kh->laydanhsachkhoi();
        $location='khoi';
        $thongbao='';        
        include("khoi.php");
        break;
    case "xulythemkhoi":
        if($kh->kiemtrakhoi($_POST["txtkhoi"]))
        {
            $thongbao='Khối '.$_POST["txtkhoi"].' đã tồn tại!!!';
        }
        else
        {
            $kh->themkhoi($_POST["txtkhoi"]);
            $thongbao='';
        }     
        $khoi=$kh->laydanhsachkhoi();
        $location='khoi';        
        include("khoi.php");
        break;  
    case "suakhoi":
        $idsua= $_GET["id"];
        $khoi=$kh->laydanhsachkhoi(); 
        $location='khoi';
        $thongbao='';      
        include("khoi.php");
        break;
    case "xulysuakhoi":    
        if($kh->kiemtrakhoi($_POST["txtten"]))
        {
            $thongbao='Khối '.$_POST["txtten"].' đã tồn tại!!!';
        }
        else
        {
            $kh->suakhoi($_POST["txtid"],$_POST["txtten"]);
            $thongbao='';
        }  
        $khoi=$kh->laydanhsachkhoi(); 
        $location='khoi';        
        include("khoi.php");
        break;
    case "xoakhoi":
            $kiemtrakhoi=$lp->layloptheokhoi($_GET["id"]);
            if($kiemtrakhoi==null)
            {
                $thongbao=''; 
                $kh->xoakhoi($_GET["id"]);
            }
            else
            {
                $thongbao='Để đảm bảo không mất dữ liệu, vui lòng không xóa khối này';
            }
           
            $khoi=$kh->laydanhsachkhoi(); 
            $location='khoi';            
            include("khoi.php");
        break;
    //Lớp
    case "xemlop":
        $khoi=$kh->laydanhsachkhoi();
        $dslop=$lp->laydanhsachlop();       
        $location='lop';
        $thongbao='';       
        include("lop.php");
        break;
    case "xulythemlop":
        $inhoa=mb_strtoupper($_POST["txtlop"], 'UTF-8');
        $khoichon=$_POST["select1"];
        if($ktlop=$lp->kiemtralop($inhoa))
        {
            $thongbao='Lớp '.$_POST["txtlop"].' đã tồn tại!!!';
        }
        else
        {
            $lp->themlop($inhoa,$khoichon);
            $thongbao='';
        }   
        $khoi=$kh->laydanhsachkhoi();
        $dslop=$lp->laydanhsachlop();
        $location='lop'; 
                 
        include("lop.php");
        break;
    case "sualop":
        $idsua= $_GET["id"];
        $lophienhanh=$lp->layloptheoid($idsua);
        $khoi=$kh->laydanhsachkhoi();
        $dslop=$lp->laydanhsachlop();
        $location='lop'; 
        $thongbao='';        
        include("lop.php");
        break;
    case "xulysualop":

        if($ktlop=$lp->kiemtralop(mb_strtoupper($_POST["txtlop"], 'UTF-8')))
        {
            $thongbao='Lớp '.$_POST["txtlop"].' đã tồn tại!!!';
        }
        else
        {
            $lp->sualop($_POST["txtid"],mb_strtoupper($_POST["txtlop"]), $_POST["select1"] );
            $thongbao='';
        }        
        $khoi=$kh->laydanhsachkhoi();
        $dslop=$lp->laydanhsachlop();
        $location='lop';          
        include("lop.php");
        break;
    case "xoalop":
        $kiemtrahocsinh=$hs->layhocsinhtheolop_id($_GET["id"]);
        $kiemtraxephang=$xh->laydanhsachxephangtheolop_id($_GET["id"]);
        if($kiemtrahocsinh==null && $kiemtraxephang==null)
        {
            $lp->xoalop($_GET["id"]);
            $thongbao='';
        }
        else
        {
            $thongbao='Để đảm bảo không mất dữ liệu, vui lòng không xóa lớp này';
        }     
        $khoi=$kh->laydanhsachkhoi(); 
        $dslop=$lp->laydanhsachlop();
        $location='lop';
             
        include("lop.php");    
        break;
    default:
        break;
}
?>
