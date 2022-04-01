<?php 
require_once("../../model/database.php");
require_once("../../model/md_tructuan.php");
require_once("../../model/md_tuan.php");
require_once("../../model/md_namhoc.php");
$tt=new TRUCTUAN();
$t = new TUAN();
$nh = new NAMHOC();
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
    case "danhsach":
        $namcuoi=$nh->laynamhoc();
		$dsnamhoc=$nh->laydanhsachnamhoc();
        $selectnamhoc=$namcuoi["max(id)"];
        $laynamhoctheoid=$nh->laynamhoctheoid($selectnamhoc);
        $khoangcach=$t->laytuanminmax($selectnamhoc);
        $tuanmax=$khoangcach["max(tuan)"];
        $tuanmin=$khoangcach["min(tuan)"];
        $txttuan="";
        $thongke=$tt->laythongkevipham($txttuan);
        $result=$tt->laythongke($txttuan);
        $thongbao="";
        include("main.php");
        break;
    case "danhsachthongke":
        $txttuan=$_POST["txttuan"];
        $selectnamhoc=$_POST["selectnamhoc"];
        $tuan_id=$t->laytuantheoid($selectnamhoc, $txttuan);
        $namcuoi=$nh->laynamhoc();
        $dsnamhoc=$nh->laydanhsachnamhoc(); 
        $laynamhoctheoid=$nh->laynamhoctheoid($selectnamhoc);
        $khoangcach=$t->laytuanminmax($selectnamhoc);
        $tuanmax=$khoangcach["max(tuan)"];
        $tuanmin=$khoangcach["min(tuan)"];
        if($txttuan>$tuanmax)
        {
            $thongbao="Năm học ".$laynamhoctheoid["namhoc"]." chỉ có ".$tuanmax." tuần";
            $thongke=$tt->laythongkevipham("");
        }
        else
        {
            $thongke=$tt->laythongkevipham($tuan_id["id"]);    
            $thongbao="";
        }
       
        include("main.php");
        break;
    case "bieudo":
        if(isset($_POST["txttuan"]) && isset($_POST["selectnamhoc"]))
        {
            $txttuan=$_POST["txttuan"];
            $selectnamhoc=$_POST["selectnamhoc"];
        }
        else
        {
            $txttuan='';
            $selectnamhoc=0;
        }
        
        $tuan_id=$t->laytuantheoid($selectnamhoc, $txttuan);
        $namcuoi=$nh->laynamhoc();
        $dsnamhoc=$nh->laydanhsachnamhoc(); 
        $laynamhoctheoid=$nh->laynamhoctheoid($selectnamhoc);
        $khoangcach=$t->laytuanminmax($selectnamhoc);
        $tuanmax=$khoangcach["max(tuan)"];
        $tuanmin=$khoangcach["min(tuan)"];
        $thongke=$tt->laythongkevipham($tuan_id["id"]);
        //Biểu đồ
        $result=$tt->laythongke($tuan_id["id"]);     
        $thongbao="";
        include("bieudo.php");
        break;
    default:
        break;
    }

?>