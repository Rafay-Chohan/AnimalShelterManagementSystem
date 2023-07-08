<?php

session_start();

if(isset($_SESSION['user_id']))
{
	unset($_SESSION['user_id']);
}

header("Location: http://localhost/testphp/test.php");
die;