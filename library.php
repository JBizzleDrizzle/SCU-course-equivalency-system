<?php
// Write logs to file
function logToFile($statement) {
  $file = 'php-logs.txt';
  $current = file_get_contents($file);
  $current .= "$statement\n";
  file_put_contents($file, $current);
}

// Redirect user if success
function redirect($url) {
  ob_start();
  header('Location: '.$url);
  ob_end_flush();
  die();
}
?>
