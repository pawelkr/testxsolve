<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
    </head>
    <body>
<?php
/**
 * parametr dla GET -> key=
 * 
 */
if ( !isset($_GET['key']) || empty($_GET['key']) )
    exit;
$key = $_GET['key'];
$ch = curl_init("http://xlab.pl/feed/");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$xml_string = curl_exec($ch);
curl_close($ch);
$dom = new DOMDocument();
$dom->loadXML($xml_string);
$wpisy = $dom->getElementsByTagName('item');

foreach ($wpisy as $wpis){
    $nodes = $wpis->getElementsByTagName('description');
    $text = $nodes->item(0)->nodeValue;
    if ( strpos($text, $key )>0){

        $title = $wpis->getElementsByTagName('title');
        $link = $wpis->getElementsByTagName('link');
        
        echo '<p><a href="' . $link->item(0)->nodeValue. '">' . $title->item(0)->nodeValue . '</a></p>';
    }
}
?>
    </body>
</html>