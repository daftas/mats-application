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
     * @param $s
     * @return float|int
     */
    public function getStoryWeight($s)
    {
        switch ($s)
        {
            case ($s === self::NAME_FIBANACI_STORY_POINT_1):
                return self::COEFFICIENT_FIBANACI_STORY_POINT_1 * $_GET[$s];
                break;
            case ($s === self::NAME_FIBANACI_STORY_POINT_2):
                return self::COEFFICIENT_FIBANACI_STORY_POINT_2 * $_GET[$s];
                break;
            case ($s === self::NAME_FIBANACI_STORY_POINT_3):
                return self::COEFFICIENT_FIBANACI_STORY_POINT_3 * $_GET[$s];
                break;
            case ($s === self::NAME_FIBANACI_STORY_POINT_5):
                return self::COEFFICIENT_FIBANACI_STORY_POINT_5 * $_GET[$s];
                break;
            case ($s === self::NAME_FIBANACI_STORY_POINT_8):
                return self::COEFFICIENT_FIBANACI_STORY_POINT_8 * $_GET[$s];
                break;
            case ($s === self::NAME_FIBANACI_STORY_POINT_13):
                return self::COEFFICIENT_FIBANACI_STORY_POINT_13 * $_GET[$s];
                break;
            case ($s === self::NAME_FIBANACI_STORY_POINT_21):
                return self::COEFFICIENT_FIBANACI_STORY_POINT_21 * $_GET[$s];
                break;
            case ($s === self::NAME_FIBANACI_STORY_POINT_34):
                return self::COEFFICIENT_FIBANACI_STORY_POINT_34 * $_GET[$s];
                break;
            case ($s === self::NAME_FIBANACI_STORY_POINT_55):
                return self::COEFFICIENT_FIBANACI_STORY_POINT_55 * $_GET[$s];
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
        $storyTotal = $this->getTotalStoryPointsWeight();
        $storyCount = $_GET[$s];
        $storyWeight = $this->getStoryWeight($s);
        $storyNormal = $storyWeight / $storyTotal;
        $singleStoryNormal = $storyNormal / $storyCount;
        $storyTime = $singleStoryNormal * $estimate;
        $storyTestTime= $storyTime * $effort;
       return print "<td>{$storyCount}</td><td>{$storyWeight}</td><td>{$storyNormal}</td><td>{$singleStoryNormal}</td><td>{$storyTime}</td><td>{$storyTestTime}</td>";
        //return $testTime;
    }
}