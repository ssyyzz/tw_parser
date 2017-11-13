<?php

class controller_Results
{
	private $view = null;
	
	function __construct() 
	{
		$this->view = new view_Main();
	}
	
	function main() 
	{
		$data['results'] = model_Results::all();
		$this->view->show('results', array(), $data);
	}
	
	function show($id)
	{
		$id = intval($id);
		$data['result'] = model_Results::one($id);
		$this->view->show('result', array(), $data);
	}
}