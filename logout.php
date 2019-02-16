<?php

session_start();
$_SESSION = array();
$_SESSION['sessionAdmin'] = NULL;
session_destroy();

echo '<script>window.location="login.php";</script>';

?>
