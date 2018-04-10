<?php
/**
 * matsScore.php
 * @copyright © 2018 Ramunas Andrijauskas
 */
require_once("matsComplexity.php");

class matsScore extends matsGeneral

{

    /**
     * Calculates weight for each story point
     * Formula: StoryPoint * Coefficient
     *
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