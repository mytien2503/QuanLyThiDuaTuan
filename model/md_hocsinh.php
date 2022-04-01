<?php
class HOCSINH{
    private $id;
	private $ho;
    private $ten;
	private $gioitinh;
	private $ngaysinh;
	private $lop_id;
	private $namhoc_id;

    public function getID(){
        return $this->id;
    }
    public function setID($value){
        $this->id = $value;
    }
	
	
	public function getHo(){
        return $this->ho;
    }
    public function setHo($value){
        $this->ho = $value;
    }
	
	
    public function getTen(){
        return $this->ten;
    }
    public function setTen($value){
        $this->ten = $value;
    }
	
	
	public function getGioitinh(){
        return $this->gioitinh;
    }
    public function setGioitinh($value){
        $this->gioitinh = $value;
    }
	
	
	public function getNgaysinh(){
        return $this->ngaysinh;
    }

    public function setNgaysinh($value){
        $this->Ngaysinh = $value;
    }											
    // Lấy danh sách
    public function layhocsinh($nam,$lop){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM hocsinh where ghichu=0 and namhoc_id=:id and lop_id=:lid";
            $cmd = $dbcon->prepare($sql);
			$cmd->bindValue(":id", $nam);
			$cmd->bindValue(":lid", $lop);
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
    public function layhocsinh_tructuan($nam,$lop){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM hocsinh where namhoc_id=:id and lop_id=:lid";
            $cmd = $dbcon->prepare($sql);
			$cmd->bindValue(":id", $nam);
			$cmd->bindValue(":lid", $lop);
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

    // Lấy hocsinh theo id
    public function layhocsinhtheoid($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM hocsinh WHERE id=:id";
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
    //Lấy học sinh theo lop để kiểm tra xóa lớp
     // Lấy hocsinh theo id
     public function layhocsinhtheolop_id($lop_id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM hocsinh WHERE lop_id=:lop_id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":lop_id", $lop_id);
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
	//lấy học sinh theo tên
    public function layhocsinhtheoten($namhoc_id, $lop_id, $ten){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM hocsinh WHERE namhoc_id=:namhoc_id and lop_id=:lop_id and CONCAT(upper(ho),' ', upper(ten))=:ten";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":namhoc_id", $namhoc_id);
            $cmd->bindValue(":lop_id", $lop_id);
            $cmd->bindValue(":ten", $ten);
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
    public function themhocsinh($ho, $ten, $gioitinh, $ngaysinh, $namhoc_id, $lop_id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "INSERT INTO hocsinh(ho, ten, gioitinh, ngaysinh, namhoc_id, lop_id, ghichu) 
			VALUES(:ho, :ten, :gioitinh, :ngaysinh, :namhoc_id, :lop_id, 0)";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":ho", $ho);
			$cmd->bindValue(":ten", $ten);
			$cmd->bindValue(":gioitinh",$gioitinh);
			$cmd->bindValue(":ngaysinh",$ngaysinh);
			$cmd->bindValue(":namhoc_id",$namhoc_id);
			$cmd->bindValue(":lop_id",$lop_id);
            $result = $cmd->execute();            
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    //chỉ cập nhật lại học sinh do học sinh có nằm trong bảng vi phạm 
    public function xoahocsinh($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "UPDATE hocsinh SET ghichu=1 WHERE id=:id";
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
     //chỉ cập nhật lại học sinh do học sinh có nằm trong bảng vi phạm 
     public function xoahocsinh_vipham($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "DELETE FROM hocsinh  WHERE id=:id";
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
    public function suahocsinh($id, $ho, $ten, $gioitinh, $ngaysinh, $namhoc_id, $lop_id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "UPDATE hocsinh SET ho=:ho, ten=:ten, gioitinh=:gioitinh, ngaysinh=:ngaysinh, namhoc_id=:namhoc_id, lop_id=:lop_id WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":ho", $ho);
			$cmd->bindValue(":ten", $ten);
			$cmd->bindValue(":gioitinh",$gioitinh);
			$cmd->bindValue(":ngaysinh",$ngaysinh);
			$cmd->bindValue(":namhoc_id",$namhoc_id);
			$cmd->bindValue(":lop_id",$lop_id);
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
    //Tổng số học sinh theo lop chia 10 ra tổng số trang
    public function demtongsohocsinh($lop_id)
    {
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT ceil(count(*)/10) as tongsotrang FROM hocsinh where lop_id=:lop_id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":lop_id", $lop_id);
            $cmd->execute();
            $ketqua = $cmd->fetchColumn();
            return $ketqua;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    //lấy danh sách hocsinh trong khoang chỉ định
    public function layhocsinhtrongkhoang($batdau, $soluong)
    {
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM hocsinh 
            ORDER BY id DESC 
            LIMIT $batdau, $soluong";
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $ketqua = $cmd->fetchAll();
            return $ketqua;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
}
?>
