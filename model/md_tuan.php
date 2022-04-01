<?php
class TUAN{
    private $id;
	private $tuan;
	private $namhoc_id;
	
	public function getID(){
        return $this->id;
    }
    public function setID($value){
        $this->id = $value;
    }	
	
	public function getTuan(){
        return $this->tuan;
    }
    public function setTuan($value){
        $this->tuan = $value;
    }
	
	public function getNamhoc_id(){
        return $this->namhoc_id;
    }
    public function setNamhoc_id($value){
        $this->namhoc_id = $value;
    }
	
	// Lấy danh sách
    public function laytuantheoid($namhoc_id, $tuan){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM tuan where namhoc_id=:namhoc_id and tuan=:tuan";
            $cmd = $dbcon->prepare($sql);
			$cmd->bindValue(":namhoc_id",$namhoc_id);
			$cmd->bindValue(":tuan",$tuan);
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
    //Lấy khoảng tuần trong năm học
    public function laytuanminmax($namhoc_id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT max(tuan), min(tuan) FROM tuan where namhoc_id=:id";
            $cmd = $dbcon->prepare($sql);
			$cmd->bindValue(":id",$namhoc_id);
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
	//Lấy tuần cuối
    public function laytuantheotuanid($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM tuan where id=:id";
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
    // Thêm mới
    public function themtuan($tuan, $namhoc_id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "INSERT INTO tuan(tuan, namhoc_id) VALUES(:tuan, :namhoc_id)";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tuan", $tuan);
			$cmd->bindValue(":namhoc_id", $namhoc_id);
            $result = $cmd->execute();            
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Xóa 
    public function xoatuan($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "DELETE FROM tuan WHERE id=:id";
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
    // Xóa tuần theo namhoc_id
    public function xoatuan_namhocid($namhoc_id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "DELETE FROM tuan WHERE namhoc_id=:namhoc_id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":namhoc_id", $namhoc_id);
            $result = $cmd->execute();            
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Cập nhật 
    public function suatuan($id, $tuan, $namhoc_id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "UPDATE tuan SET tuan=:tuan, namhoc_id=:namhoc_id WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tuan", $tuan);
			$cmd->bindValue(":namhoc_id", $namhoc_id);
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
}	
?>