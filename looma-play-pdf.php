<!doctype html>
<!--
LOOMA php code file
Filename: xxx.php
Description:

Programmer name:
Email:
Owner: VillageTech Solutions (villagetechsolutions.org)
Date:
Revision: Looma 2.0.x

Comments:
-->

<?php $page_title = 'Looma - PDF viewer';
include ('includes/header.php');
?>
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/looma-play-pdf.css">


</head>

<body>

<?php
    $filename = (isset($_REQUEST['fn']) ?   urldecode($_REQUEST['fn']) : "");
    $filepath = (isset($_REQUEST['fp']) ?   urldecode($_REQUEST['fp']) : "");
    $pagenum =  (isset($_REQUEST['page']) ? urldecode($_REQUEST['page']) : 1);
    $len =      (isset($_REQUEST['len']) ?  urldecode($_REQUEST['len']) : 999);
    $zoom =     (isset($_REQUEST['zoom']) ? urldecode($_REQUEST['zoom']) : "page-width");
?>

<div id="main-container-vertical">

    <div id="pdf-toolbar" class="pdf-toolbar">

                <button class="toolbar-button blank"></button>

                <button id="showthumbs" class="toolbar-button">
                    <img draggable="false" src="images/info.png">
                    <?php tooltip("Show pages") ?>
                </button>


                <!-- implement FIND later
                <button id="find" class="toolbar-button ">
                    <img draggable="false" src="images/search.png"   >
                    <?php //tooltip("Find") ?>
                </button>
                -->
                <button class="toolbar-button blank"></button>

                <button id="prev-page" class="toolbar-button ">
                    <img draggable="false" src="images/looma-up.png"   >
                    <?php tooltip("Next") ?>
                </button>

                <button id="next-page" class="toolbar-button ">
                    <img draggable="false" src="images/looma-down.png"   >
                    <?php tooltip("Previous") ?>
                </button>

                <button class="toolbar-button blank"></button>

                <span>Page&nbsp</span>
                <input id="pagenum"></input>
                <span> &nbspof&nbsp</span>
                <span id="maxpages"></span>

                <button class="toolbar-button blank"></button>

                <button id="zoom-out" class="toolbar-button ">
                    <img draggable="false" src="images/minus.png"   >
                    <?php tooltip("Zoom out") ?>
                </button>

                <button id="zoom-in" class="toolbar-button ">
                    <img draggable="false" src="images/plus.png"   >
                    <?php tooltip("Zoom in") ?>
                </button>


        <span id="zoom-label">Zoom:</span>
        <div id="zoom-menu" class="btn-group">
            <button type="button" id="zoom-btn" class="btn" data-toggle="dropdown" data-zoom="Page width">
            Page width
                <i class="fa fa-caret-down" aria-hidden="true"></i>
            </button>
            <div id="zoom-dropdown" class="dropdown-menu">
                <button class="dropdown-item zoom-item" data-level="2.3" data-zoom="Page width">Page width</button><br>
                <button class="dropdown-item zoom-item" data-level="1.7" data-zoom="Page fit">Page fit  </button><br>
                <button class="dropdown-item zoom-item" data-level="1.15" data-zoom="50%">50%       </button><br>
                <button class="dropdown-item zoom-item" data-level="2.3" data-zoom="100%">100%       </button><br>
                <button class="dropdown-item zoom-item" data-level="4.6" data-zoom="200%">200%       </button><br>
                <button class="dropdown-item zoom-item" data-level="9.2" data-zoom="400%">400%       </button><br>
            </div>
        </div>



    </div>

<?php   echo '<div id="fullscreen">';
        echo '<div id="pdf" class="scroll"'  .
                 '  data-fn="' .    $filename .
                 '" data-fp="' .   $filepath .
                 '" data-page="' . $pagenum .
                 '" data-len="' . $len .
                 '" data-zoom="'.  $zoom .'">';
        echo '</div>';

        include ('includes/looma-control-buttons.php');
?>
    </div>

<div id="thumbs"></div>
</div>

<?php
    include ('includes/toolbar-vertical.php');
    include ('includes/js-includes.php');
?>
<script src="js/pdfjs/pdf.min.js"></script>
<script src="js/looma-play-pdf.js"></script>
</body>