<?php

class view_Main
{
	private $smarty = null;

	function __construct() 
	{
		$this->smarty = new Smarty();
		$this->smarty->setCompileDir('/tmp');
		$this->smarty->setTemplateDir(SYSTEM . '/templates');
	}
	
	function show($template, $js = array(), $data = array()) 
	{
		$data['js'] = $js;
		$data['menu'] = $template;
		$this->smarty->assign('data', $data);
		$body = $this->smarty->fetch($template.'.tpl');
		$this->smarty->assign('content', $body);
		$this->smarty->display('outer.tpl');
	}
}