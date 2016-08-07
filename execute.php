<?php

/*
	Executes Beautiful ORM Table generator
*/

if(isset($argv[1]) && $argv[1] == 'createtables'){
	include 'config.php';
	include 'MainModel.php';
	include 'TableGenerator.php';
	include 'models.php';

	
	$mm = new MainModel;
	$models = $mm->parseModels();
	//print_r($models);
	$tablegen = new TableGenerator;
	$table_schema = $tablegen->checkMigrations($models);
	#echo '</br>'.$table_schema;
	//Execute the schema
	dbQuery($table_schema);
	echo ' Created Table structures ';
	echo '';
	

	
}else{
	echo 'Usage : php execute.php option

	eg.: php execute.php createtables

	option {
		createtables, updatetables
		}
	'; 
	exit(0);
}


?>
