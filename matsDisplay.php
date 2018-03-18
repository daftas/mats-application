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
        $matsGeneral->getAppStore(),
        $matsGeneral->getLifecycle(),
        $matsGeneral->getTotalStories(),
        $matsGeneral->getFromInput("est")));
    ?>
    </h5>
    <hr>
</head>
<body>
<table>
    <?php
    print ("<tr><td><b>Complexity Points: </b></td><td><p>{$matsScore->calculateComplexity()}</p></td></tr>
<tr><td><b>Estimated time on the project: </b></td><td><p>{$matsScore->calculateEstimate()}</p></td></tr>
<tr><td><b>Story points re-calculated: </b></td><td><p>{$matsScore->calculateStoryPoints()}</p></td></tr>
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