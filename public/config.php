<?php

//SQL database login/connection details 
$servername = 'localhost';
$dbName = 'userbase_system';
$dbUsername = 'root';
$dbPassword = 'root';

// SQL database login pass and attribute setting
$connection = new PDO("mysql:host=$servername;dbname=$dbName", $dbUsername, $dbPassword);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);