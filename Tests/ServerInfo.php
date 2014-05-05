<?php

$serverInfo = isset($_SERVER) ? $_SERVER : array();

if (defined("OPENSSL_VERSION_NUMBER")) {
    $serverInfo["MY_OPENSSL_VERSION"] = OPENSSL_VERSION_NUMBER;
    $serverInfo["MY_OPENSSL_VERSION_TEXT"] = OPENSSL_VERSION_TEXT;
}

header("Content-Type: application/json");
echo json_encode($serverInfo);
