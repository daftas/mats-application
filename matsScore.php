<?php
/**
 * matsScore.php
 * @copyright © 2018 Ramunas Andrijauskas
 */
require_once("matsMonteCarlo.php");

class matsScore extends matsGeneral

{

    public function calculateComplexity()
    {
        $matsMonteCarlo = new matsMonteCarlo();
        return $matsMonteCarlo->getComplexity();
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
        $story = $_GET["story_mid"];
        return $matsMonteCarlo->generateMCValue($story);
    }
}