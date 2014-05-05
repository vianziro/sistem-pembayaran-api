<?php

if (!function_exists("_getPage")) {

    function _getPage($url, $context) {
        $data = "";
        $fp = @fopen($url, "r", FALSE, $context);

        if ($fp === FALSE) {
            return FALSE;
        }

        while (($buffer = fgets($fp)) !== FALSE) {
            $data .= $buffer;
        }

        fclose($fp);
        return $data;
    }

}
