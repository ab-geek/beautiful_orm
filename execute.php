<?php
include 'config.php';
include 'main_model.php';
include 'table_generator.php';

include 'models.php';

function parseModels()
{
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
$models = parseModels();
print_r($models);
$tablegen = new TableGenerator;
$table_schema = $tablegen->checkMigrations($models);
echo '</br>'.$table_schema;
//Execute the schema
dbQuery($table_schema);
echo '</br>'.'Created Table structures';
*/

//query
$user = new MainModel('Users');
$result = $user->get(Array('id'=>'1','name'=>'ab'));
print_r($result);
?>
