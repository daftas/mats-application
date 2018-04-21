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
<h3>Detail project estimation:</h3><br>
<table>
    <tr>
        <th>Minimum estimated project time</th>
        <th>Maximum estimated project time</th>
        <th>Standard deviation</th>
        <th>Most likely project estimation</th>
    </tr>
    <tr>
        <?php $matsScore->calcProjectEstimate($a); ?>

</table>
<hr>
<h3>Story testing estimation:</h3><br>
<table>
    <tr>
        <th>Fibanaci story point</th>
        <th>Total story count</th>
        <th>Story weight (fib * story count)</th>
        <th>Normalized numbers</th>
        <th>Effort coefficient for one story (normal / story count)</th>
        <th>Single story time allocated</th>
        <th>Single story test time allocated</th>
    </tr>
<!--    <tr>-->
<!--        <td>3</td>-->
<!--        --><?php //$matsScore->calculateStoryTestingTime($matsGeneral::NAME_FIBANACI_STORY_POINT_3); ?>
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>5</td>-->
<!--        --><?php //$matsScore->calculateStoryTestingTime($matsGeneral::NAME_FIBANACI_STORY_POINT_5); ?>
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>8</td>-->
<!--        --><?php //$matsScore->calculateStoryTestingTime($matsGeneral::NAME_FIBANACI_STORY_POINT_8); ?>
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>13</td>-->
<!--        --><?php //$matsScore->calculateStoryTestingTime($matsGeneral::NAME_FIBANACI_STORY_POINT_13); ?>
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>21</td>-->
<!--        --><?php //$matsScore->calculateStoryTestingTime($matsGeneral::NAME_FIBANACI_STORY_POINT_20); ?>
<!--    </tr>-->
</table>
<hr>
</body>
</html>