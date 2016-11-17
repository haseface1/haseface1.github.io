<?php

class Controller_Portfolio extends Controller
{
    function __construct()
    {
        parent::__construct();
		@session_start();
        $this->model = new Model_portfolio($this->db);		
    }

    function action_index()
    {
        $data['portfolio'] = $this->model->get_portfolio();
        $data['portfolio_foto'] = $this->model->get_portfolio_foto();
        $this->view->generate('portfolio_view.php', 'template_view.php',$data);
    }
}
