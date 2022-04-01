<?php
class NGUOIDUNG{
	// khai báo các thuộc tính (SV tự viết)
	
	public function kiemtranguoidunghople($email,$matkhau){
		$db = DATABASE::connect();
		try{
			$sql = "SELECT * FROM nguoidung WHERE email=:email AND matkhau=:matkhau AND trangthai=1 and ghichu=0";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(":email", $email);
			$cmd->bindValue(":matkhau", md5($matkhau));
			$cmd->execute();
			$valid = ($cmd->rowCount () == 1);
			$cmd->closeCursor ();
			return $valid;			
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}
	
	// lấy thông tin người dùng có $email
	public function laythongtinnguoidung($email){
		$db = DATABASE::connect();
		try{
			$sql = "SELECT * FROM nguoidung WHERE email=:email and ghichu=0";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(":email", $email);
			$cmd->execute();
			$ketqua = $cmd->fetch();
			$cmd->closeCursor();
			return $ketqua;
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	
	// lấy tất cả ng dùng
	public function laydanhsachnguoidung(){
		$db = DATABASE::connect();
		try{
			$sql = "SELECT * FROM nguoidung where ghichu=0 order by loai desc";
			$cmd = $db->prepare($sql);			
			$cmd->execute();
			$ketqua = $cmd->fetchAll();			
			return $ketqua;
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	// Thêm nd mới, trả về khóa của dòng mới thêm
	public function themnguoidung($hoten,$email,$matkhau,$lop,$loai,$sodienthoai,$hinhanh){
		$db = DATABASE::connect();
		try{
			$sql = "INSERT INTO nguoidung(hoten, email, matkhau, lop, loai, trangthai, sodienthoai, hinhanh) VALUES(:hoten, :email, :matkhau,:lop,:loai,0,:sodienthoai, :hinhanh)";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':hoten',$hoten);
            $cmd->bindValue(':email',$email);
			$cmd->bindValue(':matkhau',md5($matkhau));
            $cmd->bindValue(':lop',$lop);
            $cmd->bindValue(':loai',$loai);
			$cmd->bindValue(':sodienthoai',$sodienthoai);
			$cmd->bindValue(':hinhanh',$hinhanh);
			$cmd->execute();
			$id = $db->lastInsertId();
			return $id;
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	// Cập nhật thông tin ng dùng: họ tên, số đt, email
	public function capnhatnguoidung($id,$hoten,$email,$sodienthoai,$hinhanh){
		$db = DATABASE::connect();
		try{
			$sql = "UPDATE nguoidung set hoten=:hoten, email=:email, sodienthoai=:sodienthoai, hinhanh=:hinhanh where id=:id";
			$cmd = $db->prepare($sql);	
			$cmd->bindValue(':hoten',$hoten);
			$cmd->bindValue(':email',$email);
			$cmd->bindValue(':sodienthoai',$sodienthoai);
			$cmd->bindValue(':hinhanh',$hinhanh);
			$cmd->bindValue(':id',$id);
			$ketqua = $cmd->execute();            
            return $ketqua;
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}
	//Xóa người dùng bằng cách gán ghichu=1
	public function xoanguoidung($id){
		$db = DATABASE::connect();
		try{
			$sql = "UPDATE nguoidung set ghichu=1 where id=:id";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':id',$id);
			$ketqua = $cmd->execute();            
            return $ketqua;
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}
	// Cập nhật thông tin ng dùng:loai, lớp
	public function capnhatloai_lop($id,$loai, $lop){
		$db = DATABASE::connect();
		try{
			$sql = "UPDATE nguoidung set loai=:loai, lop=:lop where id=:id";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':id',$id);
			$cmd->bindValue(':loai',$loai);
			$cmd->bindValue(':lop',$lop);
			$ketqua = $cmd->execute();            
            return $ketqua;
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}
	// Đổi mật khẩu
	public function doimatkhau($email,$matkhau){
		$db = DATABASE::connect();
		try{
			$sql = "UPDATE nguoidung set matkhau=:matkhau where email=:email and ghichu=0";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':email',$email);
			$cmd->bindValue(':matkhau',md5($matkhau));
			$ketqua = $cmd->execute();            
            return $ketqua;
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}
	// Đổi trạng thái (0 khóa, 1 kích hoạt)
	public function doitrangthai($id,$trangthai){
		$db = DATABASE::connect();
		try{
			$sql = "UPDATE nguoidung set trangthai=:trangthai where id=:id";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':id',$id);
			$cmd->bindValue(':trangthai',$trangthai);
			$ketqua = $cmd->execute();            
            return $ketqua;
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}
	//lấy người dùng theo id
	public function laydanhsachnguoidungtheoid($id){
		$db = DATABASE::connect();
		try{
			$sql = "SELECT * FROM nguoidung where id=:id and ghichu=0";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(":id", $id);		
			$cmd->execute();
			$ketqua = $cmd->fetch();			
			return $ketqua;
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}
}
?>
