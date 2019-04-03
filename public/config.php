<?php

//SQL database login/connection details 
$servername = 'c171.lithium.hosting';
$dbName = 'bvogbwbv_userbase_system';
$dbUsername = 'bvogbwbv';
$dbPassword = '9pk-l28g';

// SQL database login pass and attribute setting
$connection = new PDO("mysql:host=$servername;dbname=$dbName", $dbUsername, $dbPassword);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);