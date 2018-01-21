<?php
/**
 * matsScore.php
 * @copyright © 2018 Ramunas Andrijauskas
 */
require_once("matsMonteCarlo.php");

class matsScore extends matsGeneral

{

//switch($project_type){
//    case $project_type === "commercial_project":
//        $project_type = "Komercinis projektas";
//        break;
//    case $project_type === "internal_project":
//        $project_type = "Vidinis projektas";
//        break;
//}

    /**
     * @param $pe
     * @param $pr
     * @param $te
     * @return float
     */
    public function getTestingInvestment($pe, $pr, $te)
    {
        $matsMonteCarlo = new matsMonteCarlo();
        $a = $matsMonteCarlo->generateMCValueMedium($pe);
        $b = $matsMonteCarlo->generateMCValueMedium($pr);
        $c = $matsMonteCarlo->generateMCValueMedium($te);
        $result = round(((($a*$c)/($a*$b))*100));
        // $result = generateMonteCarloValue($te)/generateMonteCarloValue($pr)*generateMonteCarloValue($pe);
        echo ("{$a}\n");
        echo ("{$b}\n");
        echo ("{$c}\n");
        echo ("{$result}\n");
        return $result;
    }

    /**
     * @param $testingTime
     * @param $userStories
     * @return float|int
     */
    public function getDay($testingTime, $userStories)
    {
        $matsMonteCarlo = new matsMonteCarlo();
        $mcValues = array();
        $dist = $testingTime / $userStories;
        $userStoriesTemp = $userStories;
        while ($userStoriesTemp != 0) {
            $nMC = $matsMonteCarlo->generateMCValueLow($dist);
            array_push($mcValues, $nMC);
            $userStoriesTemp--;
        }
        $testingTimeMC = $matsMonteCarlo->generateMCValueLow($testingTime);
        echo(implode(", ", $mcValues));
        $mcValuesSum = array_sum($mcValues);
        $mcValuesTotal = (array_sum($mcValues)) / $userStories;
        echo("\n {$testingTimeMC}\n");
        echo("\n {$mcValuesTotal}\n");
        echo("\n {$mcValuesSum}\n");
        return $mcValuesTotal;

    }

    public function getSROIValue()
    {

    }

    public function getAutoManualRatio()
    {

    }

}