<?php
require ("../../PHPMailer-master/src/PHPMailer.php"); 
require ("../../PHPMailer-master/src/SMTP.php"); 
require ("../../PHPMailer-master/src/Exception.php"); 
     function sendmail($mailnhan,$hoten,$maxacnhan)
    {
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);//true:enables exceptions
        try {
            $mail->SMTPDebug = 0; //0,1,2: chế độ debug
            $mail->isSMTP();  
            $mail->CharSet  = "utf-8";
            $mail->Host = 'smtp.gmail.com';  //SMTP servers
            $mail->SMTPAuth = true; // Enable authentication
            $mail->Username = ''; // SMTP username
            $mail->Password = '';   // SMTP password
            $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
            $mail->Port = 465;  // port to connect to                
            $mail->setFrom('lethimytien2503@gmail.com', 'THCS Nguyễn Kim Nha' ); 
            $mail->addAddress($mailnhan, $hoten); 
            $mail->isHTML(true);  // Set email format to HTML
            $mail->Subject = 'Mã xác nhận để lấy lại mật khẩu';
            $noidungthu =$maxacnhan; 
            $mail->Body = "<p>Mã xác nhận của bạn là: </p>".$noidungthu;
            $mail->smtpConnect( array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                    "allow_self_signed" => true
                )
            ));
            $mail->send();
        } catch (Exception $e) {
            echo 'Error: ', $mail->ErrorInfo;
        }
    } 
    
?>