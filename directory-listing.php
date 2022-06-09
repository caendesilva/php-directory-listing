<?php
$time_start = microtime(true);
ob_start();

const VERSION = 'dev-master';

// Only the script directory
// $path = getcwd();

// Full path
$path = trim(getcwd() . str_replace('/', DIRECTORY_SEPARATOR, $_SERVER['REQUEST_URI']), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

$img = [
    'blank.gif' => 'data:image/gif;base64,R0lGODlhFAAWAKEAAP///8z//wAAAAAAACH+TlRoaXMgYXJ0IGlzIGluIHRoZSBwdWJsaWMgZG9tYWluLiBLZXZpbiBIdWdoZXMsIGtldmluaEBlaXQuY29tLCBTZXB0ZW1iZXIgMTk5NQAh+QQBAAABACwAAAAAFAAWAAACE4yPqcvtD6OctNqLs968+w+GSQEAOw==',
    'unknown.gif' =>  'data:image/gif;base64,R0lGODlhFAAWAMQAAExMTN3d3bW1tZmZmWZmZv///8zMzHl5ee/v762trb29vWZmZoyMjKWlpdbW1ubm5vf391paWsPDw3Nzc4WFhVRUVP///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAUUABYALAAAAAAUABYAAAXdoKAoQpmczdAIzmO9r1LMdAEhjpoYLizXM8Qjp2rwYAJg8GEYSIpHS3KmYBwIhMhkYFA0GgnHK0HDmiOVgVptdJFnh51DcYgAAIzEYKJwK20SEWgMAgl8fn8CWREKEgKHFm81EIpYAwEGjxKINAlmDAYFQwoTBgiRQAxYU6KZpaeSM6oErEyPpqh/NbavuWVYDDMQvLixBZ/CxLBKEM3NCAEShrgNNs9CD9kPmAINBNTP2w4OBuUGjnrfpwPQ5BIkJSYpFBG4AwwUB/oT/P1nBAFeYDJHsGC5AKcshAAAOw==',
    'folder.gif' => 'data:image/gif;base64,R0lGODlhFAAWAOYAAFw+H/HDlMOkhbaSbZh6W8LCwqKioubm5n9lS5mZmf/evf/Tpt+zhr29vbGLZL2betfX17e3t3JMJ6CAYO/Kpue6jfnWssWyoKV5TNesgZdrP7+UaWdEIv/Mmc6lfO/v797e3uG1iXxTKr+Zc4R6b6N2SszMzLKLZPXFla2DWo1xVf/Wre3Ak//bttW0lKurq//hw/jLn/3RpZRzUltDLMOZbrWPaal+UdG1mYRYLOXCnfXIm8mrjKuHY7SUc9uwheW4jK+Macaed6h8UWNCIf/ZtLyWcWtIJOy9jsSddqWEY3NSKf/jx5p7XLqPY5VvSMWljIBmTPHPrNa1nPLHnP///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAUUAFUALAAAAAAUABYAAAf/gFWCg4SFhoeIiB+Li4mDHwcgIBCUkgcHH4cHOEY2Dik3oUYmECCXjYI4PFJFRSsrCxUlPQ0FpKWXVQMUKzK+MTssNU9GAycpGEMXpiM6VCwsQCE/Hj48LgquVBsaJiAPUA8PAzblIwIuFq4yAT85ESYPTPMK9fbZvTtAHiIvBUYwAipo0aogrB0VMiQRYaDAAHstWryauCAGkgxCBkhI0MDGQImwFoisGICBhxFBNjZwEPHVrxgwUSTM2ENlClf5UKCAhgSJSZRKjnBMAQsYiwohpv3I4CGjkiYcOA6RESNABQZMPTQVUqxHExVEOJZ4FoJpkhFG0g4I8lQFAgANQDE4YTpibZAeeJVMIKAiCg0a/i5oyCFChITDRxIn5sABAA0S8ECYiPDCQILLmDMbeBE5kokCBRqIHk0atLcDgQAAOw==',
    'image2.gif' => 'data:image/gif;base64,R0lGODlhFAAWAOYAAAB0J6u+sr4mJoWFha2trQBrjlpaWubm5jOKUHt7eyaoUfpGRhSUvtbW1p+ypff391NTU1G53PcxMQecOWZmZsTExIygkuUxMTClzQZ8pACLL0ehZYOhrL5JQv9aWnJycrW1tW6LWxiYQu/v73+pt93d3Uqz1oyMjP///8zMzNYrKzKLbDGtWgBxlgCZM/pCQhSJsJK2wxqjSGZmZpmZmaWlpb29vf9mZiOSt/9RUZmZmQCCK1SvbO47OwB1nPY5Oc4pKeEuLjqwYT2lyAyBqIypswCZM/w6Ou0zMwB9KpCjlhagRCOXvgR4nimtUv9NTR+lTP5FRTaMU8lLRHCKWt4pKROMtVKrcD2nygiErf///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAUUAFoALAAAAAAUABYAAAf/gCA2NiCFBIc1NDUgDQdaj482KCgPlZUjIw2KBCmOkCCWmJgHJSk0ijWdnw8jpCWvDSkVNDaoqloEIze7Hk8vP4MnFTY1NQQNjzUHvDlRPUiHJ6enNRWONSUeHlFHP0EqqMWJHzbXJTk5RxIXQALSh4bk5k8LSEhTISwKG0qFIATytGB70UNFBx5CFEBZIsJCoRoUygks8YMdFSEyJmjUgIAACYjWBB5oQEzfBBcodwDgwIRGxGutUoBQeNKFBgArsFg5YQCEIwKsSlS4smSCBg1JVpjAkSFBzxK4Ko0MIEKDyhURMBDx8QECAagEJj0Y6UAKThMYGDRp0fUrLrExVUEUGYKDSJMCBdpCrQH3QIoYTGBk8NGiAFuve6WWaFABRKITAxJI7upTC40Ri1MQIvB4QOQEXUPSgBz5g2kKqCkYWA2BQoMRWkpVmE172KDbFRo9CgQAOw==',
    'movie.gif' => 'data:image/gif;base64,R0lGODlhFAAWAMQAAFRUVMTExK6urmZmZtbW1ubm5mZmZnt7e729vczMzN7e3lpaWu7u7oSEhLW1tXNzc4yMjP///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAUUABEALAAAAAAUABYAAAXQ4NGMx2Oe6DMoRXQQSTMsdL0MDxIMhMIcpYfDgdAFAkXTLEEoDJALYiDBpO6Gi0DziQAQmT0CbIDVFlQ0Xa/AKCgI6AViW5QnWIxIWzFAOABzTlBqeG4EfV1mQUIIYG8wBzNZdA4NiycDmQICgJQyNjYDm50FQCqbRDpFDnGBfQ4LAg5HVUeinK5IXo1ijwlkf2atWoVvcWaIdnh6bq+kyYRshs6BpoyOYgklAwDCSJcomUPdW0qgNQAAmQBMhglIRUfyRTpMPoYwVFT5+r0tIQA7',
    'text.gif' => 'data:image/gif;base64,R0lGODlhFAAWAMQAAFxcXNbW1q2trZmZmf///8TExO/v73Nzc+bm5rW1tXl5eaWlpb29vWZmZszMzPf3993d3YWFhWZmZoyMjP///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAUUABQALAAAAAAUABYAAAXFYMIwSSmcy7AkAUK9L0PMNPEYgSo4LizXMwMip1rwYAlgcDgoFI+UJGFArUIcAwdjsRAEXgIlQYitqgqu8NQ8GBYSp8GBkRbfho63YF5fs6sBb3wUanY3VwkHaIQzf2ZDDIoGjGI1Q4kFk2qOVZeSlJUzCA6YmkCOo6WglQ+je5mrfmYQBa+TCzYPN0IIvQiICw2wC7pCEAEBDsp5cAPCkwMGx3kkJSYpEQAO0BMREQoH4eIHDeUADRAvVwXs7e7tDhCTFCEAOw==',
    'tar.gif' => 'data:image/gif;base64,R0lGODlhFAAWAPQAADMzM9bW1rW1tZmZmf///2ZmZszMzObm5qWlpVlZWXl5eb29ve/v70tLS62trd3d3YyMjMTExPf393Nzcz8/P4WFhQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAUUABYALAAAAAAUABYAAAXUoLCMomMiAyIEh+W6CyHPMhOkjtG+MS3rN5yO55MVVoOIcCf4DZ6DBtKwQFgDLocTKjVAn4ihlmAwzI6BiMA0mCxaYwRAEWMd0mqHGz5bNCYNAwcMd2kCexZjZAUHEwBmEjZUiIoDFAkVkDVpE2IyUQgMRXeHngR3RZulDIkyAgWwsAEzpJ2sY3cICQa7tJOmMhUFBAWataYBCQmBFA+RknqmAxUHCAUQg4VrxbeRaQ8B32V5A9wWguDjJSJW07us0xUK8xP19rEJjC7p4/3+OqwshAAAOw==',
    'binary.gif' => 'data:image/gif;base64,R0lGODlhFAAWAPQAAExMTNbW1rW1tZmZmf///2ZmZszMzO/v76WlpXp6er29vebm5ltbW62trYWFhff398XFxd3d3XNzc1BQUIyMjAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAUUABUALAAAAAAUABYAAAXRoKCMYmMiAyIES+W6CiHP8hGkjdG+8ZEYhAIjsbjhdDzCAGAQJIKQG+S4E8gKhsEguBo0EeCAq3FtPhmGrFaLgLTI0INwUIQITAOJ4k2jHep2DXp8QUMEPm5FAXaDFWROUEsQD5QRZm6OSltYUDN1egeZkAwLnTUBTphkcgxbpoeooJl9tEWpoas/hU+el7hKTKMBvbezWFoPnJWMqmUIRBM6gAhYuJQMKwwTDmlpdwPVFXSW3iUiYAMOaKHpDu4S8PESQvQRLuQQ+fr7+hGhFSEAOw==',
    'world1.gif' => 'data:image/gif;base64,R0lGODlhFAAUAPYAAABIAHSsdEltkkqSSszMzC1EWi5LOWmUwH2p1B49MLKyskhrj5mZmVmFsN7e3qG4rDNmZl2bep6/3zKEMh91H1mbWXOgzTeCWhM2HWt2bZK4mnp/emqYxWKOu3qpszdTbubm5k1/mnGgpipJTsXFxXmrmnWkhzh+bjFrSEuDZZrAt46z2QBSAEOOQ0JkhavH40aAjFV/qlCOgNbW1maZmShrORNXJh5ZLWaZzO/v7wxqETxaeFORkzRPaWaZZnGitEVyimCMtyVcSoixmaSzqIKvja6urry8vDdZQlSVaF6ajEJrTipZQ4SShHmjzqWlpWSBacfUx051nD+LT5W43KvIwDqJOluItDJLZG2nbYOt1id9JwBmALfQ4glIET1sc0CKXGOSwj5ce2ihgqPC4HCbxkiJei9cXkiCc4KuxXGmlBNpJFJ7pEVoig9HH5/Axqe9p3Wj0EuTUClWUlaCrYiw14SGhD93cHF2co+7mHun00txljlVcmWjZQAAAAAAACH5BAUUAH4ALAAAAAAUABQAAAf/gH6COSBRRT5yY0kRDzMOIDmCkoRDAVl9JSseaT8URI6Rgw4aeZYVilZKemVoTQSPfoRVXSqXci1WUzQyHB13DK+ED13EfbdWE1sUZgdXMShHjlFvL9UVA8jKF710bEBQJKNk4xJqERNgPzzcMVJ7NdFDEvNUnCnbOGHO3gs3RgRFqAisowVBHBkXTsAIwcZdGyZPSJgYWDBOBx1cWGiEIKCNC4gSCRq0YOHKGo0ahXgUA9JHRZL66KAEcMaFGD5I/sER4aRMryDOUM65+WFEBgWvtvjssI+NDZo7PvTAYoBBNAdwUgBt506IF6IFEmz492gGkRpc9yzY4YbPVAx4OCKCKsRgyZeONrEUNWAnYrBYDggcabIEBZPDSDI8MXI1FOAZghUYWcz4SDhIkiYFJsCZBGdQmQMBADs=',
];

function formatFileSize($int) {
    if ($int < 1024) {
        return $int . ' B';
    } elseif ($int < 1048576) {
        return round($int / 1024, 2) . ' kB';
    } elseif ($int < 1073741824) {
        return round($int / 1048576, 2) . ' MB';
    } else {
        return round($int / 1073741824, 2) . ' GB';
    }
}

function getAddress() {
    $version = VERSION;
    $os = PHP_OS;
    $php = PHP_VERSION;
    $date = date('Y-m-d H:i:s T');
    $time = date('c');
    return <<<HTML
directory-listing.php/$version <small>($os) PHP/$php compiled at <time datetime="$time">$date</time></small>
HTML;
}

function run() {
    global $path;
    foreach (glob($path . DIRECTORY_SEPARATOR .'*') as $file) {
        makeRow($file);
    }
}

function makeRow($file) {
    global $img;
    $filename = basename($file);
    $ext = pathinfo($file, PATHINFO_EXTENSION);
    $size = formatFileSize(filesize($file));
    $date = date('Y-m-d H:i', filemtime($file));
    $time = date('c', filemtime($file));

    $description = filetype($file);
    $icon = $img['unknown.gif'];
    $alt = '[   ]';
    if (is_dir($file)) {
        $icon = $img['folder.gif'];
        $alt = '[DIR]';
    }
    if (is_file($file)) {
        // if image
        if (in_array($ext, ['gif', 'jpg', 'jpeg', 'png', 'bmp'])) {
            $icon = $img['image2.gif'];
            $alt = '[IMG]';
        }
        // if video
        if (in_array($ext, ['mp3', 'wav', 'ogg', 'flac', 'aac', 'wma', 'm4a', 'mp4', 'avi', 'mkv', 'wmv', 'mpg', 'mpeg', 'mov', 'flv', '3gp', 'm4v'])) {
            $icon = $img['movie.gif'];
            $alt = '[VID]';
        }
        // if text
        if (in_array($ext, ['txt', 'md', 'markdown', 'php', 'html', 'css', 'js', 'json', 'xml', 'ini', 'sql', 'log', 'htaccess', 'htpasswd', 'htgroup', 'htdigest', 'sh', 'bat', 'cmd', 'c', 'cpp', 'h', 'hpp', 'java', 'py', 'pl', 'rb', 'sh', 'sql', 'yml', 'yaml', 'json', 'toml', 'xml', 'csv', 'tsv', 'xls', 'xlsx', 'doc', 'docx', 'ppt', 'pptx', 'pdf', 'epub', 'mobi'])) {
            $icon = $img['text.gif'];
            $alt = '[TXT]';
        }
        // if archive
        if (in_array($ext, ['zip', 'rar', '7z', 'tar', 'gz', 'iso', 'jar'])) {
            $icon = $img['tar.gif'];
            $alt = '[ARC]';
        }
        // if binary/executable
        if (in_array($ext, ['exe', 'dll', 'so', 'bin', 'sh', 'cgi', 'pl', 'py', 'php', 'asp', 'aspx', 'jsp', 'jar', 'bat', 'cmd', 'c', 'cpp', 'h', 'hpp', 'java', 'py', 'pl', 'rb', 'sh', 'sql', 'yml', 'yaml', 'json', 'toml', 'xml', 'csv', 'tsv', 'xls', 'xlsx', 'doc', 'docx', 'ppt', 'pptx', 'pdf', 'epub', 'mobi'])) {
            $icon = $img['binary.gif'];
            $alt = '[BIN]';
        }
        // if web page
        if (in_array($ext, ['html', 'htm'])) {
            $icon = $img['world1.gif'];
            $alt = '[WEB]';
        }
    }
    $row = <<<HTML
<tr>
    <td valign="top"><img src="$icon" alt="$alt"></td>
    <td><a href="$filename">$filename</a></td>
    <td><time datetime="$time">$date</time></td>
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
<address><?php echo getAddress() ?></address>
</body></html>
<?php
file_put_contents('index.html', ob_get_flush());