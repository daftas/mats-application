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
     * @param integer $number
     * @return float|int
     */
    public function generateMCValue($number)
    {
        $a = array();
        $i = 0;
        $complexity = $this->getComplexity();
        while ($i < 10000){
            $r = round(($number*($this->createRandomFloat((1.01-$complexity),(1.01+$complexity)))),2);
            array_push($a, $r);
            $i++;
        }
        $numberMC = round((array_sum($a)/10000),2);
        return $numberMC;
    }

}