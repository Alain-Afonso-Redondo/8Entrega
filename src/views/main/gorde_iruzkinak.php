<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['iruzkina'])) {
    $iruzkina = trim($_POST['iruzkina']);

    if (!empty($iruzkina)) {
        $xmlFile = 'config.xml';
        
        if (!file_exists($xmlFile)) {
            // Si el archivo no existe, crearlo con una estructura inicial
            $xmlContent = '<?xml version="1.0" encoding="UTF-8"?>
            <config>
                <iruzkinak></iruzkinak>
                <mainColor>#800040</mainColor>
                <footerColor>#808000</footerColor>
            </config>';
            file_put_contents($xmlFile, $xmlContent);
        }

        // Xml-a kargatu
        $xml = simplexml_load_file($xmlFile);
        
        // Komentario berria gehitu
        $komentarioBerria = $xml->iruzkinak->addChild('iruzkina', htmlspecialchars($iruzkina));
        
        // Guardar los cambios en el archivo XML
        $xml->asXML($xmlFile);
    }
}

// Redirigir de vuelta a la página principal después de guardar el comentario
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();