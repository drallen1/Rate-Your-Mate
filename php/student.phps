<?php
php_info();
$server = 'turing.plymouth.edu';
$link = mssql_connect($server, 'drallen1' , 'unicode' );
if (!link){
	die('Error connecting to the database.');
}

?>

