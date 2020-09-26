<?php
function consoleLogger($log)
{
    echo "<script>console.log('" . $log . "')</script>";
}

function getFinalUrl($url){
    $parsedUrl = parse_url(rtrim($url, '/'));
    if(preg_match("/^approve-(manufacturer|dealer)-[0-9]/", $parsedUrl['path'], $matches)){
        return $matches[0];
    }
    preg_match("/[^\/]+$/", $parsedUrl['path'], $matches);
    return $matches[0];
}