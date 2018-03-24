<?php

/**
 * matsMonteCarlo.php
 * @copyright © 2018 Ramunas Andrijauskas
 */

class matsMonteCarlo extends matsGeneral
{

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
     * @return float|int
     */
    public function getComplexity()
    {
        $lc = $this->getLifecyclePoints();
        $platform = $this->getAppStorePoints();
        $complexity = ($lc + $platform) / 10;
        return $complexity;
    }


    /**
     * @return float
     */
    public function calculateMonteCarloWeight()
    {
        $matsScore = new MatsScore;
        $value = $matsScore->calculateTestingEffort();
        switch ($value)
        {
            case ($value = 0.15):
                return 0.2;
                break;
            case ($value = 0.4):
                return 0.5;
                break;
            default;
                return 0.8;
        }
    }

    public function getMonteCarloNumber($number)
    {
        $mcWeight = $this->calculateMonteCarloWeight();
        return round(($number*($this->createRandomFloat((1-$mcWeight),(1+$mcWeight)))),2);
    }

    /**
     * @param integer $number
     * @return float|int
     */
    public function generateMCValue($number)
    {
        $a = array();
        $i = 0;
        $mcWeight = $this->calculateMonteCarloWeight();

        while ($i < 1000){
            $r = round(($number*($this->createRandomFloat((1-$mcWeight),(1+$mcWeight)))),2);
            array_push($a, $r);
            $i++;
        }
        $numberMC = round((array_sum($a)/1000),2);
        return $numberMC;
    }

}