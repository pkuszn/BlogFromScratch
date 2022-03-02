<?php
function get($name, $def = '')
{
    return isset($_REQUEST[$name]) ? $_REQUEST[$name] : $def;
}

function displayImage($image, $hasStyle)
{
    if (file_exists($image)) {
        if (!$hasStyle) {
            $b64image = base64_encode(file_get_contents($image));
            echo "<img src = 'data:image/png;base64,$b64image'/>";
        } else {
            $b64image = base64_encode(file_get_contents($image));
            return $b64image;
        }
    }
}

?>
