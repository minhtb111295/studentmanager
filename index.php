<?php 
// Import File
require 'bootstrap.php';

// Set controller and action
$c = $_GET['c'] ?? 'student';
$a = $_GET['a'] ?? 'index';

// Start Session
session_start();

$str = ucfirst($c); // student to Student
$controllerName = $str.'Controller'; // Student to StudentController
$str = "controller/$controllerName.php"; // controller/StudentController.php

require $str;
$controller = new $controllerName;
$controller->$a();
?>