<?php

class Model_login extends Model
{
    public function __construct(Database $db)
    {
        parent::__construct($db);
    }
    public function get_data($login,$password)
    {
		$secret = "jesse"; // Секретное слово
		$pass=md5($password.$secret);
        $sth = $this->db->prepare("

SELECT *
FROM users
Where login_user = '$login'
AND password_user = '$pass'
    ");
        $sth->execute();
        $row = $sth->fetchAll();
        $count = $sth -> rowCount();
        if($count > 0) {			
            $_SESSION['login']=$login;
            $_SESSION['password']= $pass;
            $_SESSION['loggedIn']= 'true';
            $_SESSION['mail_user']= $pass;
            $_SESSION['role']= $row[0]['role'];
            header('Location: '."/");
			}
    }

    public function registration($login,$password,$email){
        $sth1 = $this->db->prepare("
SELECT *
FROM users
Where login_user = '$login'
    ");
        $sth1->execute();
        $count = $sth1 -> rowCount();
        if($count > 0)
            echo "<script> alert('логин занят!');</script>";
        else{
            if($login!=""){
            $secret = "jesse"; // Секретное слово
            $pass = md5($password.$secret);
            $sth = $this->db->prepare("
INSERT
INTO users 
VALUES ('','$login','$pass','$email','owner');
    ");
            $sth->execute();
            echo "<script> alert('вы зарегестрированы!');</script>";
            }
        }

    }
}
