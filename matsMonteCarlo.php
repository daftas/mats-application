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
     * @param integer $number
     * @return float|int
     */
    public function generateMCValueLow($number)
    {
        $a = array();
        $i = 0;
        while ($i < 1000){
            $r = round(($number*($this->createRandomFloat(0.8,1.2))),2);
            array_push($a, $r);
            $i++;
        }
        $numberMC = round((array_sum($a)/1000),2);
        return $numberMC;
    }

    /**
     * @param $number
     * @return float|int
     */
    public function generateMCValueMedium($number)
    {
        $a = array();
        $i = 0;
        while ($i < 1000){
            $r = round(($number*($this->createRandomFloat(0.5,1.5))),2);
            array_push($a, $r);
            $i++;
        }
        $numberMC = round((array_sum($a)/1000),2);
        return $numberMC;
    }

    /**
     * @param $number
     * @return float|int
     */
    public function generateMCValueHigh($number)
    {
        $a = array();
        $i = 0;
        while ($i < 1000){
            $r = round(($number*($this->createRandomFloat(0.2,1.8))),2);
            array_push($a, $r);
            $i++;
        }
        $numberMC = round((array_sum($a)/1000),2);
        return $numberMC;
    }

}