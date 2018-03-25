<?php

/**
 * matsComplexity.php
 * @copyright © 2018 Ramunas Andrijauskas
 */

class matsComplexity extends matsGeneral
{

    /**
     * @param array $name
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
     * @return int
     */
    public function getAppStorePoints()
    {
        $app = array(
            'ios',
            'android',
            'other'
        );

        return $this->getCheckboxPoints($app);
    }

    /**
     * @return int
     */
    public function getFeaturePoints()
    {
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
            'other'
        );

        return $this->getCheckboxPoints($features);
    }

    /**
     * @return int
     */
    public function getTotalAvailableComplexityPoints()
    {
        return self::POINTS_MAX_COMPLEXITY - self::POINTS_MIN_COMPLEXITY;
    }

    /**
     * @return int
     */
    public function getCompanyPoints()
    {
        return $_GET[self::NAME_COMPANY];
    }

    /**
     * @return int
     */
    public function getIntegrationPoints()
    {
        return $_GET[self::NAME_INTEGRATION];
    }

    /**
     * @return int
     */
    public function getLifecyclePoints()
    {
        return $_GET[self::NAME_LIFECYCLE];
    }

    public function getComplexityPoints()
    {
        $app = array(
            'ios',
            'android',
            'other'
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
            'other'
        );
        return
            $this->getCheckboxPoints($app) +
            $this->getCheckboxPoints($features) +
            $_GET[self::NAME_COMPANY] +
            $_GET[self::NAME_INTEGRATION] +
            $_GET[self::NAME_LIFECYCLE];
    }

    /**
     * @param integer $min
     * @param integer $max
     * @return mixed
     */
    private function createRandomFloat($min, $max)
    {
        return ($min + lcg_value() * (abs($max - $min)));
    }

    /**
     * @return float
     */
    public function calculateTestingEffort()
    {

        $percentage = $this->getComplexityPoints() / $this->getTotalAvailableComplexityPoints();
        switch ($percentage)
        {
            case ($percentage <= self::PERCENTAGE_BORDER_MIN_TO_MID):
                return self::COEFFICIENT_TESTING_EFFORT_MIN;
                break;
            case ($percentage > self::PERCENTAGE_BORDER_MIN_TO_MID && $percentage < self::PERCENTAGE_BORDER_MID_TO_MAX):
                return self::COEFFICIENT_TESTING_EFFORT_MID;
                break;
            case ($percentage >= self::PERCENTAGE_BORDER_MID_TO_MAX):
                return self::COEFFICIENT_TESTING_EFFORT_MAX;
                break;
            default;
                return print ("\n Unable to calculate, complexity points not set");
        }
    }

    /**
     * @return float
     */
    public function calculateMonteCarloWeight()
    {
        $value = $this->calculateTestingEffort();
        switch ($value)
        {
            case ($value === self::COEFFICIENT_TESTING_EFFORT_MIN):
                return self::WEIGHT_MONTE_CARLO_MIN;
                break;
            case ($value === self::COEFFICIENT_TESTING_EFFORT_MID):
                return self::WEIGHT_MONTE_CARLO_MID;
                break;
            case ($value === self::COEFFICIENT_TESTING_EFFORT_MAX):
                return self::WEIGHT_MONTE_CARLO_MAX;
                break;
            default;
                return print ("\n Unable to calculate, complexity points not set");
        }
    }

    public function getMonteCarloNumber($number)
    {
        $mcWeight = $this->calculateMonteCarloWeight();
        return ($number*($this->createRandomFloat((1-$mcWeight),(1+$mcWeight))));
    }

    /**
     * @param integer $number
     * @return float|int
     */
    public function generateMCValue($number)
    {
        $mcWeight = ($_GET[self::NAME_WORST_CASE_TIME] - $_GET[self::NAME_BEST_CASE_TIME]) / (6 * $_GET[self::NAME_ESTIMATED_TIME]);
        return ($number*($this->createRandomFloat((1-$mcWeight),(1+$mcWeight))));
    }

}