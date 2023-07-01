<?php
//function isLoggedIn() { return (isset($_COOKIE['login']) ? $_COOKIE['login'] : null);}
require_once('includes/looma-isloggedin.php');

// NOTE: this code sending "header" must be before ANY data is sent to client=side
$loggedin = loggedIn(); if (!$loggedin) header('Location: looma-login.php');
error_log("Starting Lesson Edit session. logged in as: " . $loggedin);
?>

<!doctype html>
<!--
Filename: looma-lesson-edit-lesson.php
Description: version 1 [SCU, Spring 2016]
             version 2 [skip, Fall 2016]x
Programmer name: SCU, skip
Owner: VillageTech Solutions (villagetechsolutions.org)
Date: version 1:spring 2016, version 2: Nov 16  version 3: spring 2018
Revision: Looma 4
 -->
<?php $page_title = 'Looma - Lesson Editor';
include ('includes/header.php');
include ('includes/js-includes.php');
include ('includes/looma-filecommands.php');
?>

<!-- <link rel="stylesheet" href="css/bootstrap.min.css">  -->

<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/looma-text-display.css">
<link rel="stylesheet" href="css/looma-edit-lessonNEW.css">

</head>

<body>

    <div id="setup-panel"  class="setup-panel" >
        <p>Select a textbook chapter</p>
        <p>to EDIT the lesson or to make a NEW lesson</p><br>
        <?php
            /*******************************************************/
            /****** TEXT BOOKS  ************************************/
            /*******************************************************/

            echo "<p>
                <label class='drop-menu'>Language:  </label>
                <input class = 'lang'
                       type = 'radio'
                       form = 'changes'
                       name = 'lang'
                       value = 'en'
                       checked  />
                <label for = 'en'>English</label>
                <input class = 'lang'
                       type = 'radio'
                       form = 'changes'
                       name = 'lang'
                       value = 'np' />
                <label for = 'np'>Nepali</label>
            </p>";

            echo "<div id='textbooks'>";
                /**************************************/
                /*********** TEXTBOOKS Grade Dropdown  **********/
                /**************************************/

                    echo "<div id='grade-changes' >
                        <label class='drop-menu'>Grade:&nbsp;</label>
                        <select id='grade-chng-menu' class='book-changes black-border'  form='changes' name='class'>
                            <option value='' selected>Select...</option>";
                            for($x = 1; $x <= 10; $x++){echo "<option value='" . $x . "' id='" . $x . "'>" . $x . "</option>";}
                        echo "</select>";
                    echo "</div>";

                    /**************************************/
                    /********* TEXTBOOKS Subject Dropdown  **********/
                    /**************************************/
                    echo "<div id='subject-changes' >
                        <label class='drop-menu'>Subject:</label>
                        <select id='subject-chng-menu' class='book-changes black-border' name='subj' form='changes'>
                            <option value='' selected>Select...</option>";

                            $classInfo = array(
                            array("all","EN",     "N",     "M",   "Ma", "S", "Sa",     "SS",  "SSa",          "H",      "V"),
                            array("All","English","Nepali","Math","Math Optional", "Science","Science Optional","Social Studies","Social Studies Optional","Health", "Vocation")
                            );
                            for($x = 1; $x < count($classInfo[0]); $x++) {
                            echo "<option name='subj' value='" . $classInfo[0][$x] . "'>" . $classInfo[1][$x] . "</option>";}
                        echo "</select>";
                    echo "</div>";

                    /**************************************/
                    /********* TEXTBOOKS Chapter Dropdown  **********/
                    /**************************************/
                    echo "<div id='chapter-changes' >
                        <label class='drop-menu'>Chapter:</label>
                        <select id='chapter-chng-menu' class='book-changes black-border' name='chapter' form='changes'>
                            <option value='' selected>Select...</option>
                        </select>";
                    echo "</div>";
        ?>
            <p id="warning"></p>
            <button id="setup-panel-select" class="select">Select</button>
            <button id="setup-panel-back" class="cancel">Cancel</button>
        </div>
    </div>

<div id = "main-container">
    <?php   include('includes/looma-control-buttons.php');?>

    <div id="header" class="inner-div">
        <div id="title">Editing: <span class="filename">&lt;none&gt;</span> </div>
        <img src="images/logos/LoomaLogoTransparent.png"  height="100%"/>
        <span>Looma Lesson Editor</span>
    </div>

    <div id="search-bar" class="inner-div">
        <?php include ('includes/looma-search.php');?>
    </div>
    <div id="text-editor-buttons">
        <div class="btn-toolbar"
             data-role="editor-toolbar"
             data-target="#editor">

                <div class="button  text-edit dropdown-toggle" data-toggle="dropdown" title="Text Highlight Color"><i class="fa fa-2x fa-paint-brush"></i>&nbsp;<b class="caret"></b></div>
                <ul class="dropdown-menu">
                    <p>&nbsp;&nbsp;&nbsp;Text Highlight Color:</p>
                    <li><a data-edit="backColor #FFFFFF">White</a></li>
                    <li><a data-edit="backColor #FFFF00">Yellow</a></li>
                    <li><a data-edit="backColor #FF7F00">Orange</a></li>
                    <li><a data-edit="backColor #FF0000">Red</a></li>
                    <li><a data-edit="backColor #00FF00">Green</a></li>
                    <li><a data-edit="backColor #091F48">Looma Blue</a></li>
                </ul>
                <div class="button   text-edit dropdown-toggle" data-toggle="dropdown" title="Font Color"><i class="fa fa-2x fa-font"></i>&nbsp;<b class="caret"></b></div>
                <ul class="dropdown-menu">
                    <p>&nbsp;&nbsp;&nbsp;Font Color:</p>
                    <li><a data-edit="foreColor #FFFFFF">White</a></li>
                    <li><a data-edit="foreColor #FFFF00">Yellow</a></li>
                    <li><a data-edit="foreColor #FF7F00">Orange</a></li>
                    <li><a data-edit="foreColor #FF0000">Red</a></li>
                    <li><a data-edit="foreColor #30AD23">Green</a></li>
                    <li><a data-edit="foreColor #091F48">Blue</a></li>  <!-- 091F48 -->
                    <!-- <li><a data-edit="foreColor #000000">Black</a></li> -->
                </ul>

                <!--           <a class="button text-edit btn-info" data-edit="bold"   title="Bold"><i class="fa fa-2x fa-bold"></i></a>
                               <a class="button text-edit" data-edit="italic" title="Italic"><i class="fa fa-2x fa-italic"></i></a>
                               <a class="button text-edit" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-2x fa-strikethrough"></i></a>
                 -->
                <div class="button text-edit" data-edit="underline" title="Underline"><i class="fa fa-2x fa-underline"></i></div>

                <!-- add CLASS "btn-info" to pre-select a button-->
                <div class="button text-edit" data-edit="left"   title="Align Left"><i class="fa fa-2x fa-align-left"></i></div>
                <div class="button text-edit  btn-info" data-edit="center" title="Center"><i class="fa fa-2x fa-align-center"></i></div>
                <div class="button text-edit" data-edit="right"  title="Align Right"><i class="fa fa-2x fa-align-right"></i></div>
                <!--
              <a class="button text-edit" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-2x fa-align-justify"></i></a>
               -->

                <div class="button text-edit" data-edit="undo" title="Undo"><i class="fa fa-2x fa-undo"></i></div>
                <div class="button text-edit" data-edit="redo" title="Redo"><i class="fa fa-2x fa-repeat"></i></div>
                <div class="button text-edit wide" data-edit="translate">Translate</></div>
                <div class="button text-edit wide" data-edit="save">Save</></div>
                <div class="button text-edit wide" data-edit="cancel">Cancel</></div>
        </div>
    </div>
    <div id="outerResultsDiv">
        <div id="innerResultsMenu"></div>
        <div id="results-div"></div>
        <div id="innerResultsDiv">
            <span class="hint">Search Results</span>
        </div>
    </div>

    <button type="button" id="edit-text-file">Edit text file</button>

    <div id= "previewpanel">

        <span class="hint">Preview Area</span>
        <div id="hints">
        </div>
    </div>

    <div id = "timeline">
        <div class="timelineCenter" id="timelineDisplay">
            <span class="hint">Use File Commands "Open" or "New" to edit a lesson</span>

        </div>
    </div>

    <div id="lesson-title">
        <span id="subtitle"></span>
        <span>Looma Lesson:&nbsp; <span class="filename"></span></span>
    </div>

    <button type="button" id="timelineLeft" class="timelineScroll"></button>
    <button type="button" id="timelineRight" class="timelineScroll"></button>

</div>


    <img id="padlock"
     draggable="false"
     src="  <?php echo loggedIn() ? "images/padlock-open.png" : "images/padlock-closed.png"; ?>" >

<p id="login-id" ><?php if (loggedIn()) echo "You are logged in as '" . $_COOKIE['login'] ."'" ?></p>

<button class='control-button' id='dismiss' ></button>

<script src="js/jquery-ui.min.js">  </script>
<script src="js/jquery.hotkeys.js"> </script>
<script src="js/tether.min.js">  </script>
<script src="js/bootstrap.min.js">  </script>
<script src="js/looma-search.js"></script>
<script src="js/looma-media-controls.js"></script>
<script src="js/looma-edit-lessonNEW.js"></script>

</body>
</html>

