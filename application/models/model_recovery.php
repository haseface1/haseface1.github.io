<?php

class Model_recovery extends Model
{
    public function __construct(Database $db)
    {
        parent::__construct($db);
    }

    public function recovery($login, $email)
    {
        $sth = $this->db->prepare("

SELECT *
FROM users
Where login_user = '$login'
AND mail_user = '$email'
    ");
        $sth->execute();
        $count = $sth->rowCount();
        if ($count > 0) {
            //рандомим пароль
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
            $new_password ="";
            $clen = strlen($chars) - 1;
            while (strlen($new_password) < 8) {
                $new_password .= $chars[mt_rand(0,$clen)];
            }
            $secret = "jesse"; // Секретное слово
            $new_password_sql=md5($new_password.$secret);
            $message = "Вы запросили восстановление пароля на сайте sto.ua для учетной записи ".$login.". \nВаш новый пароль: ".$new_password.".\n\n С уважением администрация сайта sto.ua.";
            if(mail($email,"Восстановление пароля",$message,"From: webmaster@sto.ua\r\n"."Reply-To: webmaster@sto.ua\r\n"."X-Mailer: PHP/" . phpversion())) {
                $sth = $this->db->prepare("

UPDATE users
SET password_user='$new_password_sql'
Where login_user = '$login'
    ");
                $sth->execute();
                echo "<script type=text/javascript >alert('Ваш новый пароль отправлен на e-mail: ".$email.".');</script>";
                echo "<script type=text/javascript >window.location.href='/'</script>";


            };


        }
    }
}