<?php

class Controller {
	
	public $model;
	public $view;
	public $db;
	
	function __construct()
	{
		$this->view = new View();
		try {
			$this->db = new Database();
		    } catch (PDOException $e) {

		echo $e->getMessage();
		}
	}
	
	// действие (action), вызываемое по умолчанию
	function action_index()
	{
		
	}

}
