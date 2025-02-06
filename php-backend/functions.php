<?php

function loadEnv($file)
{
  if (!file_exists($file)) {
    throw new Exception(".env file not found.");
  }

  // Read the .env file
  $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

  foreach ($lines as $line) {
    if (strpos(trim($line), '#') === 0) {
      continue;
    }

    $parts = explode('=', $line, 2);
    if (count($parts) === 2) {
      $key = trim($parts[0]);
      $value = trim($parts[1]);

      putenv("$key=$value");
    }
  }
}
