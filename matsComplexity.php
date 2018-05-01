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
     * @return float|int
     */
    private function getAppStorePoints()
    {
        $app = array(
            'ios',
            'android',
            'os_other'
        );
        return $this->getCheckboxPoints($app);
    }

    /**
     * @return float|int
     */
    private function getFeaturePoints()
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
            'feature_other'
        );
        return $this->getCheckboxPoints($features);
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
        return
            $this->getAppStorePoints() +
            $this->getFeaturePoints() +
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

    /**
     * @return int
     */
    public function getTestingMethods()
    {
        $a = array();

        if ( $this->getTotalStoryPointsCount() > 20)
        {
            array_push($a, 'Test management tool');
        }

        if ($_GET[matsGeneral::NAME_LIFECYCLE] === 5)
        {
            array_push($a, 'Test automation');
            array_push ($a, 'Production monitoring tool');
        }

        if (isset($_GET['data']) ||
            isset($_GET['animation']) ||
            isset($_GET['storage']) ||
            isset($_GET['sync']))
        {
            array_push($a, 'Performance testing');
        }

        if ($_GET[matsGeneral::NAME_INTEGRATION] === 5 || isset($_GET['media']) || isset($_GET['payment']))
        {
            array_push($a, 'Integration testing');
        }

        if ($this->getFeaturePoints() > 6)
        {
            array_push($a, 'Unit testing');
        }

        if ($this->getAppStorePoints() === 6)
        {
            array_push($a, 'Testing with multiple mobile devices');
        }

        if (isset($_GET['geolocation']))
        {
            array_push ($a, 'Location and usability testing');
        }

        return print (implode(";<br>", $a));
    }
}