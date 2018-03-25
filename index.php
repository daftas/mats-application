<?php

require 'vendor/autoload.php';

    protected $numValues = array();
    public static $browsers = array(
    array(
        'local' => true,
        'port' => 4723,
        'browserName' => '',
        'desiredCapabilities' => array(
            'deviceName' => 'android-emu',
            'version' => '7.1.1',
            'platformName' => 'Android 7.1.1',
            'app' => APP_PATH
        );
    );
