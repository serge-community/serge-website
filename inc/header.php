<?php

    function menuSel($menu_page) {
        global $page;
        return ($page == $menu_page) ? ' class="selected"' : '';
    }

?>
<html>
<head>
    <title>Serge - Localization Toolkit</title>
    <link rel="stylesheet" href="/media/main.css" type="text/css" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
    <div class="wrapper">
        <div class="header-bg"></div>
        <div class="header">
            <a class="logo" href="/"><img src="/media/logo.png" />Serge</a>

            <ul class="menu<?php echo $subselection ? ' subselection' : '' ?>">
                <li><a href="/"<?php echo menuSel('index') ?>>Home</a></li>
                <li><a href="/download/"<?php echo menuSel('download') ?>>Download</a></li>
                <li><a href="/documentation/"<?php echo menuSel('documentation') ?>>Documentation</a></li>
                <li><a href="/contact/"<?php echo menuSel('contact') ?>>Contact Us</a></li>
                <li class="extra"><a href="//evernote.com">evernote.com</a></li>
            </ul>
        </div>

        <div class="content">

