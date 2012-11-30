<?php

$con = mysql_connect();
if (!$con)
	die("Could not connect: " . mysql_error());

if (mysql_query("CREATE DATABASE my_db", $con)
{
	echo "Database has been created.";
}
else
{
	echo "Could not create database.";
}

mysql_close($con);

?>
