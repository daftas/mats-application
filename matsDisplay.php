<?php

/**
 * matsDisplay.php
 * @copyright © 2018 Ramunas Andrijauskas
 */

require_once("matsGeneral.php");
require_once("matsScore.php");

$matsGeneral = new matsGeneral();
$matsComplexity = new matsComplexity();
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
        <th>Story Count</th>
        <th>Total Estimate</th>
        <th>Story Coeff</th>
        <th>Story Total Time</th>
        <th>Single Story Time</th>
        <th>Single Story Test Time</th>
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
<table>
    <tr>
        <th>Name</th>
        <th>Original minimum</th>
        <th>Original maximum</th>
        <th>Original std.dev</th>
        <th>Normal average</th>
        <th>Normal minimum</th>
        <th>Normal maximum</th>
        <th>Normal calculated optimal est</th>
        <th>Normal std.dev</th>
    </tr>
    <tr>
        <td>Estimate using bell curve</td>
        <?php $matsComplexity->runMonteCarlo(); ?>
    </tr>
</table>
</body>
</html>