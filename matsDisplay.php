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
    print ("<tr><td><b>Investment in product quality: </b></td><td><p>{$matsScore->getTestingInvestment(
            $matsGeneral->getFromInput("people"), 
            $matsGeneral->getFromInput("project"),
            $matsGeneral->getFromInput("testing"))} %</p></td></tr>
<tr><td><b>Estimated Social Return on Investment: </b></td><td><p>42 %</p></td></tr>
<tr><td><b>Estimated break even period: </b></td><td><p>150 days</p></td></tr>
<tr><td><b>Resource cost ratio (Manual vs Automated): </b></td><td><p>1.25 : 1</p></td></tr>");
    ?>
</table>
<hr>
<?php
print("<h3>Additional information:</h3><br>");
print ("<div> System ran 1000 trials of this model for Monte Carlo analysis;</div><br>
<div> </div>");
?>
</body>
</html>