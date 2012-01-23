<?php

session_start();
require "settings.php";

if(!@mysql_connect($settings['dbhost'], $settings['dbuser'], $settings['dbpass']))
{
	echo "Could not connect to database";
	exit;
}

//mysql_query("DROP DATABASE " . $settings['dbdb']);

if(!@mysql_select_db($settings['dbdb'])) // first time, setup
{
	
	
	$sql = "CREATE DATABASE IF NOT EXISTS " . $settings['dbdb'] . ";";
	mysql_query($sql) or die(mysql_error());
	mysql_select_db($settings['dbdb']);	

	$sql = "CREATE TABLE mail (
		id INT NOT NULL AUTO_INCREMENT,
		subject VARCHAR(255),
		message TEXT,
		`date` DATETIME,
		`to` VARCHAR(100),
		`from` VARCHAR(100),
		`read` INT,
		PRIMARY KEY (id)
		)";
	
	mysql_query($sql) or dir(mysql_error());

}