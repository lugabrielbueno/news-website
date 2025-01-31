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
);

$keywords = $_GET['keywords'] ??  '';
$categories = $_GET['categories'] ?? 'search';
$language = $_GET['languages'] ?? '';
$start_date = date('Y-m-01');
$end_date = date('Y-m-31');

$request = [
  'apikey' => $apiKey,
  'category' => $categories ?? NULL,
  'language' => $language,
  //'size' => 11,
  'image' => 1,
  //'from_date' => $start_date,
  //'to_date' => $end_date
];

if ($keywords) {
  $request['q'] = $keywords;
}

if ($request['category'] == 'search' or $request['category'] == 'world') {
  unset($request['category']);
}

$queryString = http_build_query($request);
if (isset($world)) {
  $_SESSION[$categories][$language];
}

if (key_exists($categories,$_SESSION) and $_SESSION[$categories][$language] and !empty($_SESSION[$categories][$language]['results'])) {
  echo json_encode($_SESSION[$categories][$language]);
} else {

  // caso não tenha novas noticias busca as do ano passado
  //  $year = date('Y') - 1;
  //  $start_date = date($year . '-01-01');
  //  $end_date = date($year . '-12-31');
  //
  //
  //  $request['start_date'] = $start_date;
  //  $request['end_date'] = $end_date;
  //
  //  $queryString = http_build_query($request);
  //
  $ch = curl_init(sprintf('%s?%s', 'https://newsdata.io/api/1/latest', $queryString));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $json_response = curl_exec($ch);
  curl_close($ch);
  $response = json_decode($json_response, true);


  if (!key_exists('error', $response) and $response['status'] == 'success') {
    if (empty($_SESSION[$categories][$language])) {
      $_SESSION[$categories][$language] = json_decode($json_response, true);
    }
    echo $json_response;
  } else {

    echo json_encode($response);
  }
}
