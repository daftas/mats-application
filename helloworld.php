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

require_once('PHPUnit/Extensions/AppiumTestCase.php');
require_once('PHPUnit/Extensions/AppiumTestCase/Element.php');


require_once "vendor/autoload.php";

define("APP_PATH", realpath(dirname(__FILE__).'/../../apps/TestApp/build/release-iphonesimulator/TestApp.app'));
if (!APP_PATH) {
	die("App did not exist!");

	class SimpleTest extends Sauce\Sausage\WebDriverTestCase
	{
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
						)
				)
		);
		public function elemsByTag($tag)
		{
			return $this->elements($this->using('class name')->value($tag));
		}
		protected function populate()
		{
			$elems = $this->elemsByTag('UIATextField');
			foreach ($elems as $elem) {
				$randNum = rand(0, 10);
				$elem->value($randNum);
				$this->numValues[] = $randNum;
			}
		}
		public function testUiComputation()
		{
			$this->populate();
			$buttons = $this->elemsByTag('UIAButton');
			$buttons[0]->click();
			$texts = $this->elemsByTag('UIAStaticText');
			$this->assertEquals(array_sum($this->numValues), (int)($texts[0]->text()));
		}
}