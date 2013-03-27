<?php

$page = trim($_SERVER['REQUEST_URI'], '/');
if (!$page)
  $page = 'home';

if (!file_exists('pages/' . $page . '.php'))
  $page = '404';

ob_start();
include('pages/' . $page . '.php');
$content = ob_get_clean();

include('pages/header.php');
echo $content;
include('pages/footer.php');

?>