<?php
/**
 * matsScore.php
 * @copyright © 2018 Ramunas Andrijauskas
 */
require_once("matsMonteCarlo.php");

class matsScore extends matsGeneral

{

    /**
     * @return float
     */
    public function calculateTestingEffort()
    {
        $percentage = $this->getComplexityPoints() / $this->getTotalAvailableComplexityPoints();
        switch ($percentage)
        {
            case ($percentage <= 0.38):
                return 0.15;
                break;
            case ($percentage >= 0.71):
                return 0.4;
                break;
            default;
                return 0.3;
        }
    }

    /**
     * Calculates the estimate for the project
     *
     * @return float|int
     */
    public function calculateEstimate()
    {
        $bestCaseEst = $this->getFromInput("est_bc");
        $estimate = $this->getFromInput("est");
        $worstCaseEst = $this->getFromInput("est_wc");
        $threePointEst = ($bestCaseEst + 4*$estimate + $worstCaseEst)/6;
        return $threePointEst;
    }

//    /**
//     *
//     */
//    public function calculateStoryPoints()
//    {
//        $matsMonteCarlo = new matsMonteCarlo();
//        $estimate = $this->calculateEstimate();
//        $storyLow = 0.1 * $_GET["story_low"];
//        $storyMid = 0.2 * $_GET["story_mid"];
//        $storyHigh = 0.5 * $_GET["story_high"];
//        $storyTotal = $storyLow + $storyMid + $storyHigh;
//        echo ($storyTotal);
//
//        $storyLowTime = ($storyLow * $estimate / $storyTotal)/$_GET["story_low"];
//        $storyMidTime = ($storyMid * $estimate / $storyTotal)/$_GET["story_mid"];
//        $storyHighTime = ($storyHigh * $estimate / $storyTotal)/$_GET["story_high"];
//
//        echo nl2br("
//        \n Story Low: {$storyLowTime}
//        \n Story Mid: {$storyMidTime}
//        \n Story High: {$storyHighTime}
//        ");
//        $matsMonteCarlo->generateMCValue($storyMid);
//    }

    /**
     * @param $story
     */
    public function calculateStoryTestingTime($story)
    {
        $matsMonteCarlo = new matsMonteCarlo();
        $estimate = $this->calculateEstimate();
        $storyTotal = $this->getTotalStories();
        $a = array();
        $i = 0;

        $storyTime = ($story * $estimate / $storyTotal) / $story;

        while ($i < 100){
            $storyTestTime =
                $matsMonteCarlo->getMonteCarloNumber($storyTime) *
                $this->calculateTestingEffort();
            $storyMC = $matsMonteCarlo->getMonteCarloNumber($storyTestTime);
            array_push($a, $storyMC);
            $i++;
        }
        $average = (array_sum($a)/count($a));
        $min = min($a);
        $max = max($a);
        $testTime = round((($min + (4 * $average) + $max)/6),2);
        $sd = $max - $min / 6;
//        $testTime = round($average,2);

        echo nl2br("
        \n Story Total: {$storyTotal} 
        \n Story Time: {$storyTime} 
        \n Min value: {$min} 
        \n Average value: {$average}           
        \n Max value: {$max}        
        \n Test Time: {$testTime}
        \n StdDev: {$sd}        
        ");

        return $testTime;
    }
}