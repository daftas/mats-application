<?php

/**
 * matsComplexity.php
 * @copyright © 2018 Ramunas Andrijauskas
 */

class matsComplexity extends matsGeneral
{

    /**
     * Helper method to get single point
     *
     * @param $name
     * @return float|int
     */
    private function getCheckboxPoints($name)
    {
        $a = array();
        foreach ($name as $f)
        {
            if (isset($_GET[$f]))
            {
                array_push($a, $_GET[$f]);
            }
        }
        return array_sum($a);
    }

    /**
     * Method to get maximum available Complexity Points
     *
     * @return int
     */
    public function getTotalAvailableComplexityPoints()
    {
        return self::POINTS_MAX_COMPLEXITY - self::POINTS_MIN_COMPLEXITY;
    }

    /**
     * Method to get complexity points according to inputs
     *
     * @return float|int
     */
    public function getComplexityPoints()
    {
        $app = array(
            'ios',
            'android',
            'os_other'
        );
        $features = array(
            'image',
            'geolocation',
            'notificiations',
            'media',
            'data',
            'signature',
            'authorization',
            'payment',
            'messaging',
            'animation',
            'form',
            'storage',
            'sync',
            'feature_other'
        );
        return
            $this->getCheckboxPoints($app) +
            $this->getCheckboxPoints($features) +
            $_GET[self::NAME_COMPANY] +
            $_GET[self::NAME_INTEGRATION] +
            $_GET[self::NAME_LIFECYCLE];
    }

    /**
     * Calcuates complexity percentage (k)
     *
     * @return float|int
     */
    private function calcComplexityPercentage()
    {
        return $this->getComplexityPoints() / $this->getTotalAvailableComplexityPoints();
    }

    /**
     * Method to calculate testing effort according to complexity
     * Calculates testing effort (e)
     *
     * @return float
     */
    public function calcTestingEffort()
    {
        $scored = $this->calcComplexityPercentage();
        $diff = matsGeneral::COEFFICIENT_TESTING_EFFORT_MAX - matsGeneral::COEFFICIENT_TESTING_EFFORT_MIN;
        return ($scored * $diff) + matsGeneral::COEFFICIENT_TESTING_EFFORT_MIN;
    }

    /**
     * Method to calculate testing effort according to complexity
     * Calculates gamma (y)
     *
     * @return float
     */
    public function calcPertGamma()
    {
        $scored = $this->calcComplexityPercentage();
        $diff = matsGeneral::COEFFICIENT_PERT_GAMMA_MAX - matsGeneral::COEFFICIENT_PERT_GAMMA_MIN;
        return ((1-$scored) * $diff) + matsGeneral::COEFFICIENT_PERT_GAMMA_MIN;
    }

}