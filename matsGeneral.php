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
        $this->setMatsScore(new matsScore($this));
        $this->setMatsMonteCarlo(new matsMonteCarlo($this));
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
        $pattern = "You have %s people working;
                    <br>Your project have %s working days in total;
                    <br>Your project have %s of project working days dedicated to testing;
                    <br>Your estimated number of user stories in project is %s;
                    <br>Your project is %s in complexity;
                    <br>App Stores for your application: %s.";
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
}