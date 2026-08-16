<?php
session_start();
session_unset();
session_destroy();
setcookie('aco_admin', '', time() - 3600, '/', '', false, true);
header('Location: login.php');
exit;
?>