# beautiful_orm
A new easy to use, Django like PHP ORM.

## Description
BeautifulOrm is an easy to use ORM for PHP. If you have ever used Python Django's ORM, then you'll see Beautiful Orm is similar to that.
</br>
You need to define your database configuration in config.php
</br>
You need to write table details in models.php. It will take Class as model name and its members as attributes (Array)
</br>

`class Users{

        public $id = Array("type"=>"int", "max_length"=>"11", "primary_key"=>"true", "auto_inc"=>"true","null"=>"false");
        public $name = Array("type"=>"varchar", "max_length"=>"100", "null"=>"true","default"=>"ab");
}`

</br>
The above class is for Users table with two fields;
</br>
Program entry point is execute.php.
</br>
//Parse a model
</br>
`$models = parseModels();`
</br>//Create Tablegenerate object
`$tablegen = new TableGenerator;`
</br>//Generate the schema
`$table_schema = $tablegen->checkMigrations($models);`
</br>//Execute the schema
dbQuery($table_schema);

</br>// Querying the table if now much easier
`$user = new MainModel('Users');`
`$result = $user->get(Array('id'=>'1','name'=>'ab'));`
`print_r($result);`



