<?php

class model_Results
{
	static function all() 
	{
		$result = pg_query("
			SELECT row_number() OVER(ORDER BY parse_id) as n,
			parse_id as id,
			to_char(parse_time, 'DD.MM.YYYY HH24:MI:SS') as date,
			parse_url as url,
			case parse_type when 'link' then 'Ссылки' when 'image' then 'Картинки' else 'Текст' END as type,
			coalesce(parse_string, '') as string,
			parse_count as count
			FROM tbl_parse
			ORDER BY parse_id ASC
		");
		$return = pg_fetch_all($result);
		return $return;
	}
	
	static function one($id) 
	{
		$result = pg_query_params("
			SELECT
			to_char(parse_time, 'DD.MM.YYYY HH24:MI:SS') as date,
			parse_url as url,
			case parse_type when 'link' then 'Ссылки' when 'image' then 'Картинки' else 'Текст' END as type,
			coalesce(parse_string, '') as string,
			parse_count as count,
			parse_result as result
			FROM tbl_parse
			WHERE parse_id = $1
		", array($id));
		$return = pg_fetch_assoc($result);
		$return['result'] = json_decode($return['result']);
		return $return;
	}
}