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
    public function calculatePertGamma()
    {
        $value = $this->calculateTestingEffort();
        switch ($value)
        {
            case ($value === self::COEFFICIENT_TESTING_EFFORT_MIN):
                return self::GAMMA_LOW_UNCERTAINTY;
                break;
            case ($value === self::COEFFICIENT_TESTING_EFFORT_MID):
                return self::GAMMA_MID_UNCERTAINTY;
                break;
            case ($value === self::COEFFICIENT_TESTING_EFFORT_MAX):
                return self::GAMMA_HIGH_UNCERTAINTY;
                break;
            default;
                return print ("\n Unable to calculate, complexity points not set");
        }
    }

    public function getMonteCarloNumber($number)
    {
        $mcWeight = $this->calculatePertGamma();
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

    /**
     * @return float|int
     */
    public function runMonteCarlo($est = 0)
    {
        $min = $_GET[self::NAME_BEST_CASE_TIME];
        $max = $_GET[self::NAME_WORST_CASE_TIME];
        $y = $this->calculatePertGamma();

        $stdDev = ($max - $min) / ($y + 2);
        $a = array();
        $i = 0;


        while ($i++ < self::NUMBER_MONTE_CARLO_TRIALS) {
            $pure = $this->generateGaussianNumber($min, $max, $stdDev);
            array_push($a, $pure);
        }

        $averageB = (array_sum($a)/count($a));
        $minB = min($a);
        $maxB = max($a);
        $optimalB = round((($minB + ($y * $averageB) + $maxB) / ($y + 2)),2);
        $stdevB = ($maxB - $minB) / ($y + 2);
        if ($est === 1)
        {
            return $optimalB;
        } else {
            return print "<td>{$min}</td><td>{$max}</td><td>{$stdDev}</td><td>{$averageB}</td><td>{$minB}</td><td>{$maxB}</td><td>{$optimalB}</td><td>{$stdevB}</td>";
        }
    }

    /**
     * @param $min
     * @param $max
     * @param $stdDev
     * @return float|int
     */
    private function generateGaussianNumber($min, $max, $stdDev)
    {
        $rand1 = (float)mt_rand()/(float)mt_getrandmax();
        $rand2 = (float)mt_rand()/(float)mt_getrandmax();
        $gaussianNumber = sqrt(-2 * log($rand1)) * cos(2 * M_PI * $rand2);
        $mean = ($max + $min) / 2;
        $randomNumber = round((($gaussianNumber * $stdDev) + $mean),2);
        if($randomNumber < $min || $randomNumber > $max) {
            $randomNumber = $this->generateGaussianNumber($min, $max,$stdDev);
        }
        return $randomNumber;
    }

}