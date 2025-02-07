<?php

session_start();

require __DIR__ . '/../functions.php';

loadEnv(__DIR__ . '/../.env');

$apiKey = getenv('API_KEY');

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: https://news.bitsbylucas.com");

$headers = array(
  "Content-Type: application/json",
  "Authorization: {$apiKey}",
);

$keywords = $_GET['keywords'] ??  '';
$categories = $_GET['categories'] ?? '';
$language = $_GET['languages'] ?? '';
$start_date = date('Y-m-01');
$end_date = date('Y-m-31');


$request = [
  'apikey' => $apiKey,
  'category' => $categories ?? NULL,
  'language' => $language,
  'image' => 1,
  //'from_date' => $start_date,
  //'to_date' => $end_date
];


if ($keywords) {
  if (str_contains($keywords, " ")) {
    $keywords = explode(" ", $keywords);

    $keywords = implode(" OR ", $keywords);
  }
  $request['q'] = $keywords;
}

if ($request['category'] == 'search') {
  unset($request['category']);
  unset($_SESSION[$categories]);
}


if (key_exists($categories, $_SESSION) and $_SESSION[$categories][$language] and !empty($_SESSION[$categories][$language]['results'])) {
  echo json_encode($_SESSION[$categories][$language]);
} else {
  $results = array();
  $reqs = 2;
  if ($language == 'en') {
    $reqs = 1;
  }
  for ($i = 1; $i <= $reqs; $i++) {
    if ($i == 2) {
      $request['page'] = $response['nextPage'];
    }
    $queryString = http_build_query($request);
    $ch = curl_init(sprintf('%s?%s', 'https://newsdata.io/api/1/latest', $queryString));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $json_response = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($json_response, true);
    if (!key_exists('error', $response) and $response['status'] == 'success') {
      $results = array_merge($response['results'], $results);
    }
  }
  if (empty($_SESSION[$categories][$language]) and !empty($results)) {
    $_SESSION[$categories][$language]['results'] = $results;
    echo json_encode($_SESSION[$categories][$language]);
  } else if (empty($results)) {
    echo json_encode(array("error" => 'Nenhuma notícia encontrada.'));
  } else if ($response['error']) {
    echo json_encode($response);
  }
}
