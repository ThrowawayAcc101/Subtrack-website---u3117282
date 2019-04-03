<?php

//Simple logout script that unsets all current session 

session_start();
session_unset();
session_destroy();

header('Location: index.php');