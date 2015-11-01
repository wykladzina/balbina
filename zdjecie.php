<?php
$id_wiadomosci = (int)$_GET['id_wiadomosci'];
$male = isset($_GET['male']);

$etag = $id_wiadomosci . '.' . ($male ? 'male' : 'duze');
header("Etag: $etag");
if (trim($_SERVER['HTTP_IF_NONE_MATCH']) === $etag) {
  header("HTTP/1.1 304 Not Modified");
  exit;
}

header('Content-type: image/jpeg');
$katalog = $male ? 'zdjecia_male' : 'zdjecia';
readfile("$katalog/$id_wiadomosci");
