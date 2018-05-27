<?php
/**
 * matsScore.php
 * @copyright © 2018 Ramunas Andrijauskas
 */

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
            $pure = round($this->genGaussianNumber($min, $max, $stdDev));
            array_push($a, (int)$pure);
        }

        return $a;
    }

    /**
     * @param array $a
     * @return int
     */
    public function calcProjectEstimate($a)
    {
        $matsComplexity = new matsComplexity();
        $avg = (array_sum($a)/count($a));
        $min = min($a);
        $max = max($a);
        $y = $matsComplexity->calcPertGamma();
        $pert = intval((($min + ($y * $avg) + $max) / ($y + 2)));

        return $pert;
    }

    /**
     * @param array $a
     * @return int
     */
    public function calcProjectProbability($a)
    {
        $min = min($a);
        $max = max($a);
        $pert = $this->calcProjectEstimate($a);

        $a_c = array_count_values($a);
        ksort($a_c);
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

        while ((array_sum($n_c) / matsGeneral::NUMBER_MONTE_CARLO_TRIALS) < 0.7)
        {
            array_push($n_c,current($a_c));
            next($a_c);
        }

        $prob70 = (array_sum($n_c) / matsGeneral::NUMBER_MONTE_CARLO_TRIALS)*100;
        $d70 = key($a_c);

        while ((array_sum($n_c) / matsGeneral::NUMBER_MONTE_CARLO_TRIALS) < 0.8)
        {
            array_push($n_c,current($a_c));
            next($a_c);
        }

        $prob80 = (array_sum($n_c) / matsGeneral::NUMBER_MONTE_CARLO_TRIALS)*100;
        $d80 = key($a_c);

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

        return print "<td>{$min}</td><td>{$max}</td><td>{$pert}</td><td>{$prob} %</td></tr></table><br>
                      <div>There is a {$prob70}% chance project will be completed in {$d70} days</div>
                      <div>There is a {$prob80}% chance project will be completed in {$d80} days</div>
                      <div>There is a {$prob90}% chance project will be completed in {$d90} days</div>
                      <div>There is a {$prob95}% chance project will be completed in {$d95} days</div>
                      <div>There is a {$prob99}% chance project will be completed in {$d99} days</div>";
    }

    public function calcProjectStories($a)
    {
        $matsComplexity = new matsComplexity();
        $e = $matsComplexity->calcTestingEffort();
        $min = min($a) * $e;
        $max = max($a) * $e;
        $stdDev = $this->calcStdDev($max, $min);
        $i = 0;
        $st_a = array();
        $st = $this->getTotalStoryPointsWeight();

        $sp3_a = array();
        $sp3_c = $_GET[matsGeneral::NAME_FIBONACCI_STORY_POINT_3];
        $sp3_n = ($this->getStoryWeight(matsGeneral::NAME_FIBONACCI_STORY_POINT_3) / $st) / $sp3_c;
        $sp3_min = $sp3_n * $min;
        $sp3_max = $sp3_n * $max;
        
        $sp5_a = array();
        $sp5_c = $_GET[matsGeneral::NAME_FIBONACCI_STORY_POINT_5];
        $sp5_n = ($this->getStoryWeight(matsGeneral::NAME_FIBONACCI_STORY_POINT_5) / $st) / $sp5_c;
        $sp5_min = $sp5_n * $min;
        $sp5_max = $sp5_n * $max;

        $sp8_a = array();
        $sp8_c = $_GET[matsGeneral::NAME_FIBONACCI_STORY_POINT_8];
        $sp8_n = ($this->getStoryWeight(matsGeneral::NAME_FIBONACCI_STORY_POINT_8) / $st) / $sp8_c;
        $sp8_min = $sp8_n * $min;
        $sp8_max = $sp8_n * $max;

        $sp13_a = array();
        $sp13_c = $_GET[matsGeneral::NAME_FIBONACCI_STORY_POINT_13];
        $sp13_n = ($this->getStoryWeight(matsGeneral::NAME_FIBONACCI_STORY_POINT_13) / $st) / $sp13_c;
        $sp13_min = $sp13_n * $min;
        $sp13_max = $sp13_n * $max;

        $sp20_a = array();
        $sp20_c = $_GET[matsGeneral::NAME_FIBONACCI_STORY_POINT_20];
        $sp20_n = ($this->getStoryWeight(matsGeneral::NAME_FIBONACCI_STORY_POINT_20) / $st) / $sp20_c;
        $sp20_min = $sp20_n * $min;
        $sp20_max = $sp20_n * $max;

        while ($i++ < 1000)
        {
            $aa = array();
            $ii = 0;
            while ($ii++ < $sp3_c)
            {
                $gauss = $this->genGaussianNumber($sp3_min, $sp3_max, $stdDev);
                array_push($sp3_a, $gauss);
                array_push($aa, $gauss);
            }
            $ii = 0;
            
            while ($ii++ < $sp5_c)
            {
                $gauss = $this->genGaussianNumber($sp5_min, $sp5_max, $stdDev);
                array_push($sp5_a, $gauss);
                array_push($aa, $gauss);
            }
            $ii = 0;
            
            while ($ii++ < $sp8_c)
            {
                $gauss = $this->genGaussianNumber($sp8_min, $sp8_max, $stdDev);
                array_push($sp8_a, $gauss);
                array_push($aa, $gauss);
            }
            $ii = 0;
            
            while ($ii++ < $sp13_c)
            {
                $gauss = $this->genGaussianNumber($sp13_min, $sp13_max, $stdDev);
                array_push($sp13_a, $gauss);
                array_push($aa, $gauss);
            }
            $ii = 0;
            
            while ($ii++ < $sp20_c)
            {
                $gauss = $this->genGaussianNumber($sp20_min, $sp20_max, $stdDev);
                array_push($sp20_a, $gauss);
                array_push($aa, $gauss);
            }
            array_push($st_a,array_sum($aa));
        }

        $sp3_min = min($sp3_a);
        $sp3_max = max($sp3_a);
        $sp3_opt = round((array_sum($sp3_a)/count($sp3_a)),2);
        $sp5_min = min($sp5_a);
        $sp5_max = max($sp5_a);
        $sp5_opt = round((array_sum($sp5_a)/count($sp5_a)),2);
        $sp8_min = min($sp8_a);
        $sp8_max = max($sp8_a);
        $sp8_opt = round((array_sum($sp8_a)/count($sp8_a)),2);
        $sp13_min = min($sp13_a);
        $sp13_max = max($sp13_a);
        $sp13_opt = round((array_sum($sp13_a)/count($sp13_a)),2);
        $sp20_min = min($sp20_a);
        $sp20_max = max($sp20_a);
        $sp20_opt = round((array_sum($sp20_a)/count($sp20_a)),2);
        $st_c = $sp3_c + $sp5_c + $sp8_c + $sp13_c + $sp20_c;
        $st_min = min($st_a);
        $st_max = max($st_a);
        $st_opt = round((array_sum($st_a)/count($st_a)),2);
        print "<tr><td>3</td><td>{$sp3_c}</td><td>{$sp3_min} - {$sp3_max} days</td><td>{$sp3_opt} days</td></tr>
               <tr><td>5</td><td>{$sp5_c}</td><td>{$sp5_min} - {$sp5_max} days</td><td>{$sp5_opt} days</td></tr>
               <tr><td>8</td><td>{$sp8_c}</td><td>{$sp8_min} - {$sp8_max} days</td><td>{$sp8_opt} days</td></tr>
               <tr><td>13</td><td>{$sp13_c}</td><td>{$sp13_min} - {$sp13_max} days</td><td>{$sp13_opt} days</td></tr>
               <tr><td>20</td><td>{$sp20_c}</td><td>{$sp20_min} - {$sp20_max} days</td><td>{$sp20_opt} days</td></tr>
               <tr><b><td>Total</td><td>{$st_c}</td><td>{$st_min} - {$st_max} days</td><td>{$st_opt} days</td></b></tr></table><br>
               <div>Lowest achieved project test time: {$st_min} days</div>           
               <div>Highest achieved project test time: {$st_max} days</div>";

    }
}