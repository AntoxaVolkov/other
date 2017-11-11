<?php
function startup(){
	/* Подключение файла с конфигурациями */
	require_once('dbconfig.php');
	
	// Языковые настройки
	setlocale(LC_ALL, 'ru_RU.utf8');
	
	/* Подключение к базе данных */
	mysql_connect($host, $login, $pass) or die('No connect with data base');
	mysql_query('SET NAMES utf8');
	mysql_select_db($db_name) or die('No data base');
	
	// Открытие сессии.
	session_start();
}