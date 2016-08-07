<?php



class MainModel{

	var $model;


	/*
	It will take model name as input and returns its object to be used
	*/
	public function __construct($model_name="")
	{
		$this->model = $model_name;
	}

	public function parseModels(){

		$php_file = file_get_contents('models.php');
		$tokens = token_get_all($php_file);
		$class_token = false;
		$models = Array();
		foreach ($tokens as $token) {
		  if (is_array($token)) {
		    if ($token[0] == T_CLASS) {
		       $class_token = true;
		    } else if ($class_token && $token[0] == T_STRING) {
			$class = $token[1];
			$models[$class] = get_object_vars(new $class);
			$class_token = false;
		    }
		  }       
		}
		return $models;

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

	public function add($args)
	{
		$keys = implode(' , ', array_keys($args));		
		$values =  "'".implode("','", array_values($args))."'";
		
		$sql = "INSERT INTO ".$this->model." ( ".$keys." ) VALUES ( ".$values." )";
		$result = dbSelect($sql);
		return $result;
		
		
	}



}




?>
