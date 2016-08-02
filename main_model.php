<?php

class MainModel{

	var $model;
	var $mysql;


	/*
	It will take model name as input and returns its object to be used
	*/
	public function __construct($model_name)
	{
		$this->model = $model_name;
	}

	/* 
	Implode array into new key or values array 
	eg.
	$col = $this->implodeArray('keys',$args);
	$val = $this->implodeArray('values',$args);
	*/

	private function implodeArray($mode,$array) {
		if($mode == 'keys'){
        	return '`'.implode("`,`",array_keys($array)).'`';
        }elseif($mode == 'values'){
        	return '\''.implode("','",array_values($array)).'\'';
        }
        else{
        	return implode(",",$array);
        }
	}


	public function get($args)
	{
		//print_r($args);
		$output = implode(' and ', array_map(
		    function ($v, $k) { return sprintf("%s='%s'", $k, $v); },
		    $args,
		    array_keys($args)
		));
		$sql = "SELECT *  FROM ".$this->model." WHERE ".$output;
		//echo $sql;
		$result = dbSelect($sql);
		return $result;
		
		
	}



}




?>
