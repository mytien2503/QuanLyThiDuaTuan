<?php
class KHOI{
    private $id;
	private $khoi;
	
	public function getID(){
        return $this->id;
    }
    public function setID($value){
        $this->id = $value;
    }
	
	
	public function getKhoi(){
        return $this->khoi;
    }
    public function setKhoi($value){
        $this->khoi = $value;
    }
	
	// Lấy danh sách
    public function laydanhsachkhoi(){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM khoi";
            $cmd = $dbcon->prepare($sql);
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
	//Lấy id khối đầu tiên
	public function layidkhoidau(){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT min(id) FROM khoi";
            $cmd = $dbcon->prepare($sql);
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
    //lấy khối theo id
    public function laykhoitheoid($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM khoi WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $id);
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
    //Kiểm tra khối
    public function kiemtrakhoi($khoi){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM khoi WHERE khoi=:khoi";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":khoi", $khoi);
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
	// Thêm mới
    public function themkhoi($khoi){
        $dbcon = DATABASE::connect();
        try{
            $sql = "INSERT INTO khoi(khoi) VALUES(:khoi)";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":khoi", $khoi);
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
    public function xoakhoi($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "DELETE FROM khoi WHERE id=:id";
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

    // Cập nhật 
    public function suakhoi($id, $khoi){
        $dbcon = DATABASE::connect();
        try{
            $sql = "UPDATE khoi SET khoi=:khoi WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":khoi", $khoi);
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