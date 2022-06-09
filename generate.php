<?php
$time_start = microtime(true);
ob_start();

$path = getcwd();

$img = [
  'blank.gif' => 'data:image/gif;base64,R0lGODlhFAAWAKEAAP///8z//wAAAAAAACH+TlRoaXMgYXJ0IGlzIGluIHRoZSBwdWJsaWMgZG9tYWluLiBLZXZpbiBIdWdoZXMsIGtldmluaEBlaXQuY29tLCBTZXB0ZW1iZXIgMTk5NQAh+QQBAAABACwAAAAAFAAWAAACE4yPqcvtD6OctNqLs968+w+GSQEAOw=='
];
?>
<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 3.2 Final//EN'>
<html lang="en"><head><title>Index of <?php echo(htmlspecialchars($path))?></title>
</head><body>
<h1>Index of <?php echo(htmlspecialchars($path))?></h1>
<table>
    <thead>
        <tr>
            <th valign="top"><img src="<?php echo $img['blank.gif'] ?>" alt="[ICO]">
            <th>Name</th>
            <th>Last modified</th>
            <th>Size</th>
            <th>Description</th>
        </tr>
        <tr><th colspan="5"><hr></th></tr>
    </thead>
    <tbody></tbody>
    <tfoot><tr><th colspan="5"><hr></th></tr></tfoot>
</table>
<address>php-directory-listing dev-master</address>
</body></html>
<?php
file_put_contents('index.html', ob_get_flush());