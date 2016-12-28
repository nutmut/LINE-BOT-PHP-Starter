<?php
$access_token = '4x7QqBNZJB8L62ZOJpyi2PdOrix7CVvI9z1gCHSZTGsbxW8BQb0lIDPXK7LFG525k/O4zAsNf/BgMwjc5rqSjL3Co6YCzT9tFWfmNqc4X7wXeRKWwB1ZpbgYHNnIE4s76wUhy7Wfd5sYIXnZCQOqXQdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;