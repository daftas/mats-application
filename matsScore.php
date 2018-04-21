<?php
/**
 * matsScore.php
 * @copyright © 2018 Ramunas Andrijauskas
 */
require_once("matsComplexity.php");

class matsScore extends matsGeneral

{

    /**
     * @param $min
     * @param $max
     * @param $stdDev
     * @return float|int
     */
    private function genGaussianNumber($min, $max, $stdDev)
    {
        $rand1 = (float)mt_rand()/(float)mt_getrandmax();
        $rand2 = (float)mt_rand()/(float)mt_getrandmax();
        $gaussianNumber = sqrt(-2 * log($rand1)) * cos(2 * M_PI * $rand2);
        $mean = ($max + $min) / 2;
        $randomNumber = round((($gaussianNumber * $stdDev) + $mean),2);
        if($randomNumber < $min || $randomNumber > $max) {
            $randomNumber = $this->genGaussianNumber($min, $max,$stdDev);
        }
        return $randomNumber;
    }

    /**
     * @param float|int $max
     * @param float|int $min
     * @return float|int
     */
    private function calcStdDev($max, $min)
    {
        $matsComplexity = new matsComplexity();
        $y = $matsComplexity->calcPertGamma();
        $stdDev = ($max - $min) / ($y + 2);
        return $stdDev;
    }

    /**
     * @return array
     */
    public function runMonteCarloProject()
    {
        $min = $_GET[self::NAME_BEST_CASE_TIME];
        $max = $_GET[self::NAME_WORST_CASE_TIME];
        $stdDev = $this->calcStdDev($min, $max);
        $a = array();
        $i = 0;

        while ($i++ < matsGeneral::NUMBER_MONTE_CARLO_TRIALS) {
            $pure = $this->genGaussianNumber($min, $max, $stdDev);
            array_push($a, intval($pure));
        }

        return $a;
    }

    private function runMonteCarloStories($a)
    {
        $min = min($a);
        $max = max($a);
        $stdDev = $this->calcStdDev($min, $max);
        $a = array();
        $i = 0;

        while ($i++ < matsGeneral::NUMBER_MONTE_CARLO_TRIALS) {

        }

        return $a;
    }

    /**
     * @param int $est
     * @return float|int
     */
    public function runMonteCarlo($est = 0, $mc = self::NUMBER_MONTE_CARLO_TRIALS)
    {
        $matsComplexity = new matsComplexity();
        $min = $_GET[self::NAME_BEST_CASE_TIME];
        $max = $_GET[self::NAME_WORST_CASE_TIME];
        $y = $matsComplexity->calcPertGamma();
        $stdDev = ($max - $min) / ($y + 2);
        $a = array();
        $i = 0;

        while ($i++ < $mc) {
            $pure = $this->genGaussianNumber($min, $max, $stdDev);
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

    public function calcProjectEstimate($a)
    {
        $matsComplexity = new matsComplexity();
        $avg = (array_sum($a)/count($a));
        $min = min($a);
        $max = max($a);
        $y = $matsComplexity->calcPertGamma();
        $pert = intval((($min + ($y * $avg) + $max) / ($y + 2)));
        $stdDev = ($max - $min) / ($y + 2);

        $a_c = array_count_values($a);
        ksort($a_c);
        print_r ($a_c);
        $n_c = array();
        $n = $min;
        while ($n <= $pert)
        {
            if (array_key_exists($n,$a_c))
            {
                array_push($n_c,current($a_c));
                next($a_c);
                $n++;
            }
            else
            {
                $n++;
            }
        }

        $prob = (array_sum($n_c) / matsGeneral::NUMBER_MONTE_CARLO_TRIALS)*100;

        while ((array_sum($n_c) / matsGeneral::NUMBER_MONTE_CARLO_TRIALS) < 0.9)
        {
            array_push($n_c,current($a_c));
            next($a_c);
        }

        $prob90 = (array_sum($n_c) / matsGeneral::NUMBER_MONTE_CARLO_TRIALS)*100;
        $d90 = key($a_c);

        while ((array_sum($n_c) / matsGeneral::NUMBER_MONTE_CARLO_TRIALS) < 0.95)
        {
            array_push($n_c,current($a_c));
            next($a_c);
        }
        $prob95 = (array_sum($n_c) / matsGeneral::NUMBER_MONTE_CARLO_TRIALS)*100;
        $d95 = key($a_c);

        while ((array_sum($n_c) / matsGeneral::NUMBER_MONTE_CARLO_TRIALS) < 0.99)
        {
            array_push($n_c,current($a_c));
            next($a_c);
        }

        $prob99 = (array_sum($n_c) / matsGeneral::NUMBER_MONTE_CARLO_TRIALS)*100;
        $d99 = key($a_c);;



        return print "<td>{$min}</td><td>{$max}</td><td>{$stdDev}</td><td>{$pert}</td></tr>
                      <div>Probability to complete on date: {$prob} %</div>
                      <div>There is a {$prob90}% chance project will be completed on {$d90} days</div>
                      <div>There is {$prob95}% chance project will be completed on {$d95} days</div>
                      <div>There is {$prob99}% chance project will be completed on {$d99} days</div>";
    }

    public function calcProjectProbability($a)
    {
    }

    /**
     * @param int $s
     * @return float
     */
    public function calculateStoryTestingTime($s)
    {
        $matsComplexity = new matsComplexity();
//        $estimate = $this->calculateEstimate();
        $estimate = $matsComplexity->runMonteCarlo(1,1);
        $effort = $matsComplexity->calcTestingEffort();
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