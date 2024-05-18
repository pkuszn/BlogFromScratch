<?php
$config = [
    'MODEL_PATH' => APPLICATION_PATH . DS . 'model' . DS,
    'VIEW_PATH' => APPLICATION_PATH . DS . 'view' . DS,
    'LIB_PATH' => APPLICATION_PATH . DS . 'lib' . DS,
    'ICONS_PATH' => APPLICATION_PATH . DS . 'icons' . DS
    //'HELPER_PATH' =>  APPLICATION_PATH . DS . 'view' . DS . 'helper' . DS
];
require $config['LIB_PATH'] . 'functions.php';
require $config['LIB_PATH'] . 'pagination.php';