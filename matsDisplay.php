<?php

/**
 * matsDisplay.php
 * @copyright © 2018 Ramunas Andrijauskas
 */

require_once("matsGeneral.php");
require_once("matsScore.php");

$matsGeneral = new matsGeneral();
$matsScore = new matsScore();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MATS Application</title>
    <h5>
    <?php
    print(sprintf(
        $matsGeneral->getPattern(),
        $matsGeneral->getFromInput("people"),
        $matsGeneral->getFromInput("project"),
        $matsGeneral->getFromInput("testing"),
        $matsGeneral->getFromInput("story"),
        $matsGeneral->getFromInput("complexity"),
        $matsGeneral->getAppStore()));
    ?>
    </h5>
    <hr>
</head>
<body>
<table>
    <?php
    print ("<tr><td><b>Investment in product quality: </b></td><td><p>{$matsScore->getDay($matsGeneral->getFromInput("testing"), 
    $matsGeneral->getFromInput("story"))} %</p></td></tr>
<tr><td><b>Estimated Social Return on Investment: </b></td><td><p>17 %</p></td></tr>
<tr><td><b>Estimated break even period: </b></td><td><p>90 days</p></td></tr>
<tr><td><b>Resource cost ratio (Manual vs Automated) </b></td><td><p>1.25 : 1</p></td></tr>");
    ?>
</table>
<hr>
<?php
print("<h3>Recommendations for project based on results:</h3><br>");
print ("<div>- Application price of ~{$estPrice}$ can be applied on Google store;</div><br>
<div>- Estimating that testing should start 20 days into the project;</div>");
?>
</body>
</html>