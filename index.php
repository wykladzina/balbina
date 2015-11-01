<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
input, button, textarea {
  width: 100%;
  font-size: 2em;
}
  </style>
</head>
<body>

<form action="dodaj.php" method="post" enctype="multipart/form-data">
dodaj wiadomość:<br>
<?php if (isset($kto)): ?>
<input type="hidden" name="kto" value="<?=$kto?>"><br>
<?php else: ?>
<input type="text" name="kto" placeholder="kto?"><br>
<?php endif; ?>
<input type="file" name='obrazek' accept="image/*;capture=camera">
<textarea rows=4 name='tresc' placeholder="treść"></textarea>
<button type="submit">zapisz</button>
</form>

<?php
require 'wspolne.php';

$kto_oglada = '???';
if (isset($kto)) {
  $kto_oglada = $kto;
}
$ip = $_SERVER['REMOTE_ADDR'];

pg_query("insert into obejrzenia (kto, ip) values ('$kto_oglada', '$ip')");

foreach (pg_fetch_all(pg_query("select * from wiadomosci order by kiedy desc limit 20")) as $w) {
  ?>
  <p style="color: red"><?=$w['kto']?> <span style="color: navy"><?=$w['kiedy']?></span></p>
  <?
    $tresc = $w['tresc'];
    $tresc = preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.\-]*(\?\S+)?)?)?)@', '<a href="$1">$1</a>', $tresc);
    $jest_zdjecie = file_exists("zdjecia/{$w['id']}");
  ?>
  <p style="margin-bottom: 2em"><?=$tresc?></p>
  <?php if($jest_zdjecie): ?>
    <a href="zdjecie.php?id_wiadomosci=<?=$w['id']?>"><img src="zdjecie.php?id_wiadomosci=<?=$w['id']?>&amp;male" alt="zdjęcie"></a>
  <?php endif; ?>
  <?php
}
?>

</body>
</html>
