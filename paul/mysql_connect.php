<?php

// database access file

// set the access conditions

define ('DB_USER', 'username of db');

define ('DB_PASSWORD', 'db password');

define ('DB_HOST', 'locahost');

define (DB_NAME', 'ecommerce');

// create and maintain connection

$dbc = @mysqlconnect (DBHOST, DBUSER, DBPASSWORD) OR die ('Could not connect to MySQL: ' . mysqlerror();

mysql_select *db (*DB_NAME) OR die ('Could not select the database: ' . mysql_error() );

// trim the form

function escape_data ($data) {

global $dbc;

if (ini_get('magic_quotes_gpc')) {

$data = stripslashes($data);

}

return mysql_real_escape_string (trim ($data), $dbc);

} // end function

?> // close PHP