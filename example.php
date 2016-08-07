<?php

/*

To use BeautifulOrm
1. First generate tables from execute.php or create yourself manually in mysql
2. Use MainModel class in php code as :
*/	
	include 'config.php';
	include 'models.php';
	include 'MainModel.php';

	//get the 'Users' model
	$user = new MainModel('Users');

	//add new row
	$user->add(Array('name'=>'cd'));

	//get a row
	$result = $user->get(Array('id'=>'2'));
	print_r($result);

	//Output : Array ( [0] => Array ( [id] => 2 [name] => cd ) )





?>
