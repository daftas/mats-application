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
    
    public function calculateMonteCarloWeight()
    {
        $value = $this->calculateTestingEffort();
        switch ($value)
        {
            case ($value = 0.15):
                return 0.2;
                break;
            case ($value = 0.4):
                return 0.5;
                break;
            case ($value = 0.3);
                return 0.8;
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
        $threePointEst = (2*$bestCaseEst + 4*$estimate + 2*$worstCaseEst)/6;
        return $threePointEst;
    }

    /**
     *
     */
    public function calculateStoryPoints()
    {
        $matsMonteCarlo = new matsMonteCarlo();
        $estimate = $this->calculateEstimate();
        $storyLow = 0.1 * $_GET["story_low"];
        $storyMid = 0.2 * $_GET["story_mid"];
        $storyHigh = 0.5 * $_GET["story_high"];
        $storyTotal = $storyLow + $storyMid + $storyHigh;
        echo ($storyTotal);

        $storyLowTime = ($storyLow * $estimate / $storyTotal)/$_GET["story_low"];
        $storyMidTime = ($storyMid * $estimate / $storyTotal)/$_GET["story_mid"];
        $storyHighTime = ($storyHigh * $estimate / $storyTotal)/$_GET["story_high"];


        echo nl2br("
        \n Story Low: {$storyLowTime} 
        \n Story Mid: {$storyMidTime} 
        \n Story High: {$storyHighTime}
        ");
        $matsMonteCarlo->generateMCValue($storyMid);
    }
}