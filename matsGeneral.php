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

    CONST WEIGHT_MONTE_CARLO_MIN = 0.2;
    CONST WEIGHT_MONTE_CARLO_MID = 0.5;
    CONST WEIGHT_MONTE_CARLO_MAX = 0.8;

    CONST NAME_LOW_COMPLEXITY_STORY = 'story_low';
    CONST NAME_MID_COMPLEXITY_STORY = 'story_mid';
    CONST NAME_HIGH_COMPLEXITY_STORY = 'story_high';

    CONST NAME_FIBANACI_STORY_POINT_1 = '1sp';
    CONST NAME_FIBANACI_STORY_POINT_2 = '2sp';
    CONST NAME_FIBANACI_STORY_POINT_3 = '3sp';
    CONST NAME_FIBANACI_STORY_POINT_5 = '5sp';
    CONST NAME_FIBANACI_STORY_POINT_8 = '8sp';
    CONST NAME_FIBANACI_STORY_POINT_13 = '13sp';
    CONST NAME_FIBANACI_STORY_POINT_21 = '21sp';
    CONST NAME_FIBANACI_STORY_POINT_34 = '34sp';
    CONST NAME_FIBANACI_STORY_POINT_55 = '55sp';

    CONST COEFFICIENT_FIBANACI_STORY_POINT_1 = 0.1;
    CONST COEFFICIENT_FIBANACI_STORY_POINT_2 = 0.2;
    CONST COEFFICIENT_FIBANACI_STORY_POINT_3 = 0.3;
    CONST COEFFICIENT_FIBANACI_STORY_POINT_5 = 0.5;
    CONST COEFFICIENT_FIBANACI_STORY_POINT_8 = 0.8;
    CONST COEFFICIENT_FIBANACI_STORY_POINT_13 = 1.3;
    CONST COEFFICIENT_FIBANACI_STORY_POINT_21 = 2.1;
    CONST COEFFICIENT_FIBANACI_STORY_POINT_34 = 3.4;
    CONST COEFFICIENT_FIBANACI_STORY_POINT_55 = 5.5;
    
    CONST NAME_BEST_CASE_TIME = 'est_bc';
    CONST NAME_WORST_CASE_TIME = 'est_wc';

    CONST GAMMA_LOW_UNCERTAINTY = 4;
    CONST GAMMA_MID_UNCERTAINTY = 3;
    CONST GAMMA_HIGH_UNCERTAINTY = 2;

    CONST NUMBER_MONTE_CARLO_TRIALS = 10;
    
    public function setUp()
    {
        $this->setMatsScore(new matsScore);
        $this->setMatsComplexity(new matsComplexity);
    }
    
    /**
     * @return matsScore
     */
    public function getMatsScore()
    {
        return $this->matsScore;
    }

    /**
     * @param $matsScore
     * @return mixed
     */
    public function setMatsScore($matsScore)
    {
        return $this->matsScore = $matsScore;
    }

    /**
     * @return matsComplexity
     */
    public function getMatsComplexity()
    {
        return $this->matsComplexity;
    }

    /**
     * @param $matsComplexity
     * @return mixed
     */
    public function setMatsComplexity($matsComplexity)
    {
        return $this->matsComplexity = $matsComplexity;
    }

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
     * @return int
     */
    public function getTotalStories()
    {
        return $_GET["story_low"] + $_GET["story_mid"] + $_GET["story_high"];
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
            self::COEFFICIENT_FIBANACI_STORY_POINT_21 * $_GET[self::NAME_FIBANACI_STORY_POINT_21] +
            self::COEFFICIENT_FIBANACI_STORY_POINT_34 * $_GET[self::NAME_FIBANACI_STORY_POINT_34] +
            self::COEFFICIENT_FIBANACI_STORY_POINT_55 * $_GET[self::NAME_FIBANACI_STORY_POINT_55];
    }

    /**
     * @return string
     */
    public function getAppStore()
    {
        $a = array();
        $app_store = array(
            'ios',
            'android',
            'other'
        );
        foreach ($app_store as $app)
        {
            if (isset($_GET[$app]))
            {
                array_push($a, $app);
            }
        }
        $appStore = implode(", ", $a);
        return $appStore;
    }

    /**
     * @return string
     */
    public function getLifecycle()
    {
        if ($_GET["lifecycle"] === 5)
        {
            return "Supportable";
        }
        else
        {
            return "Non-supportable";
        }
    }
}