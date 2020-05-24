<?php
//de $data gaan valideren
if (function_exists('test_input') == false) {
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
