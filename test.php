<?php

$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => 'https://dantri.com.vn/giao-duc/vu-lo-de-thi-sinh-8-thi-sinh-duoc-mom-de-can-xu-ly-the-nao-20230620004656478.htm',
    CURLOPT_USERAGENT => 'Test cURL Request',
    CURLOPT_SSL_VERIFYPEER => true
));
$html = curl_exec($ch);
curl_close($ch);

if ($html === false) {
    die("CURL Error: " . curl_error($ch));
}

$dom = new DOMDocument;
$dom->loadHTML($html);

$xpath = new DOMXPath($dom);

$articleNodes = $xpath->query("//div[@class='singular-content']");

foreach ($articleNodes as $articleNode) {
    $title = $articleNode->getElementsByTagName('a')->item(0)->nodeValue;
    $url = $articleNode->getElementsByTagName('a')->item(0)->getAttribute('href');

    $descriptionNode = $articleNode->getElementsByTagName('p');
    $description = "";
    if ($descriptionNode->length > 0) {
        $description = $descriptionNode->item(0)->nodeValue;
    }

    $thumbnailNode = $articleNode->getElementsByTagName('img');
    $thumbnail = "";
    if ($thumbnailNode->length > 0) {
        $thumbnail = $thumbnailNode->item(0)->getAttribute('src');
    }

    echo "Title: " . $title . "\n";
    echo "Description: " . $description . "\n";
    echo "URL: " . $url . "\n";
    echo "Thumbnail: " . $thumbnail . "\n\n";
}
