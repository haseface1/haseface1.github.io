<?php

class Controller_Shop extends Controller
{
	function __construct()
	{
		parent::__construct();
		$this->model = new Model_shop($this->db);
	}

	function action_index()
	{
        if(isset($_POST['submit2'])){
			$data['detal'] = $this->model->get_data($_POST['car_model'],$_POST['category']);
        }else{
            $data['detal'] = $this->model->get_data("","");
        }
		$data['model'] = $this->model->get_model();
		$data['category'] = $this->model->get_category();
		$this->view->generate('shop_view.php', 'template_view.php',$data);
	}
}
