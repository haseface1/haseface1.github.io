<?php

class Controller_Admin extends Controller
{
	function __construct()
	{
		parent::__construct();		 	 
		$this->model = new Model_admin($this->db);
	}
    function action_index()
    {		
		$data['category'] = $this->model->get_category();
		$data['model'] = $this->model->get_model();
		
		//показать информацию детали по id детали(поиск)
        if(isset($_POST['p_id_det'])){
            $data['data'] = $this->model->get_data($_POST['id_det']);
            $data['car'] = $this->model->get_car($_POST['id_det']);			
        }else{
			$data['data'] = $this->model->get_data("");
            $data['car'] = $this->model->get_car("");	
		}

		//ИЗМЕНИТЬ информацию детали
		if(isset($_POST['edit_detal'])){
			$count=$_POST['count_model'];
			$count_model_arr[0]=0;
			for($i=0;$i<$count;$i++){			
				$count_model_arr[$i] = $_POST["model_$i"];//масив моделей
			}
			$this->model->get_detal_edit($_POST['id_detal'],$_POST['adress'],$_POST['named'],$_POST['category'],$_POST['prise'],$count_model_arr,$count);			
            $data['data'] = $this->model->get_data($_POST['id_detal']);
            $data['car'] = $this->model->get_car($_POST['id_detal']);	
		}
		//ДОБАВИТЬ деталь
		if(isset($_POST['add_detal'])){
			$count=$_POST['count_model'];
			$count_model_arr[0]=0;
			for($i=0;$i<$count;$i++){			
				$count_model_arr[$i] = $_POST["model_$i"];
			}
			$this->model->get_detal_add($_POST['adress'],$_POST['named'],$_POST['category'],$_POST['prise'],$count_model_arr,$count);			
            $data['data'] = $this->model->get_data($_POST['id_detal']);
            $data['car'] = $this->model->get_car($_POST['id_detal']);		
		}
		//УДАЛИТЬ деталь
		if(isset($_POST['delete_detal'])){
			$this->model->get_detal_delete($_POST['id_detal']);			
            $data['data'] = $this->model->get_data($_POST['id_detal']);
            $data['car'] = $this->model->get_car($_POST['id_detal']);		
		}

		
		//показать информацию портфолио по id 
		if(isset($_POST['Search_id_portfolio'])){
			$data['portfolio'] = $this->model->get_portfolio($_POST['id_portfolio']);
			$data['portfolio_foto'] = $this->model->get_portfolio_foto($_POST['id_portfolio']);
		}else{
			$data['portfolio'] = $this->model->get_data("");
			$data['portfolio_foto'] = $this->model->get_car("");
		}

		//ИЗМЕНИТЬ информацию портфолио
		if(isset($_POST['edit_portfolio'])){
			$count=$_POST['count_foto_portfolio'];
			$count_img_arr[0]=0;
			for($i=1;$i<=$count;$i++){
				$count_img_arr[$i] = $_POST["portf_$i"];//масив моделей
			}
			$this->model->portfolio_edit($_POST['id_portfolio'],$_POST['info_portfolio'],$count_img_arr,$count);
			$data['portfolio'] = $this->model->get_portfolio($_POST['id_portfolio']);
			$data['portfolio_foto'] = $this->model->get_portfolio_foto($_POST['id_portfolio']);
		}
		//ДОБАВИТЬ деталь
		if(isset($_POST['add_portfolio'])){
			$count=$_POST['count_foto_portfolio'];
			$count_img_arr[0]=0;
			for($i=1;$i<=$count;$i++){
				$count_img_arr[$i] = $_POST["portf_$i"];//масив моделей
			}
			$this->model->portfolio_add($_POST['id_portfolio'],$_POST['info_portfolio'],$count_img_arr,$count);
			$data['portfolio'] = $this->model->get_portfolio($_POST['id_portfolio']);
			$data['portfolio_foto'] = $this->model->get_portfolio_foto($_POST['id_portfolio']);
		}
		//УДАЛИТЬ деталь
		if(isset($_POST['delete_portfolio'])){
			$this->model->portfolio_delete($_POST['id_portfolio']);
			$data['portfolio'] = $this->model->get_portfolio($_POST['id_portfolio']);
			$data['portfolio_foto'] = $this->model->get_portfolio_foto($_POST['id_portfolio']);
		}
		
        $this->view->generate('admin_view.php', 'template_view.php',$data);

    }
}