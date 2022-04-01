<?php
class VIPHAM{
    private $id;
	private $vipham;
	private $diemtru;

    public function getID(){
        return $this->id;
    }
    public function setID($value){
        $this->id = $value;
    }
	
	
	public function getVipham(){
        return $this->vipham;
    }
    public function setVipham($value){
        $this->vipham = $value;
    }
	
	
    public function getDiemtru(){
        return $this->diemtru;
    }
    public function setDiemtru($value){
        $this->diemtru = $value;
    }
	
	
	// Thêm mới
    public function themvipham($vipham, $diemtru){
        $dbcon = DATABASE::connect();
        try{
            $sql = "INSERT INTO vipham(vipham,diemtru, ghichu) VALUES(:vipham, :diemtru, 0)";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":vipham", $vipham);
			$cmd->bindValue(":diemtru", $diemtru);
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
    public function xoavipham($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "DELETE FROM vipham WHERE id=:id";
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
    //Cập nhật ghichu=1 đại diện đã xóa
    public function xoavipham_ghichu($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "UPDATE vipham set ghichu=1  WHERE id=:id";
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
    public function suavipham_ghichu($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "UPDATE vipham set ghichu=0  WHERE id=:id";
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
    public function suavipham($id, $vipham, $diemtru){
        $dbcon = DATABASE::connect();
        try{
            $sql = "UPDATE vipham SET vipham=:vipham,diemtru=:diemtru WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":vipham", $vipham);
			$cmd->bindValue(":diemtru", $diemtru);
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
											
    // Lấy danh sách vi phạm hiện tại
    public function laydanhsachvipham(){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM vipham WHERE ghichu=0";
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
    // Lấy danh sách toàn bộ vi phạm
    public function laytoanbovipham(){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM vipham";
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
	
	//Lấy ten vi phạm theo id
	public function layviphamtheoid($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM vipham where id=:id";
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
    //Kiểm tra vi phạm
    public function kiemtravipham_0($vipham){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM vipham WHERE UPPER(vipham)=:vipham and ghichu=0";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":vipham",$vipham);
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
    public function kiemtravipham_1($vipham){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM vipham WHERE UPPER(vipham)=:vipham and ghichu=1";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":vipham",$vipham);
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
}