<?php

header( 'Content-Type: application/xml' );
echo '<?xml version="1.0" encoding="utf-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

$exclusions = array();
$robots = file('../robots.txt', FILE_IGNORE_NEW_LINES + FILE_SKIP_EMPTY_LINES);

foreach ($robots as $robot)
	if (preg_match('/^Disallow: (.*)$/', $robot, $matches))
		$exclusions[] = $matches[1];

function crawl_dir($dir = '/') {
	global $exclusions;
	$dh = opendir('../pages' . $dir);
	while ($file = readdir($dh)) {
		if (preg_match('/^[^_]+\.php$/', $file)) {
			$loc = $dir . substr($file, 0, -4);
			if (in_array($loc, $exclusions))
				continue;
?>
    <url>
        <loc>http://<?= $_SERVER['HTTP_HOST'] . $loc ?></loc>
        <lastmod><?= date('c', filemtime('../pages' . $dir . $file)) ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>1</priority>
    </url>
<?
		} elseif (is_dir('../pages' . $dir . $file) && $file != '.' && $file != '..') {
			crawl_dir($dir . $file . '/');
		}
	}
	closedir($dh);
}

crawl_dir();

echo "</urlset>\n";

?>