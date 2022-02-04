<?php


if (isset($_GET['id'])) {



session_start();
session_destroy();
if (isset($_COOKIE['rememberme'])) {
    unset($_COOKIE['rememberme']);
    setcookie('rememberme', '', time() - 3600);
}

header('Location: login.php?id='.$_GET['id']);
}else{
session_start();
session_destroy();
if (isset($_COOKIE['rememberme'])) {
    unset($_COOKIE['rememberme']);
    setcookie('rememberme', '', time() - 3600);
}
header('Location: login.php');
	
}
?>
