<?php
session_start();
unset($_SESSION['trader']);
header('Location: /trader/login.php');
?>