<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<body>

<?php
require 'wspolne.php';

foreach (pg_fetch_all(pg_query("select ip, kto, to_char(obejrzenia.kiedy, 'YYYY-MM-DD HH24:MI') as kiedy from obejrzenia order by kiedy desc limit 100")) as $w) {
  ?>
  <p style="color: red"><?=$w['kto']?> <span style="color: navy"><?=$w['kiedy']?></span> <span style='color: green'><?=$w['ip']?></span></p>
  <?php
}
?>

</body>
</html>
