<?php
$config = [
    'MODEL_PATH' => APPLICATION_PATH . DS . 'model' . DS,
    'VIEW_PATH' => APPLICATION_PATH . DS . 'view' . DS,
    'LIB_PATH' => APPLICATION_PATH . DS . 'lib' . DS,
    'ICONS_PATH' => APPLICATION_PATH . DS . 'icons' . DS,
    'DATABASE_PATH' => APPLICATION_PATH . DS . 'database' . DS,
    //Helper path has different path structure from others. It is due to Google Chrome security features
    //'HELPER_PATH' =>  APPLICATION_PATH . DS . 'view' . DS . 'helper' . DS
];
require $config['LIB_PATH'] . 'functions.php';