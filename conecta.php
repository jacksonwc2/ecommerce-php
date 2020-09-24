<?php
//CONEXÃO COM BANCO DE DADOS
$PDO = new PDO('mysql:host=localhost;dbname=bardoze;charset=utf8', 'root', '');
ini_set('display_errors', true);
error_reporting(E_ALL);
