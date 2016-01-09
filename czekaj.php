<?php
require "wspolne.php";

function ostatnia() {
  return (int) (pg_fetch_assoc(pg_query("select max(id) as ostatnia from wiadomosci"))['ostatnia']);
}

if (!isset($_GET['ostatnia'])) {
  header('Location: ?ostatnia=' . ostatnia());
  exit;
}

$ostatnia_wtedy = (int) $_GET['ostatnia'];
$ostatnia = ostatnia();

#print "$ostatnia_wtedy $ostatnia";
#exit;

if ($ostatnia === $ostatnia_wtedy) {
#  sleep(10);
#  header('Location: ?ostatnia=' . $ostatnia_wtedy);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>czekaj...</title>
    <meta http-equiv="refresh" content="10; url=?ostatnia=<?=$ostatnia_wtedy?>" />
</head>
<body>
    
</body>
</html>
<?php
  exit;
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>nowa wiadomość!</title>
</head>
<body style="background: red">
    <a href="piotrek.php">nowa wiadomość</a>
</body>
</html>

