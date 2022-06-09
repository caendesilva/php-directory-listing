<?php
$time_start = microtime(true);
ob_start();

$path = getcwd();
?>
<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 3.2 Final//EN'>
<html lang="en"><head><title>Index of <?php echo(htmlspecialchars($path))?></title>
</head><body>
<h1>Index of <?php echo(htmlspecialchars($path))?></h1>


</body></html>
<?php
file_put_contents('index.html', ob_get_flush());