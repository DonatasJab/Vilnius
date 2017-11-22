<?php
session_start();

$config = [
	'host'		=> 'localhost',
	'dbname'	=> 'darbas',
	'username'	=> 'root',
	'password'	=> '',
];

$db = new PDO('mysql:host='.$config['host'].';dbname='.$config['dbname'].';charset=utf8mb4', $config['username'], $config['password']);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);