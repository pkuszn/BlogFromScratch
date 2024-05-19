<?php
$config = include($_SERVER['DOCUMENT_ROOT'].'/app/config/consts.php');
if(isset($_POST['submit'])){
    $nick = $_POST['nickname'];
    $fromEmail = $_POST['email'];
    $message = $_POST['message'];

    $headers = "From: ".$fromEmail;
    $txt = "You have received an email from ".$nick.".\n\n".$message;

    mail($config['mailto'], $txt, $headers);
    header("Location: index.php?page=mailsend");
}