<?php

class controller_Main
{
	private $view = null;
	
	function __construct() 
	{
		$this->view = new view_Main();
	}
	
	function main() 
	{
		$this->view->show('main', array('punycode', 'main'));
	}
}