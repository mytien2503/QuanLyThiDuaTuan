<?php
class XEPHANG{
    private $id;
	private $diemSDB;
	private $tongdiemtru;
	private $diemdatduoc;
	private $sotiet;
	private $trungbinh;
	private $tuan_id;
	private $lop_id;
	private $khoi_id;

    public function getID(){
        return $this->id;
    }
    public function setID($value){
        $this->id = $value;
    }
	
	public function getDiemSDB(){
        return $this->diemSDB;
    }
    public function setDiemSDB($value){
        $this->diemSDB = $value;
    }
	
	public function getTongdiemtru(){
        return $this->tongdiemtru;
    }
    public function setTongdiemtru($value){
        $this->tongdiemtru = $value;
    }
	
	public function getDiemdatduoc(){
        return $this->diemdatduoc;
    }
    public function setDiemdatduoc($value){
        $this->diemdatduoc = $value;
    }
	
	public function getSotiet(){
        return $this->sotiet;
    }
    public function setSotiet($value){
        $this->sotiet = $value;
    }
	
	public function getTrungbinh(){
        return $this->trungbinh;
    }
    public function setTrungbinh($value){
        $this->trungbinh = $value;
    }
    
	
	public function getTuan_id(){
        return $this->tuan_id;
    }
    public function setTuan_id($value){
        $this->tuan_id = $value;
    }
											
    // Lấy danh sách xep hang
    public function laydanhsachxephang($tuan_id,$khoi_id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT xh.*,(SELECT COUNT(trungbinh) + 1
                            FROM xephang
                            WHERE tuan_id=:tuan_id and khoi_id=:khoi_id and (trungbinh >xh.trungbinh)
                            ) AS hang
                    FROM xephang xh, lop l
                    WHERE xh.tuan_id=:tuan_id and xh.khoi_id=:khoi_id and l.id=xh.lop_id
                    ORDER by l.lop";
            $cmd = $dbcon->prepare($sql);
			$cmd->bindValue(":tuan_id",$tuan_id);
			$cmd->bindValue(":khoi_id",$khoi_id);
            $cmd->execute();
            $result = $cmd->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    public function laydanhsachxephangtheoid($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM xephang WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
			$cmd->bindValue(":id",$id);
            $cmd->execute();
            $result = $cmd->fetch();
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    //Lấy danh sách xếp hạng theo lop_id để kiểm tra xóa lớp
    public function laydanhsachxephangtheolop_id($lop_id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM xephang WHERE lop_id=:lop_id";
            $cmd = $dbcon->prepare($sql);
			$cmd->bindValue(":lop_id",$lop_id);
            $cmd->execute();
            $result = $cmd->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    //kiểm tra tuần id để chỉnh sửa tuần
     public function laydanhsachxephangtheotuan_id($tuan_id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM xephang WHERE tuan_id=:tuan_id";
            $cmd = $dbcon->prepare($sql);
			$cmd->bindValue(":tuan_id",$tuan_id);
            $cmd->execute();
            $result = $cmd->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
	//them
	public function themxephang($thu2, $thu3, $thu4,$thu5,$thu6,$thu7,$diemSDB,$tongdiemtru,$diemdatduoc,$sotiet,$trungbinh,$tuan_id,$lop_id,$khoi_id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "INSERT INTO xephang(thu2, thu3, thu4,thu5,thu6,thu7,diemSDB,tongdiemtru,diemdatduoc,sotiet,trungbinh,tuan_id,lop_id,khoi_id) 
			VALUES(:thu2, :thu3, :thu4,:thu5,:thu6,:thu7,:diemSDB,:tongdiemtru, :diemdatduoc, :sotiet, :trungbinh, :tuan_id, :lop_id, :khoi_id)";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":thu2", $thu2);
            $cmd->bindValue(":thu3", $thu3);
            $cmd->bindValue(":thu4", $thu4);
            $cmd->bindValue(":thu5", $thu5);
            $cmd->bindValue(":thu6", $thu6);
            $cmd->bindValue(":thu7", $thu7);
            $cmd->bindValue(":diemSDB", $diemSDB);
			$cmd->bindValue(":tongdiemtru", $tongdiemtru);
			$cmd->bindValue(":diemdatduoc", $diemdatduoc);
			$cmd->bindValue(":sotiet", $sotiet);
			$cmd->bindValue(":trungbinh", round($trungbinh,3));
			$cmd->bindValue(":tuan_id", $tuan_id);
			$cmd->bindValue(":lop_id", $lop_id);
			$cmd->bindValue(":khoi_id", $khoi_id);
            $result = $cmd->execute();            
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    public function xoaxephang($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "DELETE FROM xephang WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $id);
            $result = $cmd->execute();            
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    public function suaxephang($id,$thu2, $thu3, $thu4,$thu5,$thu6,$thu7, $diemSDB, $diemdatduoc, $sotiet, $trungbinh){
        $dbcon = DATABASE::connect();
        try{
            $sql = "UPDATE xephang 
            SET 
                thu2=:thu2,
                thu3=:thu3,
                thu4=:thu4,
                thu5=:thu5,
                thu6=:thu6,
                thu7=:thu7,
                diemSDB=:diemSDB,
                diemdatduoc=:diemdatduoc,
                sotiet=:sotiet,
                trungbinh=:trungbinh
            WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":thu2", $thu2);
            $cmd->bindValue(":thu3", $thu3);
            $cmd->bindValue(":thu4", $thu4);
            $cmd->bindValue(":thu5", $thu5);
            $cmd->bindValue(":thu6", $thu6);
            $cmd->bindValue(":thu7", $thu7);
            $cmd->bindValue(":diemSDB", $diemSDB);
            $cmd->bindValue(":diemdatduoc", $diemdatduoc);
            $cmd->bindValue(":sotiet", $sotiet);
            $cmd->bindValue(":trungbinh", round($trungbinh, 3));
            $cmd->bindValue(":id", $id);
            $result = $cmd->execute();            
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    //update điểm trung bình khi sửa bảng trực tuần
    public function updatexephang($tongdiemtru, $tuan_id, $lop_id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "UPDATE xephang 
            set tongdiemtru=:tongdiemtru ,
                diemdatduoc=diemSDB-:tongdiemtru ,
                trungbinh=round((diemSDB-:tongdiemtru)/sotiet, 3)
            where tuan_id=:tuan_id and lop_id=:lop_id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tongdiemtru", $tongdiemtru);
            $cmd->bindValue(":tuan_id", $tuan_id);
            $cmd->bindValue(":lop_id", $lop_id);
            $result = $cmd->execute();            
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    //Kiểm tra xem lớp đã có trong bảng xếp hạng chưa
    public function kiemtraxephang($tuan_id, $lop_id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM xephang WHERE tuan_id=:tuan_id and lop_id=:lop_id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tuan_id", $tuan_id);
            $cmd->bindValue(":lop_id", $lop_id);
            $cmd->execute();
            $result=($cmd->rowCount()==1);
            $cmd->closeCursor();
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
}