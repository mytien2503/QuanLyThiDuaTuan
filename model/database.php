<?php
session_start();
class DATABASE{
    private static $dns = "mysql:host=sql6.freesqldatabase.com;dbname=sql6461210;port=3306";
    private static $username = "sql6461210";
    private static $password = "6cw2vH4pTF";//"vertrigo";
    private static $options = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, 
                                    PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8");    
    private static $db;
    
    private function __construct(){} 
    
    public static function connect(){
        if(!isset(self::$db)){
            try{
                self::$db = new PDO(self::$dns, 
                                    self::$username, 
                                    self::$password, 
                                    self::$options);
            }
            catch(PDOException $e){
                $error_message = $e->getMessage();
                echo "<p>Lỗi kết nối: $error_message</p>";
                exit();
            }
        }
        return self::$db;
    }
    
    public static function close(){
        self::$db = null;
    }
}
?>
