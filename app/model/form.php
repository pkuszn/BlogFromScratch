<?php

if(isset($_POST['submit'])){
    $nick = $_POST['nickname'];
    $fromEmail = $_POST['email'];
    $message = $_POST['message'];

    $mailTo = "patryk.kuszneruk1798@gmail.com";
    $headers = "From: ".$fromEmail;
    $txt = "You have received an email from ".$nick.".\n\n".$message;

    mail($mailTo, $txt, $headers);
    header("Location: index.php?page=mailsend");
}