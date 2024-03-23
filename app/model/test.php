<?php
require $config['MODEL_PATH'] . 'admin.php';
require $config['MODEL_PATH'] . 'comment.php';

if(isset($_SESSION['user'])) {
    getInfoAboutUser($_SESSION['user']);
}
?>