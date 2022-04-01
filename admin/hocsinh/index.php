<?php
require("../../model/database.php");
require("../../model/md_khoi.php");
require("../../model/md_lop.php");
require("../../model/md_namhoc.php");
require("../../model/md_hocsinh.php");
require("../../model/md_tructuan.php");
require("../../PHPExcel-1.8/Classes/PHPExcel.php");
require_once('../../PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');
// Xét xem có thao tác nào được chọn
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
} elseif (!isset($_SESSION["nguoidung"]) || (isset($_SESSION["nguoidung"]) && $_SESSION["nguoidung"]["loai"] == 0)) {
    unset($_SESSION["nguoidung"]);
    $action = "dangnhap";
} else {
    $action = "danhsach";
}

$kh = new KHOI();
$lp = new LOP();
$hs = new HOCSINH();
$nh = new NAMHOC();
$tt = new TRUCTUAN();
$idsua = 0;
switch ($action) {
    case "trangchu":
        header("location:../../index.php");
        break;
    case "dangnhap":
        header("location:../ktnguoidung/index.php?action=dangnhap");
        break;
        /*case "thongtin":
        include("../tongkettuan/index.php");
        break;
    case "noiquy":
        header("location:../noiquy/index.php");
        break;
    case "tructuan":
        include("../tructuan/index.php");
        break;
    case "tongkettuan":
        header("location:../tongkettuan/index.php");
        break;
    case "bangdieukhien":
        header("index.php");
        break;*/
    case "danhsach":
        $dsnamhoc = $nh->laydanhsachnamhoc();
        $namcuoi = $nh->laynamhoc();
        $selectnamhoc = $namcuoi["max(id)"];
        $selectkhoi = 0;
        $selectlop = 0;
        $khoi = $kh->laydanhsachkhoi();
        $khoidau = $kh->layidkhoidau();
        $lop = $lp->layloptheokhoi($selectkhoi);
        $hocsinh = $hs->layhocsinh($selectnamhoc, $selectlop);
        $thongbao = '';
        include("main.php");
        break;
    case "xacnhan":
        $dsnamhoc = $nh->laydanhsachnamhoc();
        $namcuoi = $nh->laynamhoc();

        $khoi = $kh->laydanhsachkhoi();
        $khoidau = $kh->layidkhoidau();
        $selectnamhoc = $_POST["selectnamhoc"];
        $selectkhoi = $_POST["selectkhoi"];
        if (isset($_POST["selectlop"])) {
            $selectlop = $_POST["selectlop"];
        } else {
            $selectlop = 0;
        }
        if ($selectlop != 0) {
            $tongsotrang = $hs->demtongsohocsinh($selectlop);
            if (!isset($_GET["trang"])) {
                $tranghh = 1;
            } else {
                $tranghh = $_GET["trang"];
            }
            $batdau = ($tranghh - 1) * 10;
            $mathang = $hs->layhocsinhtrongkhoang($batdau, 10);
        }
        $lop = $lp->layloptheokhoi($selectkhoi);
        $thongbao = '';
        $hocsinh = $hs->layhocsinh($selectnamhoc, $selectlop);

        include("main.php");
        break;
    case "themhocsinh":
        $dsnamhoc = $nh->laydanhsachnamhoc();

        $khoi = $kh->laydanhsachkhoi();
        $selectnamhoc = $_POST["namhoc"];
        $selectkhoi = $_POST["khoi"];
        $selectlop = $_POST["lop"];
        $lop = $lp->layloptheokhoi($selectkhoi);
        include("add.php");
        break;
    case "xulythemhocsinh":
        $dsnamhoc = $nh->laydanhsachnamhoc();
        $namcuoi = $nh->laynamhoc();

        $khoi = $kh->laydanhsachkhoi();
        $selectnamhoc = $_POST["selectnamhoc"];
        $selectkhoi = $_POST["selectkhoi"];
        $selectlop = $_POST["selectlop"];
        $lop = $lp->layloptheokhoi($selectkhoi);

        $ho = $_POST["txtho"];
        $ten = $_POST["txtten"];
        $hoten= mb_strtoupper($ho.' '.$ten, 'UTF-8');

        $gioitinh = $_POST["gioitinh"];
        $ngaysinh = $_POST["txtngaysinh"];
        $kiemtrahocsinh=$hs->layhocsinhtheoten($selectnamhoc,$selectlop,$hoten);
        if($kiemtrahocsinh!=null)
        {
            $thongbao = 'Lớp đã có học sinh tên: '.$hoten.'. Vui lòng thêm kí hiệu để phân biệt';
        }
        else
        {
            $hs->themhocsinh($ho, $ten, $gioitinh, $ngaysinh, $selectnamhoc, $selectlop);
            $thongbao = '';
        }  
        $hocsinh = $hs->layhocsinh($selectnamhoc, $selectlop);
       
        include("main.php");
        break;
    case "suahocsinh":
        $dsnamhoc = $nh->laydanhsachnamhoc();

        $khoi = $kh->laydanhsachkhoi();

        $idsua = $_GET["id"];
        $hocsinhhientai = $hs->layhocsinhtheoid($idsua);
        $selectnamhoc = $hocsinhhientai["namhoc_id"];
        $selectlop = $hocsinhhientai["lop_id"];
        $laykhoi = $lp->layloptheoid($selectlop);
        $selectkhoi = $laykhoi["khoi_id"];
        $lop = $lp->layloptheokhoi($selectkhoi);
        include("update.php");
        break;
    case "xulysuahocsinh":
        $dsnamhoc = $nh->laydanhsachnamhoc();
        $namcuoi = $nh->laynamhoc();

        $khoi = $kh->laydanhsachkhoi();
        $selectnamhoc = $_POST["selectnamhoc"];
        $selectkhoi = $_POST["selectkhoi"];
        $selectlop = $_POST["selectlop"];
        $lop = $lp->layloptheokhoi($selectkhoi);

        $id = $_POST["txtid"];
        $ho = $_POST["txtho"];
        $ten = $_POST["txtten"];
        $gioitinh = $_POST["gioitinh"];
        $ngaysinh = $_POST["txtngaysinh"];

        $hs->suahocsinh($id, $ho, $ten, $gioitinh, $ngaysinh, $selectnamhoc, $selectlop);
        $hocsinh = $hs->layhocsinh($selectnamhoc, $selectlop);
        $thongbao = '';
        include("main.php");
        break;
    case "xoahocsinh":
        $dsnamhoc = $nh->laydanhsachnamhoc();

        $khoi = $kh->laydanhsachkhoi();
        $hientai = $hs->layhocsinhtheoid($_GET["id"]);
        $selectnamhoc = $hientai["namhoc_id"];
        $selectlop = $hientai["lop_id"];
        $laykhoi = $lp->layloptheoid($selectlop);
        $selectkhoi = $laykhoi["khoi_id"];
        $lop = $lp->layloptheokhoi($selectkhoi);
        //Kiểm tra học sinh có vi phạm trước khi xóa
        $lanvipham = $tt->laysolanvipham($_GET["id"]);
        if ($lanvipham["count(hocsinh_id)"] != 0) {
            $hs->xoahocsinh($_GET["id"]);
        } else {
            $hs->xoahocsinh_vipham($_GET["id"]);
        }

        $hocsinh = $hs->layhocsinh($selectnamhoc, $selectlop);
        $thongbao = '';
        include("main.php");
        break;
    case "importfile":
        $dsnamhoc = $nh->laydanhsachnamhoc();
        $namcuoi = $nh->laynamhoc();

        $khoi = $kh->laydanhsachkhoi();
        $khoidau = $kh->layidkhoidau();
        $selectnamhoc = $_POST["idnamhoc"];
        $selectkhoi = $_POST["idkhoi"];
        $selectlop = $_POST["idlop"];
        $lop = $lp->layloptheokhoi($selectkhoi);
        $hocsinh = $hs->layhocsinh($selectnamhoc, $selectlop);

        if ($_FILES["file"]["name"] == null) {
            $thongbao = 'Vui lòng chọn file';
            include("main.php");
        } else {
            $thongbao = '';
            $file = $_FILES["file"]["tmp_name"];
            $objExcel = PHPExcel_IOFactory::load($file);
            $worksheet = $objExcel->getActiveSheet();
            $highestrow = $objExcel->setActiveSheetIndex()->getHighestRow();
            for ($row = 3; $row <= $highestrow; $row++) {
                $ho = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                $ten = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                $gioitinh = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                $time = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                $timenew = str_replace('/', '-', $time);
                $ngaysinh = date('Y-m-d', strtotime($timenew));

                $id_namhoc = $selectnamhoc;
                $id_lop = $selectlop;
                $hs->themhocsinh($ho, $ten, $gioitinh, $ngaysinh, $id_namhoc, $id_lop);
            }
            $hocsinh = $hs->layhocsinh($selectnamhoc, $selectlop);
            include("main.php");
        }
        break;
    default:
        break;
}
