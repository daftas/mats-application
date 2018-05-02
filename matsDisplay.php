<?php

/**
 * matsDisplay.php
 * @copyright © 2018 Ramunas Andrijauskas
 */

require_once("matsGeneral.php");
require_once("matsScore.php");
require_once ("matsComplexity.php");

$matsGeneral = new matsGeneral();
$matsComplexity = new matsComplexity();
$matsScore = new matsScore();
$a = $matsScore->runMonteCarloProject();
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
</head>
<body>
<h3>Project information:</h3><br>
<div>System ran <?php echo $matsGeneral::NUMBER_MONTE_CARLO_TRIALS ?> trials of this model for Monte Carlo analysis;</div><br>
<div>Total complexity points for this project: <?php echo $matsComplexity->getComplexityPoints();?></div>
<div>Skewness (PERT gamma number) for this project is: <?php echo $matsComplexity->calcPertGamma();?></div>
<div>Testing effort for the project: <?php echo $matsComplexity->calcTestingEffort();?></div>
<hr>
<h3>Detail project estimation:</h3><br>
<table>
    <tr>
        <th>Minimum estimated project time</th>
        <th>Maximum estimated project time</th>
        <th>Most likely project estimation</th>
        <th>Probability for a project to end on this day:</th>
    </tr>
    <tr>
        <?php $matsScore->calcProjectProbability($a); ?>
<hr>
<h3>Story testing estimation:</h3><br>
<table>
    <tr>
        <th>Fibonacci story point</th>
        <th>Story count</th>
        <th>Range of each story testing</th>
        <th>Average test time of each story</th>
    </tr>
        <?php $matsScore->calcProjectStories($a); ?>
    <br>
    <div><b>Testing tools and methodologies recommended:</b></div>
        <?php $matsComplexity->getTestingMethods(); ?>.
<hr>
</body>
</html>