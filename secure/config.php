<?php

	// require_once "settings.php";

	$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

	try 
	{
		$pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

		if ($pdo) 
		{
			return $pdo;
		}
	} 
	catch (PDOException $e) 
	{
		die($e->getMessage());
	}