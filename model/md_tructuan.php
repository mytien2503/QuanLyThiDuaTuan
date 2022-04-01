<?php
class TRUCTUAN{
    private $id;
	private $solan;
	private $tongdiemtru;
	private $tuan_id;
	private $hocsinh_id;
	private $vipham_id;

    public function getID(){
        return $this->id;
    }
    public function setID($value){
        $this->id = $value;
    }
	
	
	public function getSolan(){
        return $this->solan;
    }
    public function setSolan($value){
        $this->solan = $value;
    }
	
	
    public function getTongdiemtru(){
        return $this->tongdiemtru;
    }
    public function setTongdiemtru($value){
        $this->tongdiemtru = $value;
    }
	
	public function getTuan_id(){
        return $this->tuan_id;
    }
    public function setTuan_id($value){
        $this->tuan_id = $value;
    }
	
	public function getHocsinh_id(){
        return $this->hocsinh_id;
    }
    public function setHocsinh_id($value){
        $this->hocsinh_id = $value;
    }
	
	public function getVipham_id(){
        return $this->vipham_id;
    }
    public function setVipham_id($value){
        $this->vipham_id = $value;
    }											
    // Lấy danh sách truc tuan theo tuan
    public function laydanhsachtructuan($tuan_id,$lop_id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT hs.ho, hs.ten,hs.namhoc_id,hs.lop_id,tt.*,vipham FROM hocsinh hs, tructuan tt, vipham vp WHERE hs.id=tt.hocsinh_id and tt.tuan_id=:tuan_id and hs.lop_id=:lop_id and vp.id=tt.vipham_id ORDER by hs.id, tt.id";
            $cmd = $dbcon->prepare($sql);
			$cmd->bindValue(":tuan_id", $tuan_id);
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

    public function counthocsinh($tuan_id,$lop_id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT tt.*,hs.lop_id, count(hocsinh_id) FROM tructuan tt, hocsinh hs, lop l  WHERE tt.tuan_id=:tuan_id and tt.hocsinh_id=hs.id and hs.lop_id=l.id and hs.lop_id=:lop_id
            GROUP by hocsinh_id
            ORDER by hocsinh_id, id";
            $cmd = $dbcon->prepare($sql);
			$cmd->bindValue(":tuan_id", $tuan_id);
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
    public function laydanhsachtructuantheoid($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM tructuan where id=:id";
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
    //KIểm tra xem vipham có trong trực tuần
    public function kiemtratructuan_vipham($vipham_id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM tructuan WHERE vipham_id=:vipham_id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":vipham_id", $vipham_id);
            $cmd->execute();
            $result=($cmd->rowCount()>0);
            $cmd->closeCursor();
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    //Kiểm tra học sinh có vi phạm trong tuần
    //KIểm tra xem vipham có trong trực tuần
    public function kiemtrahocsinh_vipham($tuan_id,$hocsinh_id,$vipham_id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM tructuan WHERE vipham_id=:vipham_id and tuan_id=:tuan_id and hocsinh_id=:hocsinh_id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tuan_id", $tuan_id);
            $cmd->bindValue(":vipham_id", $vipham_id);
            $cmd->bindValue(":hocsinh_id", $hocsinh_id);
            $cmd->execute();
            $result=($cmd->rowCount()>0);
            $cmd->closeCursor();
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
	//đếm số lần học sinh vi phạm
    public function laysolanvipham($hocsinh_id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT count(hocsinh_id) FROM tructuan where hocsinh_id=:id";
            $cmd = $dbcon->prepare($sql);
			$cmd->bindValue(":id", $hocsinh_id);
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
    //Dữ liệu thống kê theo tuần
    public function laythongkevipham($tuan_id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "select v.vipham, count(t.vipham_id) as soluot FROM vipham v, tructuan t, hocsinh h 
            WHERE v.id=t.vipham_id and t.tuan_id=:tuan_id and t.hocsinh_id=h.id 
           
            group by t.vipham_id
            order by soluot desc";
            $cmd = $dbcon->prepare($sql);
			$cmd->bindValue(":tuan_id", $tuan_id);
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
    //Dữ liệu thống kê theo tuần
    public function laythongke($tuan_id){
        $dbcon = DATABASE::connect();
        try{
            $data = array();
            $sql = "select v.vipham, count(t.vipham_id) as soluot FROM vipham v, tructuan t, hocsinh h 
            WHERE v.id=t.vipham_id and t.tuan_id=:tuan_id and t.hocsinh_id=h.id 
            group by t.vipham_id
            order by soluot desc
            limit 5";
            $cmd = $dbcon->prepare($sql);
			$cmd->bindValue(":tuan_id", $tuan_id);
            $cmd->execute();
            $result = $cmd->fetchAll();
            foreach($result as $row){
                $data[] = $row;
            }
            return $data;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    //Thêm
    public function themtructuan($solan, $tongdiemtru, $tuan_id, $hocsinh_id,$vipham_id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "INSERT INTO tructuan(solan, tongdiemtru, tuan_id, hocsinh_id,vipham_id) VALUES(:solan, :tongdiemtru, :tuan_id, :hocsinh_id,:vipham_id)";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":solan", $solan);
            $cmd->bindValue(":tongdiemtru", $tongdiemtru);
            $cmd->bindValue(":tuan_id", $tuan_id);
            $cmd->bindValue(":hocsinh_id", $hocsinh_id);
            $cmd->bindValue(":vipham_id", $vipham_id);
            $result = $cmd->execute();            
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    public function suatructuan($id,$solan, $tongdiemtru, $tuan_id, $hocsinh_id,$vipham_id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "UPDATE tructuan SET
            solan=:solan, 
            tongdiemtru=:tongdiemtru, 
            tuan_id=:tuan_id, 
            hocsinh_id=:hocsinh_id,
            vipham_id=:vipham_id
            WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":solan", $solan);
            $cmd->bindValue(":tongdiemtru", $tongdiemtru);
            $cmd->bindValue(":tuan_id", $tuan_id);
            $cmd->bindValue(":hocsinh_id", $hocsinh_id);
            $cmd->bindValue(":vipham_id", $vipham_id);
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
    public function xoatructuan($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "DELETE FROM tructuan WHERE id=:id";
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
}