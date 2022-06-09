<?php
$time_start = microtime(true);
ob_start();

// Only the script directory
// $path = getcwd();

// Full path
$path = trim(getcwd() . str_replace('/', DIRECTORY_SEPARATOR, $_SERVER['REQUEST_URI']), DIRECTORY_SEPARATOR);

$img = [
    'blank.gif' => 'data:image/gif;base64,R0lGODlhFAAWAKEAAP///8z//wAAAAAAACH+TlRoaXMgYXJ0IGlzIGluIHRoZSBwdWJsaWMgZG9tYWluLiBLZXZpbiBIdWdoZXMsIGtldmluaEBlaXQuY29tLCBTZXB0ZW1iZXIgMTk5NQAh+QQBAAABACwAAAAAFAAWAAACE4yPqcvtD6OctNqLs968+w+GSQEAOw==',
    'unknown.gif' =>  'data:image/gif;base64,R0lGODlhFAAWAMQAAExMTN3d3bW1tZmZmWZmZv///8zMzHl5ee/v762trb29vWZmZoyMjKWlpdbW1ubm5vf391paWsPDw3Nzc4WFhVRUVP///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAUUABYALAAAAAAUABYAAAXdoKAoQpmczdAIzmO9r1LMdAEhjpoYLizXM8Qjp2rwYAJg8GEYSIpHS3KmYBwIhMhkYFA0GgnHK0HDmiOVgVptdJFnh51DcYgAAIzEYKJwK20SEWgMAgl8fn8CWREKEgKHFm81EIpYAwEGjxKINAlmDAYFQwoTBgiRQAxYU6KZpaeSM6oErEyPpqh/NbavuWVYDDMQvLixBZ/CxLBKEM3NCAEShrgNNs9CD9kPmAINBNTP2w4OBuUGjnrfpwPQ5BIkJSYpFBG4AwwUB/oT/P1nBAFeYDJHsGC5AKcshAAAOw==',
    'folder.gif' => 'data:image/gif;base64,R0lGODlhFAAWAOYAAFw+H/HDlMOkhbaSbZh6W8LCwqKioubm5n9lS5mZmf/evf/Tpt+zhr29vbGLZL2betfX17e3t3JMJ6CAYO/Kpue6jfnWssWyoKV5TNesgZdrP7+UaWdEIv/Mmc6lfO/v797e3uG1iXxTKr+Zc4R6b6N2SszMzLKLZPXFla2DWo1xVf/Wre3Ak//bttW0lKurq//hw/jLn/3RpZRzUltDLMOZbrWPaal+UdG1mYRYLOXCnfXIm8mrjKuHY7SUc9uwheW4jK+Macaed6h8UWNCIf/ZtLyWcWtIJOy9jsSddqWEY3NSKf/jx5p7XLqPY5VvSMWljIBmTPHPrNa1nPLHnP///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAUUAFUALAAAAAAUABYAAAf/gFWCg4SFhoeIiB+Li4mDHwcgIBCUkgcHH4cHOEY2Dik3oUYmECCXjYI4PFJFRSsrCxUlPQ0FpKWXVQMUKzK+MTssNU9GAycpGEMXpiM6VCwsQCE/Hj48LgquVBsaJiAPUA8PAzblIwIuFq4yAT85ESYPTPMK9fbZvTtAHiIvBUYwAipo0aogrB0VMiQRYaDAAHstWryauCAGkgxCBkhI0MDGQImwFoisGICBhxFBNjZwEPHVrxgwUSTM2ENlClf5UKCAhgSJSZRKjnBMAQsYiwohpv3I4CGjkiYcOA6RESNABQZMPTQVUqxHExVEOJZ4FoJpkhFG0g4I8lQFAgANQDE4YTpibZAeeJVMIKAiCg0a/i5oyCFChITDRxIn5sABAA0S8ECYiPDCQILLmDMbeBE5kokCBRqIHk0atLcDgQAAOw==',
    'image2.gif' => 'data:image/gif;base64,R0lGODlhFAAWAOYAAAB0J6u+sr4mJoWFha2trQBrjlpaWubm5jOKUHt7eyaoUfpGRhSUvtbW1p+ypff391NTU1G53PcxMQecOWZmZsTExIygkuUxMTClzQZ8pACLL0ehZYOhrL5JQv9aWnJycrW1tW6LWxiYQu/v73+pt93d3Uqz1oyMjP///8zMzNYrKzKLbDGtWgBxlgCZM/pCQhSJsJK2wxqjSGZmZpmZmaWlpb29vf9mZiOSt/9RUZmZmQCCK1SvbO47OwB1nPY5Oc4pKeEuLjqwYT2lyAyBqIypswCZM/w6Ou0zMwB9KpCjlhagRCOXvgR4nimtUv9NTR+lTP5FRTaMU8lLRHCKWt4pKROMtVKrcD2nygiErf///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAUUAFoALAAAAAAUABYAAAf/gCA2NiCFBIc1NDUgDQdaj482KCgPlZUjIw2KBCmOkCCWmJgHJSk0ijWdnw8jpCWvDSkVNDaoqloEIze7Hk8vP4MnFTY1NQQNjzUHvDlRPUiHJ6enNRWONSUeHlFHP0EqqMWJHzbXJTk5RxIXQALSh4bk5k8LSEhTISwKG0qFIATytGB70UNFBx5CFEBZIsJCoRoUygks8YMdFSEyJmjUgIAACYjWBB5oQEzfBBcodwDgwIRGxGutUoBQeNKFBgArsFg5YQCEIwKsSlS4smSCBg1JVpjAkSFBzxK4Ko0MIEKDyhURMBDx8QECAagEJj0Y6UAKThMYGDRp0fUrLrExVUEUGYKDSJMCBdpCrQH3QIoYTGBk8NGiAFuve6WWaFABRKITAxJI7upTC40Ri1MQIvB4QOQEXUPSgBz5g2kKqCkYWA2BQoMRWkpVmE172KDbFRo9CgQAOw==',
];

function run() {
    global $path;
    foreach (glob($path . DIRECTORY_SEPARATOR .'*') as $file) {
        makeRow($file);
    }
}

function makeRow($file) {
    global $img;
    $ext = pathinfo($file, PATHINFO_EXTENSION);
    $size = filesize($file);
    $time = filemtime($file);
    $description = filetype($file);
    $icon = $img['unknown.gif'];
    $alt = '[   ]';
    if (is_dir($file)) {
        $icon = $img['folder.gif'];
        $alt = '[DIR]';
    }
    if (is_file($file)) {
        if (in_array($ext, ['gif', 'jpg', 'jpeg', 'png', 'bmp'])) {
            $icon = $img['image2.gif'];
            $alt = '[IMG]';
        }
    }
    $row = <<<HTML
<tr>
    <td valign="top"><img src="$icon" alt="$alt"></td>
    <td>$file</td>
    <td>$time</td>
    <td>$size</td>
    <td>$description</td>
</tr>
HTML;
    echo str_replace(PHP_EOL, '', $row);
}
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
    <tbody><?php run() ?></tbody>
    <tfoot><tr><th colspan="5"><hr></th></tr></tfoot>
</table>
<address>php-directory-listing dev-master</address>
</body></html>
<?php
file_put_contents('index.html', ob_get_flush());