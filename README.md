# php-directory-listing
Generate a directory listing HTML file for the current directory.

Works without dependencies, contained in a single file. Indented as a polyfill for static sites, but works just fine as a live viewer.

Live demo: https://caendesilva.github.io/hyde-monorepo/master/

## Usage

### Install
```bash
wget https://raw.githubusercontent.com/caendesilva/php-directory-listing/master/directory-listing.php -O directory-listing.php
```

### Generate static HTML
```bash
php directory-listing.php
```

An index.html file will be created in the current directory. Warning: this will overwrite any existing index.html file.

Tip: you may want to pin the download to a specific commit SHA instead of the latest master version.

### Dynamic live listing

You can also use it as a live viewer through a web server or the built in PHP web server.

## Attributions

Highly inspired by the default Apache directory listings, but recreated from scratch as a PHP exercise.

Icons are in the public domain and provided by
[www.ideocentric.com](http://web.archive.org/web/20170708074904/http://www.ideocentric.com/technology/articles/title/apache-icons)
