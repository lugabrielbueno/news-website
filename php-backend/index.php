<?php
session_start();


function loadEnv($file)
{
  if (!file_exists($file)) {
    throw new Exception(".env file not found.");
  }

  // Read the .env file
  $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

  foreach ($lines as $line) {
    // Ignore lines that are comments
    if (strpos(trim($line), '#') === 0) {
      continue;
    }

    // Split the line into key-value pairs
    $parts = explode('=', $line, 2);
    if (count($parts) === 2) {
      $key = trim($parts[0]);
      $value = trim($parts[1]);

      // Set the environment variable
      putenv("$key=$value");
    }
  }
}

try {
  if (!$_SESSION['access_key']) {
    loadEnv('.env');
    $_SESSION['access_key'] = getenv('ACCESS_KEY') . PHP_EOL;
  }
} catch (Exception $e) {
  echo $e->getMessage();
}
