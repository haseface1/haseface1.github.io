<?php

class Controller_Login extends Controller
{
    function __construct()
    {
        parent::__construct();
		@session_start();
        $this->model = new Model_login($this->db);		
    }

    function action_index()
    {
		
        if(isset($_POST['login_sub']))
            $data['auth'] = $this->model->get_data($_POST['login'],$_POST['password']);
        else
            $data['auth'] = $this->model->get_data("","");
        if(isset($_POST['regist_sub']))
            $data['regist'] = $this->model->registration($_POST['login_reg'],$_POST['password_reg1'],$_POST['email_reg']);
        else
            $data['regist'] = $this->model->registration("","","");
        $this->view->generate('login_view.php', 'template_view.php',$data);
    }
}
