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
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
    </style>
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
    <tr>
        <th>Story type</th>
        <th>Story Total</th>
        <th>Story Time</th>
        <th>Original Test Time</th>
        <th>Min test value</th>
        <th>Average test value</th>
        <th>Max test value</th>
        <th>Test Time</th>
        <th>Std.Dev</th>
    </tr>
    <tr>
        <td>Low complexity story</td>
        <?php $matsScore->calculateStoryTestingTime($matsGeneral::NAME_LOW_COMPLEXITY_STORY); ?>
    </tr>
    <tr>
        <td>Moderate complexity story</td>
        <?php $matsScore->calculateStoryTestingTime($matsGeneral::NAME_MID_COMPLEXITY_STORY); ?>
    </tr>
    <tr>
        <td>High complexity story</td>
        <?php $matsScore->calculateStoryTestingTime($matsGeneral::NAME_HIGH_COMPLEXITY_STORY); ?>
    </tr>
</table>
<hr>
<h3>Additional information:</h3><br>
<?php print "
<div> Using three point estimate, your most likely project time estimation is: {$matsScore->calculateEstimate()} days;</div><br>";?>
<div> System ran <?php echo $matsGeneral::NUMBER_MONTE_CARLO_TRIALS ?> trials of this model for Monte Carlo analysis;</div><br>
<div></div>
</body>
</html>