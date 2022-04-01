<?php
class LOP{
    private $id;
	private $lop;
	private $khoi_id;
	
	public function getID(){
        return $this->id;
    }
    public function setID($value){
        $this->id = $value;
    }
	
	
	public function getLop(){
        return $this->lop;
    }
    public function setLop($value){
        $this->lop = $value;
    }
	
	//Lay danh sach lop
	public function laydanhsachlop(){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM lop order by khoi_id,lop";
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
	// Lấy danh sách lop theo khoi
    public function layloptheokhoi($khoi_id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM lop where khoi_id=:khoi_id";
            $cmd = $dbcon->prepare($sql);
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
	// Lấy danh sách lop theo id
    public function layloptheoid($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM lop where id=:id";
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
	 //Kiểm tra lop
     public function kiemtralop($lop){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM lop WHERE UPPER(lop)=:lop";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":lop", $lop);
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
    public function themlop($lop, $khoi_id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "INSERT INTO lop(lop, khoi_id) VALUES(:lop, :khoi_id)";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":lop", $lop);
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

    // Xóa 
    public function xoalop($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "DELETE FROM lop WHERE id=:id";
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
    public function sualop($id, $lop, $khoi_id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "UPDATE lop SET lop=:lop, khoi_id=:khoi_id WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":lop", $lop);
			$cmd->bindValue(":khoi_id", $khoi_id);
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