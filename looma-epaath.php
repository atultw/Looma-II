<!doctype html>
<!--
Name: Skip

Owner: VillageTech Solutions (villagetechsolutions.org)
Date: 2019 03
Revision: Looma 4.2
File: looma-epaath.php
Description:  base page for showing epaath content=
            call with "...?epversion=2015& fp= &fn=   "
            or, call with "...?epversion=2019&oleID=   "
-->

<?php
    $page_title = 'Looma ePaath';
    include ('includes/header.php');
    logFiletypeHit('epaath');
?>
<link rel="stylesheet" href="css/looma-html.css">
</head>

<body>
<?php
$epversion = $_REQUEST['epversion'];

if ($epversion == '2015') {  // old ePaath activities from 2016
        $filename = $_REQUEST['fn'];
        $filepath = $_REQUEST['fp'];
        $src = $filepath . $filename;
    }
    else  if ($epversion === '2019') {  // new ePaath activities from 2019
        $oleID = $_REQUEST['ole'];
        $grade = $_REQUEST['grade'];
        $src = 'ePaath/';
        if ($grade == '7' || $grade == '8') $src .= 'EPaath7-8/';

        $language = '&lang=' . $_REQUEST['lang'];
//if $oleID === 'index' then open with index page
        $src .= 'start.html?id=' . $oleID;
        $src .= $language . '&grade=' . $grade;
        //echo $language;return;
    }
    else {  // version is 2022
        $oleID = $_REQUEST['ole'];
        $grade = $_REQUEST['grade'];
        $src = 'ePaath/ePaath2022/';

        $language = '&lang=' . $_REQUEST['lang'];

//if $oleID === 'index' then open with index page
        $src .= 'start.html?id=' . $oleID;
        $src .= $language . '&grade=' . $grade;
    }
?>
<div id="main-container-horizontal">
    <div id="fullscreen" data-ep="true">
        <!-- NOTE the iframe below has name='looma-frame', and wikipedia articles in looma have <a xxx.htm target="looma-frame" -->
        <!--  $SRC = http://localhost/epaath?epversion=2019&ole=mataoe01&lang=english&sub=english&grade=5   -->
        <?php echo "<iframe id='iframe' name='looma-frame' src='" . $src . "' allowfullscreen>" ?></iframe>
        <?php include('includes/looma-control-buttons.php')?>
    </div>
</div>

<?php include ('includes/toolbar.php'); ?>
<?php include ('includes/js-includes.php'); ?>
<script src="js/looma-html.js"></script>
