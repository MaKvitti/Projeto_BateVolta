<?php
session_start();
session_destroy();
$_SESSION['id'] = '';
$_SESSION['user'] = '';
$_SESSION['cargos'] = '';
header('Location: index.php');
?>