<?php

class TableGenerator{

	var $schema;

	public function __construct()
	{
		//$this->mysqli = global $mysqli;
	}

	/* 
	This method will checks if models are synced with database tables or not. If there is difference it will call generateTableDefinition to 		update the table  
	*/
	public function checkMigrations($models)
	{

		foreach( $models as $model => $fields ){
			
			return $this->generateTableDefinition($model,$fields);
			

		}

	}


	/*
	Method to generate Table Definition
	*/
	private function generateTableDefinition($name,$fields)
	{
		$this->schema = 'CREATE TABLE '.$name.' ( ';
		foreach ( $fields as $fieldname => $properties ){
			if(!isset($properties['type'])){
				echo 'throw error : type is not defined';
				break;
			}
			$this->schema .= $fieldname. ' '.$this->getTypeDefinition($properties);


			foreach( $properties as $key => $value ){
				$this->schema .= $this->getKeyDefinition($key,$value). ' ';
			}
	
			$this->schema .= ' , ';
		}
		$this->schema[strlen($this->schema)-2] = ')';
		$this->schema[strlen($this->schema)-1] = ';';
		return $this->schema;

	}

	/*
		Method to get SQL schema for table Key attributes
	*/
	private function getKeyDefinition($key,$value)
	{
		$extra_prop = Array('null'=>'NOT NULL','auto_inc'=>'AUTO_INCREMENT','default'=>'default','primary_key'=>'PRIMARY KEY');
		$sql = "";
		switch($key){
			case 'primary_key': $sql = $extra_prop[$key];
			case 'null':if($value=="true"){ $sql = $extra_prop[$key];}
						break;
			case 'auto_inc':
						//First check if primary key is set
						if(strpos($this->schema,$extra_prop['primary_key']) !== false ){
							$sql = $extra_prop[$key];
						}else{
							echo 'primary_key must be set before auto_inc';
							exit(0);
						}
						break;
			case 'default': $sql = $extra_prop[$key]. ' '.'\''.$value.'\'';
						break;
			default:

		}
		return $sql;
	}

	/*
	Method to check max length of data types
	*/
	private function checkMaxLength($type,$length){
		$type_length = Array('int'=>'11', 'varchar'=>'255');
		if($length > $type_length[$type]){
			// THROW ERROR
			echo $type.' Must not have length greater than '.$type_length[$type];
			exit(0);
		}else{
			return true;
		}
	}

	/*
	Method to get DataType definition
	*/
	private function getTypeDefinition($properties)
	{
		$sql = "";
		if(isset($properties['max_length'])){
			if($this->checkMaxLength($properties['type'],$properties['max_length'])){
				$sql = $properties['type']. '('.$properties['max_length'].')';
			}
		}else{
			$sql = $properties['type']. ' ';
		}
		unset($properties['type']);
		unset($properties['max_length']);
		return $sql;
	}




}




?>

