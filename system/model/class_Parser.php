<?php

class model_Parser
{
	private $result = null;
	
	function init($url) 
	{
		$url_e = explode('://', $url);
		$url_d = count($url_e) == 1 ? $url_e[0] : $url_e[1];
		$url_d = idn_to_ascii($url_d);
		
		$url = (count($url_e) == 1) ? $url_d : "{$url_e[0]}://{$url_d}";
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$this->result = curl_exec($ch);
		
		if($this->result === false) return self::error('Ошибка загрузки страницы');
		
		$headers = curl_getinfo($ch);
		
		if($headers['http_code'] != 200) return self::error("Ошибка загрузки страницы ({$headers['http_code']})");
		
		return self::ok();
	}
	
	function link() 
	{
		$matches = null;
		preg_match_all('/<a\s.*?href=[\'"](.*?)[\'"].*?>/si', $this->result, $matches);
		return $matches[1];
	}
	
	function image() 
	{
		$matches = null;
		preg_match_all('/<img\s.*?src=[\'"](.*?)[\'"].*?>/si', $this->result, $matches);
		return $matches[1];
	}
	
	function text($string) 
	{
		$matches = null;
		$result = html_entity_decode(strip_tags($this->result));
		
		$string_length = mb_strlen($string);
		$string = preg_quote($string, "/");
		$before_after = 10;
				
		for($i=0;$i<$before_after;$i++) $result = ' ' . $result;
				
		preg_match_all('/(?=.{' . $before_after . '}' . $string . ')(?=(.{0,' . ( $string_length + $before_after*2 ) . '}))/siu', $result, $matches);
		
		$new_matches = array();
		
		foreach($matches[1] as $match)
		{
			if (mb_check_encoding($match,"UTF-8")) $new_matches[] = '...'.trim($match).'...';
		}
		
		return $new_matches;
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
