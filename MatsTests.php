<?php
/**
Copyright 2017 Ramunas Andrijauskas

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
 */


require_once('vendor/appium/php-client/PHPUnit/Extensions/AppiumTestCase.php');
require_once('vendor/appium/php-client/PHPUnit/Extensions/AppiumTestCase/Element.php');

class MatsTests extends PHPUnit_Extensions_AppiumTestCase
{
    public static $browsers = array(
        array(
            'local' => true,
            'port' => 4723,
            'browserName' => '',
            'desiredCapabilities' => array(
                'app' => APP_PATH
                'browsername' => 'Chrome',
                'deviceName' => 'android-emulator',
                'platformVersion' => '4.4',
                'platformName' => 'Android'
            )
        )
    );

    public function helloTest()
    {
        $element = $this->byAccessibilityId('Element on screen');

        $this->assertInstanceOf('PHPUnit_Extensions_AppiumTestCase_Element', $element);
    }
}