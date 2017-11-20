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

$pattern = "You have %s people working.
<br>Your project have %s working days in total.
<br>Your project type is: %s";

switch($project_type){
    case $project_type === "commercial_project":
        $project_type = "Komercinis projektas";
        break;
    case $project_type === "internal_project":
        $project_type = "Vidinis projektas";
        break;
}


print(sprintf($pattern, $people, $project, $project_type));