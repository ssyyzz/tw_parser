<?php
	
class model_Validator 
{
	
	private static $allowed_types = array('link','image','text');
	
	static function post($array)
	{
		if(is_string($array)) $array = array($array);
		
		$not_set = array();
		foreach($array as $value)
		{
			if(!isset($_POST[$value]) || $_POST[$value] == '') $not_set[] = $value;
		}
		
		if(count($not_set)==0) return self::ok();
		else 
		{
			$not_set = implode(', ', $not_set);
			$message = "Не заданы параметры: {$not_set}";
			return self::error($message);
		}
	}
	
	static function url($url)
	{
		$matches = null;
		preg_match('/^(https?:\/\/)?(.*?)(?:\/|$)/i', $url, $matches);
		
		$url_puny = idn_to_ascii($matches[2]);
		
		if(preg_match('/^(?:[a-z0-9][a-z0-9-]*[a-z0-9]\.)+(?:[a-z0-9][a-z0-9-]*[a-z0-9])(?::\d{0,5})?$/i', $url_puny) === false) return self::error('Указан некорректный домен');
		
		if($url != $matches[0]) return self::error('Укажите адрес главной страницы (без пути, только домен)');

		return self::ok();
	}
	
	static function type($type)
	{
		if (in_array($type, self::$allowed_types)) return self::ok();
		else return self::error('Недопустимый тип поиска');
	}
	
	static function ok()
	{
		return array('error' => false);
	}
	
	static function error($message)
	{
		return array('error' => true, 'message' => $message);
	}
}