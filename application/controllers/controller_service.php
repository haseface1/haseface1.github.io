<?php

class Controller_Service extends Controller
{

	function action_index()
	{
		$this->view->generate('service_view.php', 'template_view.php');
	}
}
