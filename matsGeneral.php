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
     * @var matsMonteCarlo
     */
    var $matsMonteCarlo;

    CONST NAME_COMPANY = 'company';
    CONST NAME_INTEGRATION = 'integration';
    CONST NAME_LIFECYCLE = 'lifecycle';

    CONST VALUE_MIN_COMPLEXITY = 3;
    CONST VALUE_MAX_COMPLEXITY = 35;

    CONST NAME_LOW_COMPLEXITY_STORY = 'story_low';
    CONST NAME_MID_COMPLEXITY_STORY = 'story_mid';
    CONST NAME_HIGH_COMPLEXITY_STORY = 'story_high';

    CONST NAME_BEST_CASE_TIME = 'est_bc';
    CONST NAME_ESTIMATED_TIME = 'est';
    CONST NAME_WORST_CASE_TIME = 'est_wc';
    
    public function setUp()
    {
        $this->setMatsScore(new matsScore);
        $this->setMatsMonteCarlo(new matsMonteCarlo);
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
     * @return matsMonteCarlo
     */
    public function getMatsMonteCarlo()
    {
        return $this->matsMonteCarlo;
    }

    /**
     * @param $matsMonteCarlo
     * @return mixed
     */
    public function setMatsMonteCarlo($matsMonteCarlo)
    {
        return $this->matsMonteCarlo = $matsMonteCarlo;
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
        $pattern = "Platforms for your application: %s.;
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
        return self::VALUE_MAX_COMPLEXITY - self::VALUE_MIN_COMPLEXITY;
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
}