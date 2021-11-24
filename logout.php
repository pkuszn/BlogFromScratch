<?php
session_start();
session_destroy();
header('Location: Login_captcha/index.php');
exit;
?>