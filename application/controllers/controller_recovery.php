<?php

class Controller_Recovery extends Controller
{
    function __construct()
    {
        parent::__construct();
        @session_start();
        $this->model = new Model_recovery($this->db);
    }

    function action_index()
    {

        if(isset($_POST['recovery_sub']))
            $data['recovery'] = $this->model->recovery($_POST['login_recovery'],$_POST['email_recovery']);
        else
            $data['auth'] = $this->model->recovery("","");
        $this->view->generate('recovery_view.php', 'template_view.php',$data);
    }
}