<?php
/**
 * matsScore.php
 * @copyright © 2018 Ramunas Andrijauskas
 */
require_once("matsComplexity.php");

class matsScore extends matsGeneral

{

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
        $threePointEst = round((($bestCaseEst + 4*$estimate + $worstCaseEst)/6),0);
        return $threePointEst;
    }

    /**
     * @param $s
     * @return float|int
     */
    public function getStoryCoef($s)
    {
        switch ($s)
        {
            case ($s === self::NAME_LOW_COMPLEXITY_STORY):
                return self::COEFFICIENT_LOW_STORY * $_GET[$s];
                break;
            case ($s === self::NAME_MID_COMPLEXITY_STORY):
                return self::COEFFICIENT_MID_STORY * $_GET[$s];
                break;
            case ($s === self::NAME_HIGH_COMPLEXITY_STORY):
                return self::COEFFICIENT_HIGH_STORY * $_GET[$s];
                break;
            default;
                return print ("\n Story not set");
        }
    }
    
    /**
     * @param int $s
     * @return float
     */
    public function calculateStoryTestingTime($s)
    {
        $matsComplexity = new matsComplexity();
//        $estimate = $this->calculateEstimate();
        $estimate = $matsComplexity->runMonteCarlo(1);
        $effort = $matsComplexity->calculateTestingEffort();
        $storyTotal = $this->getTotalStoriesCoef();
        $storyCount = $_GET[$s];
        $storyCoef = $this->getStoryCoef($s);
//        $a = array();
//        $i = 0;

        $storyTotalTime = ($storyCoef * $estimate) / $storyTotal;
        $storyTime = $storyTotalTime / $storyCount;
        $testTime = $storyTime * $effort;
        //echo nl2br("\n") . $matsComplexity->generateMCValue($storyTime);
        //phpinfo();
//
//        while ($i < self::NUMBER_MONTE_CARLO_TRIALS){
//            $storyTestTime =
//                //$matsComplexity->getMonteCarloNumber($storyTime) *
//                $matsComplexity->generateMCValue($storyTime) *
//                $matsComplexity->calculateTestingEffort();
//            $storyMC = $matsComplexity->getMonteCarloNumber($storyTestTime);
//            $storyMC = $matsComplexity->generateMCValue($storyTestTime);
//            array_push($a, $storyMC);
//            $i++;
//        }
//
//        $average = (array_sum($a)/count($a));
//        $min = min($a);
//        $max = max($a);
//        $testTime = round((($min + (4 * $average) + $max)/6),2);
//        $storyd = ($max - $min) / 6;

       return print "<td>{$storyCount}</td><td>{$estimate}</td><td>{$storyCoef}</td><td>{$storyTotalTime}</td><td>{$storyTime}</td><td>{$testTime}</td>";
        //return $testTime;
    }
}