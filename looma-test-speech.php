<?php
//function isLoggedIn() { return (isset($_COOKIE['login']) ? $_COOKIE['login'] : null);};
require_once('includes/looma-isloggedin.php');

// NOTE: this code sending "header" must be before ANY data is sent to client=side
$loggedin = loggedIn(); if (!$loggedin) header('Location: looma-login.php');
error_log("Starting Dictionary Edit session. logged in as: " . $loggedin);
?>


<?php $page_title = 'Looma Speech Test Page';
require_once ('includes/header.php');
define ("CLASSES", 8);
?>

<link rel="stylesheet" href="css/looma.css">
<link rel="stylesheet" href="css/looma-test-speech.css">

</head>

<body>
    <div id="main-container-horizontal">
        <p id="prompt">Enter a phrase to speak:  </p>
        <input type="text" id="text" size="250" value="Hello this is Looma">
        <button id="mimic">Speak with mimic/larynx </button>
        <button id="piper">Speak with piper </button>
        <button id="synthesis">Speak with speechSynthesis [uses local browser]</button>

        <div id="rateDiv">
            <span>Enter speech rate here (higher is faster)</span>
            <select id="rate">
                <option value="0.50">         1/2</option>
                <option value="0.67" selected>2/3</option>
                <option value="1">            1  </option>
                <option value="1.5">          1.5</option>
                <option value="2">            2  </option>
            </select>
        </div>

        <!--
        NOTE: the voice menus below should be populated by checking what voices are actually loaded
        -->

        <div id="piper-voicelist" class=" voicelist settings-control">
            <span>Change voice for piper:  </span>
            <select id="piper-voices">
                <option data-engine="piper" class="voice" id="ne_NP-google-medium.onnx"  value="cmu_us_aupne_NP-google-medium.onnx"> Nepali </option>
                <option data-engine="piper" class="voice" id="en_US-amy-medium.onnx"  value="en_US-amy-medium.onnx"> English (US female) </option>
            </select>
        </div>
        <div id="mimic-voicelist" class="voicelist settings-control" hidden>
            <span>Change voice of Looma speaking:  </span>
            <select id="mimic-voices">
                <option data-engine="mimic" class="voice" id="cmu_us_aup"  value="cmu_us_aup">   Indian male (aup) </option>
                <option data-engine="mimic" class="voice" id="cmu_us_awb"  value="cmu_us_awb">   Scottish male (awb) </option>
                <option data-engine="mimic" class="voice" id="cmu_us_bdl"  value="cmu_us_bdl">   US male (bdl) </option>
                <option data-engine="mimic" class="voice" id="cmu_us_clb"  value="cmu_us_clb">   US female (clb) </option>
                <option data-engine="mimic" class="voice" id="cmu_us_aew"  value="cmu_us_aew">   US male (aew) </option>
                <option data-engine="mimic" class="voice" id="cmu_us_ahw"  value="cmu_us_ahw">   German male (ahw) </option>
                <option data-engine="mimic" class="voice" id="cmu_us_axb"  value="cmu_us_axb">   Indian female (axb) </option>
                <option data-engine="mimic" class="voice" id="cmu_us_eey"  value="cmu_us_eey">   US female (eey) </option>
                <option data-engine="mimic" class="voice" id="cmu_us_fem"  value="cmu_us_fem">   German male (fem) </option>
                <option data-engine="mimic" class="voice" id="cmu_us_gka"  value="cmu_us_gka">   Indian male (gka) </option>
                <option data-engine="mimic" class="voice" id="cmu_us_jmk"  value="cmu_us_jmk">   US male (jmk) </option>
                <option data-engine="mimic" class="voice" id="cmu_us_ksp"  value="cmu_us_ksp">   Indian male (ksp) </option>
                <option data-engine="mimic" class="voice" id="cmu_us_ljm"  value="cmu_us_ljm">   US female (ljm) </option>
                <option data-engine="mimic" class="voice" id="cmu_us_rms"  value="cmu_us_rms">   US male (rms) </option>
                <option data-engine="mimic" class="voice" id="cmu_us_rxr"  value="cmu_us_rxr">   US male (rxr) </option>
                <option data-engine="mimic" class="voice" id="cmu_us_slt"  value="cmu_us_slt">   US female (slt) </option>
                <option data-engine="mimic" class="voice" id="mycroft_voice_4.0"  value="mycroft_voice_4.0">   English male (mycroft) </option>
            </select>
        </div>

    </div>
    <?php include ('includes/toolbar.php'); ?>
    <?php include ('includes/js-includes.php'); ?>

    <script src="js/looma-test-speech.js"></script>

    <script src="https://code.responsivevoice.org/responsivevoice.js?key=r2w8pU3y"></script>

</body>

</html>
