<?php
class NAMHOC{
    private $id;
	private $namhoc;
	
	public function getID(){
        return $this->id;
    }
    public function setID($value){
        $this->id = $value;
    }
	
	
	public function getNamhoc(){
        return $this->namhoc;
    }
    public function setNamhoc($value){
        $this->namhoc = $value;
    }
	//danh sách năm học
	public function laydanhsachnamhoc(){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM namhoc order by namhoc";
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
    public function laynamhoctheoid($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM namhoc WHERE id=:id";
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
    //Lấy năm học theo nam
    public function laynamhoctheonam($nam){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM namhoc WHERE namhoc=:nam";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":nam", $nam);
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
	// Lấy nam học
    public function laynamhoc(){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT max(id) FROM namhoc";
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

	// Thêm mới
    public function themnamhoc($namhoc){
        $dbcon = DATABASE::connect();
        try{
            $sql = "INSERT INTO namhoc(namhoc) VALUES(:namhoc)";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":namhoc", $namhoc);
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
    public function xoanamhoc($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "DELETE FROM namhoc WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $id);
            $result = $cmd->execute();            
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            //echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Cập nhật 
    public function suanamhoc($id, $namhoc){
        $dbcon = DATABASE::connect();
        try{
            $sql = "UPDATE namhoc SET namhoc=:namhoc WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":namhoc", $namhoc);
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
    //Kiểm tra năm học
    public function kiemtranamhoc($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT n.namhoc FROM namhoc n, tuan t, xephang xh WHERE n.id=:id and t.namhoc_id=n.id and t.id=xh.tuan_id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $id);
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
    public function kiemtranamhoc_hocsinh($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT n.namhoc FROM namhoc n,hocsinh hs WHERE n.id=:id and n.id=hs.namhoc_id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $id);
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
}	
?>