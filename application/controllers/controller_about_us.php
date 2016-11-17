<?php

class Controller_About_us extends Controller
{

	function action_index()
	{	
		$this->view->generate('about_us_view.php', 'template_view.php');
	}
}