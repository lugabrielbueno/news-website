<?php

session_start();

header("Content-Type: application/json");
header('Access-Control-Allow-Origin: http://localhost:5174'); // This allows all origins
header('Access-Control-Allow-Credentials: true'); // This allows all origins


$access_key = trim($_SESSION['access_key']);
$keywords = $_GET['keywords'];
$categories = $_GET['categories'];

$queryString = http_build_query([
  'access_key' => $access_key,
  'keywords' => $keywords ?? NULL, // the word "wolf" will be
  'categories' => $categories ?? NULL,
  'languages' => 'pt',
  'sort' => 'popularity',
]);

if ($_SESSION[$categories]) {
  echo json_encode($_SESSION[$categories]);
} else {
  $ch = curl_init(sprintf('%s?%s', 'https://api.mediastack.com/v1/news', $queryString));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $json_response = curl_exec($ch);
  curl_close($ch);
  $response = json_decode($json_response, true);
  if (!$response['error']) {
    $_SESSION[$categories] = json_decode($json_response, true);
    echo $json_response;
  } else {
    echo json_encode($response);
  }
}
