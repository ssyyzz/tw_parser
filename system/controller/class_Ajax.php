<?php

class controller_Ajax
{
	function __construct() 
	{
		$this->view = new view_Json();
	}

	function main() 
	{
		$valid_post = model_Validator::post(array('url','type'));
		if ($valid_post['error']) $this->view->error($valid_post['message']);

		$url = $_POST['url'];
		$type = $_POST['type'];
		
		if($type === 'text') 
		{
			$valid_post = model_Validator::post('string');
			if ($valid_post['error']) $this->view->error($valid_post['message']);
			
			$string = $_POST['string'];
		}
		
		$valid_url = model_Validator::url($url);
		if ($valid_url['error']) $this->view->error($valid_url['message']);
		
		$valid_type = model_Validator::type($type);
		if ($valid_type['error']) $this->view->error($valid_type['message']);
		
		$parser = new model_Parser();
		$parser_init = $parser->init($url);
		
		if ($parser_init['error']) $this->view->error($parser_init['message']);
		
		switch($type) 
		{
			case 'link':
				$result = $parser->link();
				break;
			case 'image':
				$result = $parser->image();
				break;
			case 'text':
				$result = $parser->text($string);
				break;
		}
		
		$params = array(
			$url,
			json_encode($result),
			count($result),
			$type,
			(isset($string) ? $string : NULL)
		);
		$db_result = pg_query_params("INSERT INTO tbl_parse (parse_url, parse_result, parse_count, parse_type, parse_string) VALUES ($1, $2, $3, $4, $5) RETURNING parse_id", $params);
		if(!$db_result) $this->view->error(pg_last_error());
		
		$id = pg_fetch_result($db_result, 'parse_id');
		$this->view->ok(array('id' => $id));

	}
}