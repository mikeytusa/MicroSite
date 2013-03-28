<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?= $title ?></title>
    <meta name="description" content="<?= $desc ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Let's load up some stylesheets -->
    <link rel="stylesheet" href="/assets/css/common/main.css">
    <!-- Apple icons -->
    <link rel="apple-touch-icon" href="/assets/img/apple/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/assets/img/apple/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/assets/img/apple/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/assets/img/apple/apple-touch-icon-144x144.png">
    <!-- Page specific CSS -->
    <? if (file_exists('assets/css/' . $page . '.css')): ?>
    <link href="/assets/css/<?= $page ?>.css" rel="stylesheet">
    <? endif; ?>

</head>
 
<body>

<!-- This is where all of your fancy header code will go. -->
