<!DOCTYPE html>
<html>
    <head>
        <title><?php
            echo 'Hostel-J ';
            if (isset($title))
                echo "| $title";
            ?></title>
        <meta content="text/html; charset=UTF-8; X-Content-Type-Options=nosniff"  />
        <meta http-equiv="Cache-control" content="no-store">
        <meta http-equiv="Content-Security-Policy" content="script-src 'self' http://fonts.googleapis.com 'unsafe-inline' 'unsafe-eval'" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/main.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/strength.css" />
        <script src="<?php echo base_url(); ?>public/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.dropotron.min.js" defer></script>
        <script src="<?php echo base_url(); ?>public/js/skel.min.js" defer></script>
        <script src="<?php echo base_url(); ?>public/js/main.js" defer></script>
        <script src="<?php echo base_url(); ?>public/js/util.js" defer></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.popupoverlay.js" ></script>
        
        <style>
            html, body {
                max-width: 100%;
                overflow-x: hidden;
            }
            #fadeandscale {
                transform: scale(0.8);
            }
            .popup_visible #fadeandscale {
                transform: scale(1);
            }
        </style>
    </head>
    <body>
        <header id="header" class="<?php
        if (isset($title)) {
            if ($title == 'Home')
                echo "alt";
            else
                echo "skel-layers-fixed";
        }
        ?>">
            <h1 style="font-size:30px "><a href="<?php echo base_url(); ?>">HOSTEL-J</a><a href="http://www.thapar.edu" target="_blank" style="font-weight:100"> Thapar University</a></h1>
            <nav id="nav">      <h1 style="font-size:30px "><a href="">HOSTEL-J</a><a href="login.php">Sign In</a><a href="http://www.thapar.edu" target="_blank" style="font-weight:100"> Thapar University</a></h1>

            </nav>
        </header>