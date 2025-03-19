<?php

session_start();
$env = parse_ini_file(__DIR__ . '/../../../.env');
$APP_DIR = $env["APP_DIR"];
define('APP_DIR', $_SERVER['DOCUMENT_ROOT'] . $APP_DIR);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['iruzkinak'])) {
    $iruzkina = $_POST['iruzkinak'];

    if (!empty($iruzkina)) {
        $xmlFile = APP_DIR . '/conf.xml';

        if (file_exists($xmlFile)) {
            $xml = simplexml_load_file($xmlFile);
        } else {
            $xmlContent = '<?xml version="1.0" encoding="UTF-8"?><config><iruzkinak></iruzkinak></config>';
            file_put_contents($xmlFile, $xmlContent);
            $xml = simplexml_load_file($xmlFile);
        }

        if ($xml !== false && isset($xml->iruzkinak)) {
            $xml->iruzkinak->addChild('iruzkina', htmlspecialchars($iruzkina));
            $xml->asXML($xmlFile);
            echo "Iruzkina ondo gorde da.";
        } else {
            echo "Erroea iruzkina gordetzean.";
        }
    } else {
        echo "Error: Iruzkina hutsik dago.";
    }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();

?>