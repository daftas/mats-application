<?php

/**
 * matsGeneral.php
 * @copyright © 2018 Ramunas Andrijauskas
 */

class matsGeneral
{

    CONST POINTS_MIN_COMPLEXITY = 3;
    CONST POINTS_MAX_COMPLEXITY = 35;

    CONST COEFFICIENT_TESTING_EFFORT_MIN = 0.2;
    CONST COEFFICIENT_TESTING_EFFORT_MAX = 0.4;

    CONST COEFFICIENT_PERT_GAMMA_MIN = 2;
    CONST COEFFICIENT_PERT_GAMMA_MAX = 6;

    CONST COEFFICIENT_FIBONACCI_STORY_POINT_3 = 0.03;
    CONST COEFFICIENT_FIBONACCI_STORY_POINT_5 = 0.05;
    CONST COEFFICIENT_FIBONACCI_STORY_POINT_8 = 0.08;
    CONST COEFFICIENT_FIBONACCI_STORY_POINT_13 = 0.13;
    CONST COEFFICIENT_FIBONACCI_STORY_POINT_20 = 0.20;

    CONST NUMBER_MONTE_CARLO_TRIALS = 5000;

    CONST NAME_FIBONACCI_STORY_POINT_3 = '3sp';
    CONST NAME_FIBONACCI_STORY_POINT_5 = '5sp';
    CONST NAME_FIBONACCI_STORY_POINT_8 = '8sp';
    CONST NAME_FIBONACCI_STORY_POINT_13 = '13sp';
    CONST NAME_FIBONACCI_STORY_POINT_20 = '20sp';
    CONST NAME_COMPANY = 'company';
    CONST NAME_INTEGRATION = 'integration';
    CONST NAME_LIFECYCLE = 'lifecycle';
    CONST NAME_BEST_CASE_TIME = 'est_bc';
    CONST NAME_WORST_CASE_TIME = 'est_wc';

    
    /**
     * @return float|int
     */
    public function getTotalStoryPointsWeight()
    {
        return
            self::COEFFICIENT_FIBONACCI_STORY_POINT_3 * $_GET[self::NAME_FIBONACCI_STORY_POINT_3] +
            self::COEFFICIENT_FIBONACCI_STORY_POINT_5 * $_GET[self::NAME_FIBONACCI_STORY_POINT_5] +
            self::COEFFICIENT_FIBONACCI_STORY_POINT_8 * $_GET[self::NAME_FIBONACCI_STORY_POINT_8] +
            self::COEFFICIENT_FIBONACCI_STORY_POINT_13 * $_GET[self::NAME_FIBONACCI_STORY_POINT_13] +
            self::COEFFICIENT_FIBONACCI_STORY_POINT_20 * $_GET[self::NAME_FIBONACCI_STORY_POINT_20];
    }

    /**
     * Calculates weight for each story point
     * Formula: StoryPoint * Coefficient
     *
     * @param $s
     * @return float|int
     */
    public function getStoryWeight($s)
    {
        switch ($s)
        {
            case ($s === self::NAME_FIBONACCI_STORY_POINT_3):
                return self::COEFFICIENT_FIBONACCI_STORY_POINT_3 * $_GET[$s];
                break;
            case ($s === self::NAME_FIBONACCI_STORY_POINT_5):
                return self::COEFFICIENT_FIBONACCI_STORY_POINT_5 * $_GET[$s];
                break;
            case ($s === self::NAME_FIBONACCI_STORY_POINT_8):
                return self::COEFFICIENT_FIBONACCI_STORY_POINT_8 * $_GET[$s];
                break;
            case ($s === self::NAME_FIBONACCI_STORY_POINT_13):
                return self::COEFFICIENT_FIBONACCI_STORY_POINT_13 * $_GET[$s];
                break;
            case ($s === self::NAME_FIBONACCI_STORY_POINT_20):
                return self::COEFFICIENT_FIBONACCI_STORY_POINT_20 * $_GET[$s];
                break;

            default;
                return print ("\n Story not set");
        }
    }

    public function getTotalStoryPointsCount()
    {
        return
            $_GET[matsGeneral::NAME_FIBONACCI_STORY_POINT_3] +
            $_GET[matsGeneral::NAME_FIBONACCI_STORY_POINT_5] +
            $_GET[matsGeneral::NAME_FIBONACCI_STORY_POINT_8] +
            $_GET[matsGeneral::NAME_FIBONACCI_STORY_POINT_13] +
            $_GET[matsGeneral::NAME_FIBONACCI_STORY_POINT_20];
    }
}