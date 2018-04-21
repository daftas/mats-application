<?php

/**
 * matsGeneral.php
 * @copyright © 2018 Ramunas Andrijauskas
 */

class matsGeneral
{
    /**
     * @var matsScore
     */
    var $matsScore;

    /**
     * @var matsComplexity
     */
    var $matsComplexity;

    CONST NAME_COMPANY = 'company';
    CONST NAME_INTEGRATION = 'integration';
    CONST NAME_LIFECYCLE = 'lifecycle';

    CONST POINTS_MIN_COMPLEXITY = 3;
    CONST POINTS_MAX_COMPLEXITY = 35;

    CONST PERCENTAGE_BORDER_MIN_TO_MID = 0.38;
    CONST PERCENTAGE_BORDER_MID_TO_MAX = 0.71;

    CONST COEFFICIENT_TESTING_EFFORT_MIN = 0.15;
    CONST COEFFICIENT_TESTING_EFFORT_MID = 0.3;
    CONST COEFFICIENT_TESTING_EFFORT_MAX = 0.4;

    CONST COEFFICIENT_PERT_GAMMA_MIN = 2;
    CONST COEFFICIENT_PERT_GAMMA_MAX = 6;

    CONST WEIGHT_MONTE_CARLO_MIN = 0.2;
    CONST WEIGHT_MONTE_CARLO_MID = 0.5;
    CONST WEIGHT_MONTE_CARLO_MAX = 0.8;

    CONST NAME_LOW_COMPLEXITY_STORY = 'story_low';
    CONST NAME_MID_COMPLEXITY_STORY = 'story_mid';
    CONST NAME_HIGH_COMPLEXITY_STORY = 'story_high';

    CONST NAME_FIBANACI_STORY_POINT_3 = '3sp';
    CONST NAME_FIBANACI_STORY_POINT_5 = '5sp';
    CONST NAME_FIBANACI_STORY_POINT_8 = '8sp';
    CONST NAME_FIBANACI_STORY_POINT_13 = '13sp';
    CONST NAME_FIBANACI_STORY_POINT_20 = '20sp';

    CONST COEFFICIENT_FIBANACI_STORY_POINT_1 = 0.1;
    CONST COEFFICIENT_FIBANACI_STORY_POINT_2 = 0.2;
    CONST COEFFICIENT_FIBANACI_STORY_POINT_3 = 0.03;
    CONST COEFFICIENT_FIBANACI_STORY_POINT_5 = 0.05;
    CONST COEFFICIENT_FIBANACI_STORY_POINT_8 = 0.08;
    CONST COEFFICIENT_FIBANACI_STORY_POINT_13 = 0.13;
    CONST COEFFICIENT_FIBANACI_STORY_POINT_21 = 0.20;
    CONST COEFFICIENT_FIBANACI_STORY_POINT_34 = 3.4;
    CONST COEFFICIENT_FIBANACI_STORY_POINT_55 = 5.5;
    
    CONST NAME_BEST_CASE_TIME = 'est_bc';
    CONST NAME_WORST_CASE_TIME = 'est_wc';

    CONST GAMMA_LOW_UNCERTAINTY = 4;
    CONST GAMMA_MID_UNCERTAINTY = 3;
    CONST GAMMA_HIGH_UNCERTAINTY = 2;

    CONST NUMBER_MONTE_CARLO_TRIALS = 1000;

    /**
     * @param string $input
     * @return mixed
     */
    public function getFromInput($input)
    {
        return $_GET[$input];
    }

    /**
     * @return string
     */
    public function getPattern()
    {
        $pattern = "Platforms for your application: %s;
                    <br>Lifecycle of your project is %s;
                    <br>You have entered %s stories in total;
                    <br>Your most likely time estimation is %s;
                    <br>";
        return $pattern;
    }
    
    /**
     * @return float|int
     */
    public function getTotalStoryPointsWeight()
    {
        return
            self::COEFFICIENT_FIBANACI_STORY_POINT_1 * $_GET[self::NAME_FIBANACI_STORY_POINT_1] +
            self::COEFFICIENT_FIBANACI_STORY_POINT_2 * $_GET[self::NAME_FIBANACI_STORY_POINT_2] +
            self::COEFFICIENT_FIBANACI_STORY_POINT_3 * $_GET[self::NAME_FIBANACI_STORY_POINT_3] +
            self::COEFFICIENT_FIBANACI_STORY_POINT_5 * $_GET[self::NAME_FIBANACI_STORY_POINT_5] +
            self::COEFFICIENT_FIBANACI_STORY_POINT_8 * $_GET[self::NAME_FIBANACI_STORY_POINT_8] +
            self::COEFFICIENT_FIBANACI_STORY_POINT_13 * $_GET[self::NAME_FIBANACI_STORY_POINT_13] +
            self::COEFFICIENT_FIBANACI_STORY_POINT_21 * $_GET[self::NAME_FIBANACI_STORY_POINT_20] +
            self::COEFFICIENT_FIBANACI_STORY_POINT_34 * $_GET[self::NAME_FIBANACI_STORY_POINT_34] +
            self::COEFFICIENT_FIBANACI_STORY_POINT_55 * $_GET[self::NAME_FIBANACI_STORY_POINT_55];
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
            case ($s === self::NAME_FIBANACI_STORY_POINT_1):
                return self::COEFFICIENT_FIBANACI_STORY_POINT_1 * $_GET[$s];
                break;
            case ($s === self::NAME_FIBANACI_STORY_POINT_2):
                return self::COEFFICIENT_FIBANACI_STORY_POINT_2 * $_GET[$s];
                break;
            case ($s === self::NAME_FIBANACI_STORY_POINT_3):
                return self::COEFFICIENT_FIBANACI_STORY_POINT_3 * $_GET[$s];
                break;
            case ($s === self::NAME_FIBANACI_STORY_POINT_5):
                return self::COEFFICIENT_FIBANACI_STORY_POINT_5 * $_GET[$s];
                break;
            case ($s === self::NAME_FIBANACI_STORY_POINT_8):
                return self::COEFFICIENT_FIBANACI_STORY_POINT_8 * $_GET[$s];
                break;
            case ($s === self::NAME_FIBANACI_STORY_POINT_13):
                return self::COEFFICIENT_FIBANACI_STORY_POINT_13 * $_GET[$s];
                break;
            case ($s === self::NAME_FIBANACI_STORY_POINT_20):
                return self::COEFFICIENT_FIBANACI_STORY_POINT_21 * $_GET[$s];
                break;
            case ($s === self::NAME_FIBANACI_STORY_POINT_34):
                return self::COEFFICIENT_FIBANACI_STORY_POINT_34 * $_GET[$s];
                break;
            case ($s === self::NAME_FIBANACI_STORY_POINT_55):
                return self::COEFFICIENT_FIBANACI_STORY_POINT_55 * $_GET[$s];
                break;

            default;
                return print ("\n Story not set");
        }
    }
}