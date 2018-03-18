<?php
/**
 * matsScore.php
 * @copyright © 2018 Ramunas Andrijauskas
 */
require_once("matsMonteCarlo.php");

class matsScore extends matsGeneral

{

    /**
     * @param integer $pe
     * @param integer $pr
     * @param integer $te
     * @return float
     */
    public function getTestingInvestment($pe, $pr, $te)
    {
        $matsMonteCarlo = new matsMonteCarlo();
        $pe = $matsMonteCarlo->generateMCValueMedium($pe);
        $pr = $matsMonteCarlo->generateMCValueMedium($pr);
        $te = $matsMonteCarlo->generateMCValueMedium($te);
        $result = round(((($pe*$te)/($pe*$pr))*100));
        return $result;
    }

    /**
     * @param integer $testingTime
     * @param integer $userStories
     * @return float|int
     */
    public function getDays($testingTime, $userStories)
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
        $mcValuesTotal = (array_sum($mcValues)) / $userStories;
        return $mcValuesTotal;
    }

    public function getSROIValue()
    {

    }

    public function getAutoManualRatio()
    {

    }

}