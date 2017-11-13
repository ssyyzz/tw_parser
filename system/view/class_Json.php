<?php

class view_Json
{
	
	function error($message) 
	{
		$return = array(
			'error' => true,
			'message' => $message
		);
		$this->tojson($return);
		exit();
	}

	function ok($data) 
	{
		$return = array(
			'error' => false
		);
		
		$return = $return + $data;
		$this->tojson($return);
		exit();
	}
	
	function tojson($array) 
	{
		echo json_encode($array);
	}
}