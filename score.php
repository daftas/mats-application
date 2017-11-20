<?php
/**
 * Created by PhpStorm.
 * User: ramunas.andrijauskas
 * Date: 10/20/2017
 * Time: 3:59 PM
 */
$people = $_GET["people"];
$project = $_GET["project"];
$project_type = $_GET["project_type"];
$investmentAmount = '20%';
$sroi = '17%';
$estPrice = '0.99';

$pattern = "You have %s people working.
<br>Your project have %s working days in total
<br>Your project type is: %s";

switch($project_type){
    case $project_type === "commercial_project":
        $project_type = "Komercinis projektas";
        break;
    case $project_type === "internal_project":
        $project_type = "Vidinis projektas";
        break;
}

?> <!<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MATS Application</title>
    <h5>
<?php print(sprintf($pattern, $people, $project, $project_type)); ?>
    </h5>
    <hr>
</head>
<body>
<table>
<?php
print ("<tr><td><b>Investment in product quality: </b></td><td><p>{$investmentAmount}</p></td></tr>
<tr><td><b>Estimated Social Return on Investment: </b></td><td><p>{$sroi}</p></td></tr>");
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