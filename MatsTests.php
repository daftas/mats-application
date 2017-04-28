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

class MatsTests
{
    public function MatsTests extends PHPUnit_Framework_Assert
	{

        );
		public function elemsByTag($tag)
        {
            return $this->elements($this->using('class name')->value($tag));
        }
		public function populate()
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
        ?>

