<?php

//include 'config.php';
include 'models.php';

//global $mysqli;

class Users extends Models{

	public $id = Array("type"=>"int", "primary_key"=>"true");
	public $name = Array("type"=>"varchar", "max_length"=>"100");

/*
	public function __construct()
	{
		$this->id = $this->IntegerField($primary_key=true);
		$this->name = $this->CharField($max_length=100);

	}
*/

}
//print_r(get_declared_classes());
/*
$user = new Users;
print_r($user->id);

$class = new ReflectionClass('Users');
$arr = $class->getProperties();
print_r($arr);

print_r(get_object_vars($user));
//$methods = get_class_methods(Users);
//print_r($methods);

*/



?>
