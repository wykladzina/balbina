<?php
require 'wspolne.php';

function zapisz_obrazek($nazwa_obrazka) {
  $target_dir = "zdjecia/";
  $target_dir_thumb = "zdjecia_male/";
  $target_file = $target_dir . $nazwa_obrazka;
  $target_file_thumb = $target_dir_thumb . $nazwa_obrazka;
  $uploadOk = 1;
  if (getimagesize($_FILES["obrazek"]["tmp_name"]) === false) {
    print "to nieobrazek!";
    $uploadOk = 0;
  }
  if (file_exists($target_file)) {
    print "juz jest plik o takiej nazwie";
    $uploadOk = 0;
  }
  if ($_FILES["obrazek"]["size"] > 3000000) {
    print "rozmiar za duzy, bo taki: {$_FILES["obrazek"]["size"]}";
    $uploadOk = 0;
  }
  if ($uploadOk !== 0) {
      move_uploaded_file($_FILES["obrazek"]["tmp_name"], $target_file);
  } else {
    exit();
  }
  $thumb = new Imagick($target_file);
  $thumb->resizeImage(320, 0, Imagick::FILTER_LANCZOS, 1);
  $thumb->writeImage($target_file_thumb);
  $thumb->destroy();
}

$kto = pg_escape_string($_POST['kto']);
if ($kto == '') {
    $kto = 'Ula';
}
$tresc = pg_escape_string($_POST['tresc']);
if ($tresc != '') {
  $id_wiadomosci = pg_fetch_assoc(pg_query("insert into wiadomosci (kto, tresc) values ('$kto', '$tresc') returning id"))['id'];
  if ($_FILES["obrazek"]["size"] > 0) {
    zapisz_obrazek($id_wiadomosci);
  }
}
header("Location: {$_SERVER["HTTP_REFERER"]}");
?>
