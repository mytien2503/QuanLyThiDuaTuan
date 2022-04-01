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
else{
    $action="danhsach";
}
switch($action){
    case "trangchu":
        header("location:../../index.php");
        break;
    case "danhsach":
        $vipham=$vp->laydanhsachvipham();
        $thongbao='';
        include("main.php");
        break;
    case "themvipham":
        $tenvipham=$_POST["txtvipham"];
        $diemtru=$_POST["txtdiemtru"];
        $inhoa=mb_strtoupper($tenvipham, 'UTF-8');
        $vipham_0=$vp->kiemtravipham_0($inhoa);
        $vipham_1=$vp->kiemtravipham_1($inhoa);
        if($vp->kiemtravipham_0($inhoa))
        {
            $thongbao='Vi phạm: '.$tenvipham.' đã tồn tại!!!';
        }
        else if($vp->kiemtravipham_1($inhoa) && $vipham_1["diemtru"]==$diemtru)
        {
            $vp->suavipham_ghichu($vipham_1["id"]);
            $thongbao='';
        }   
        else if($vipham_1["ghichu"]==1 && $vipham_1["diemtru"]!=$diemtru)   
        {
            $vp->themvipham($tenvipham, $diemtru);   
            $thongbao='';
        }
        else
        {
            $vp->themvipham($tenvipham, $diemtru);   
            $thongbao='';
        }  
        $vipham=$vp->laydanhsachvipham(); 
        include("main.php");
        break;
    case "sua":
        $idsua=$_GET["id"];
        $viphamhienhanh=$vp->layviphamtheoid($idsua);
        $vipham=$vp->laydanhsachvipham();
        $thongbao='';
        include("main.php");
        break;
    case "capnhat":
        $layvipham=$vp->kiemtravipham_0(mb_strtoupper($_POST["txtvipham"]));
        if($layvipham["id"]!=$_POST["txtid"] && $layvipham["ghichu"]==0)
        {
            $thongbao='Vi phạm: '.$_POST["txtvipham"].' đã tồn tại!!!';
            $vipham = $vp->laydanhsachvipham();      
            include("main.php");
        }
        else
        {
            $vp->suavipham($_POST["txtid"], $_POST["txtvipham"], $_POST["txtdiemtru"]);
            $thongbao='';
            header("location:index.php");          
        }      
        break;
    case "xoa":
        if($tt->kiemtratructuan_vipham($_GET["id"]))
        {
            $vp->xoavipham_ghichu($_GET["id"]);
            $thongbao='';
        }
        else
        {
            $vp->xoavipham($_GET["id"]);
            $thongbao='';
        }    
        $vipham = $vp->laydanhsachvipham(); 
        header("location:index.php"); 
        break;
    default:
        break;
    }

?>