<?php
$id_wiadomosci = (int)$_GET['id_wiadomosci'];
$male = isset($_GET['male']);

$etag = $id_wiadomosci;
header("Etag: $etag");
if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && trim($_SERVER['HTTP_IF_NONE_MATCH']) == $etag) {
  header("HTTP/1.1 304 Not Modified");
  exit;
}

header('Content-type: image/jpeg');
$katalog = $male ? 'zdjecia_male' : 'zdjecia';
readfile("$katalog/$id_wiadomosci");
