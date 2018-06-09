<?php

// This is the database connection configuration.
return array(
	'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	// uncomment the following lines to use a MySQL database
	
	'connectionString' => 'mysql:host=localhost;dbname=newboy',
	'emulatePrepare' => true,
	'username' => 'root',
	'password' => 'HuafengZy4000',
	'charset' => 'utf8',
	'tablePrefix'=>'nb_',
);