<?php
session_start();
session_destroy();
header('Location: /blog/BlogFromScratch/Index.php');
exit;
?>