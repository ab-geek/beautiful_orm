<?php

/*
Define Model/tables here
*/

class Users{

	public $id = Array("type"=>"int", "max_length"=>"11", "primary_key"=>"true", "auto_inc"=>"true","null"=>"false");
	public $name = Array("type"=>"varchar", "max_length"=>"100", "null"=>"true","default"=>"ab");
}

class Login{

	public $username = Array("type"=>"varchar", "max_length"=>"50");
	public $password = Array("type"=>"varchar", "max_length"=>"50");
}


?>
