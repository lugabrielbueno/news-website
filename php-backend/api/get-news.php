<?php

session_start();


header("Access-Control-Allow-Origin: http://localhost:5173");
header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Authorization');
header("Access-Control-Allow-Credentials: true");


$apiKey = trim($_SESSION['apiKey']) ?? '';
$headers = array(
  "Content-Type: application/json",
  'Access-Control-Allow-Origin: http://localhost:5173',
  "Authorization: {$apiKey}",
  "cache-control: no-cache"
);

$keywords = $_GET['keywords'] ??  '';
$categories = $_GET['categories'] ?? 'search';
$language = $_GET['languages'] ?? '';
$start_date = date('Y-m-01');
$end_date = date('Y-m-31');

$request = [
  'apiKey' => $apiKey,
  'keywords' => $keywords ?? NULL,
  'category' => $categories ?? NULL,
  'language' => $language,
  'page_size' => 50,
  'limit' => 50,
  'start_date' => $start_date,
  'end_date' => $end_date
];
if ($request['category'] == 'search' or $request['category'] == 'world') {
  unset($request['category']);
}

$queryString = http_build_query($request);
if (isset($world)) {
  $_SESSION[$categories];
}

if ($_SESSION[$categories]) {
  echo json_encode($_SESSION[$categories]);
} else {
  $ch = curl_init(sprintf('%s?%s', 'https://api.currentsapi.services/v1/search', $queryString));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $json_response = curl_exec($ch);
  curl_close($ch);
  $response = json_decode($json_response, true);
  if (!key_exists('error', $response)) {
    if (empty($_SESSION[$categories])) {
      $_SESSION[$categories] = json_decode($json_response, true);
    }
    echo $json_response;
  } else {
    echo json_encode($response);
  }
}
