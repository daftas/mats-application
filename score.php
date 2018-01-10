<?php
/**
 * Created by PhpStorm.
 * User: ramunas.andrijauskas
 * Date: 10/20/2017
 * Time: 3:59 PM
 */
// vars from input
$people = $_GET["people"];
$project = $_GET["project"];
$testing = $_GET["testing"];
$budget = $_GET["budget"];
$story = $_GET["story"];
$project_type = $_GET["project_type"];
// temp
$sroi = '17';
$breakEven = '90';
$ratio = '1.25';
$estPrice = '0.99';

$pattern = "You have %s people working.
<br>Your project have %s working days in total
<br>Your project have %s of project working days dedicated to testing
<br>Your budget to spend on testing is %s %% from all the project budget
<br>Your estimated number of user stories in project is %s
<br>Your project type is: %s";

switch($project_type){
    case $project_type === "commercial_project":
        $project_type = "Komercinis projektas";
        break;
    case $project_type === "internal_project":
        $project_type = "Vidinis projektas";
        break;
}

switch($project_type){
    case $project_type === "commercial_project":
        $project_type = "Komercinis projektas";
        break;
    case $project_type === "internal_project":
        $project_type = "Vidinis projektas";
        break;
}

?> <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MATS Application</title>
    <h5>
<?php print(sprintf($pattern, $people, $project, $testing, $budget, $story, $project_type));?>
    </h5>
    <hr>
</head>
<body>
<table>
<?php
print ("<tr><td><b>Investment in product quality: </b></td><td><p>{$budget} %</p></td></tr>
<tr><td><b>Estimated Social Return on Investment: </b></td><td><p>{$sroi} %</p></td></tr>
<tr><td><b>Estimated break even period: </b></td><td><p>{$breakEven} days</p></td></tr>
<tr><td><b>Resource cost ratio (Manual vs Automated) </b></td><td><p>{$ratio} : 1</p></td></tr>");
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