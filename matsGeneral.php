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
        $input = $_GET[$input];
        return $input;
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
     * @return string
     */
    public function getAppStore()
    {
        $a = array();
        $appstore = array("iOS", "Android", "Other");
        foreach ($appstore as $app)
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
        if ($_GET["lifecycle"] = "supportable")
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
    public function getTotalStories()
    {
        return $_GET["story_min"] + $_GET["story_mid"] + $_GET["story_max"];
    }
}