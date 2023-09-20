<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class Controller
{

    protected $header;
    protected $footer;
    protected $title;
    protected $user;

    public function __construct()
    {
        $this->header = VIEW . "layout/header.php";
        $this->footer = VIEW . "layout/footer.php";

        $this->title = "Home";
        $this->user = $this->get_logged_in_user();
    }

    protected function get_header()
    {
        return $this->header;
    }

    protected function get_footer()
    {
        return $this->footer;
    }

    protected function load_model($model_name)
    {
        $path = "models/" . $model_name . ".php";
        if (file_exists($path)) {
            require_once($path);
            return new $model_name();
        } else {
            return null;
        }
    }

    public function is_admin_logged_in()
    {
        return isset($_SESSION["admin"]);
    }

    public function is_logged_in()
    {
        return isset($_SESSION["user"]);
    }

    public function get_logged_in_user()
    {
        if (isset($_SESSION["user"]))
            return $_SESSION["user"];
        else
            return null;
    }

    public function do_logout()
    {
        unset($_SESSION["user"]);
        unset($_SESSION["admin"]);

        session_destroy();
        header("Location: " . URL . "user/login");
    }

    public function goto_admin_login()
    {
        header("Location: " . URL . "admin/login");
    }

    public function get_logged_in_admin()
    {
        if ($this->is_admin_logged_in())
            return $this->load_model("AdminModel")->get_admin($_SESSION["admin"]);
        else
            return null;
    }

    public function time_elapsed_string($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    public function send_mail($to, $name, $amount, $price)
    {
        $total = $price*$amount;
        require 'public/PHPMailer/src/Exception.php';
        require 'public/PHPMailer/src/PHPMailer.php';
        require 'public/PHPMailer/src/SMTP.php';

        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                    
            $mail->isSMTP();                                           
            $mail->Host       = 'smtp.gmail.com';                    
            $mail->SMTPAuth   = true;                              
            $mail->Username   = MAIL;              
            $mail->Password   = MAIL_PASS;                            
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;          
            $mail->Port       = 465;                                
        
            //Recipients
            $mail->setFrom(MAIL, 'Book of Bunny');   
            $mail->addAddress($to);               

            //Content
            $mail->isHTML(true);                             
            $mail->Subject = 'Mua hang thanh cong';
            $mail->Body    = 'Bạn đã mua <b>' . $amount . '</b> cuốn sách ' . $name . '. Tổng giá là <b>' . number_format($total) . '</b> vnđ';
        
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
