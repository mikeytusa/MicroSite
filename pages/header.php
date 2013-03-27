<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?= $title ?></title>
    <meta name="description" content="<?= $desc ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Page specific CSS -->
    <? if (file_exists('assets/css/' . $page . '.css')): ?>
    <link href="/assets/css/<?= $page ?>.css" rel="stylesheet">
    <? endif; ?>

</head>
 
<body>

<!-- This is where all of your fancy header code will go. -->
