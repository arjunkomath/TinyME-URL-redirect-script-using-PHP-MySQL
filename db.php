<?php

//mysql db connection information
$hostname = "localhost"; //host
$database = "beta_code"; //database
$username = "root"; //username for your database
$password = "root"; //password for your database

$site = mysql_connect($hostname, $username, $password); 
mysql_select_db($database, $site);
//

?>