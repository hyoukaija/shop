<?php
namespace app\phpemail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class GetOrder
{
    public function sendMail()
    {
        require '../vendor/autoload.php';
        $mail = new PHPMailer(true);

        try{
            $mail->SMTPDebug = 0;                                    // 开启Debug
            $mail->isSMTP();                                        // 使用SMTP
            $mail->Host = 'smtp.163.com';                        // 服务器地址
            $mail->SMTPAuth = true;                                    // 开启SMTP验证
            $mail->Username = 'jpinformation@163.com';                // SMTP 用户名（你要使用的邮件发送账号）
            $mail->Password = '83k521scv';                                // SMTP 密码
            $mail->SMTPSecure = 'ssl';                                // 开启TLS 可选
            $mail->Port = 465;                                       // 端口
            $mail->CharSet = 'utf-8';

            // 收件人
            $mail->setFrom('jpinformation@163.com', 'SandBoxCn');      // 可以只传邮箱地址
            $mail->addAddress('bigblbufly@gmail.com','お客様');
            $mail->addReplyTo('jpinformation@163.com', 'SandBoxCn');        // 回复地址
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
            // 附件
            // 内容
            $mail->isHTML(true);                                        // 设置邮件格式为HTML
            $mail->Subject = '下单成功（自动发送）';
            $mail->Body    = '感谢您下单，';
            $mail->send();
            echo '邮件发送成功。<br>';
        } catch (Exception $e) {
            echo '邮件发送失败。<br>';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }
}



?>