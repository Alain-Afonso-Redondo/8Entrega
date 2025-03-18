<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['index'])) {
    $indexToDelete = (int) $_POST['index'];
    
    if (file_exists('config.xml')) {
        $xml = simplexml_load_file('config.xml');
        
        if (isset($xml->iruzkinak->iruzkina[$indexToDelete])) {
            unset($xml->iruzkinak->iruzkina[$indexToDelete]);
            
            $xml->asXML('config.xml');
        }
    }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
?>
