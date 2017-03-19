<?php
//*
function HelloWorld()
{
echo "Hello world!";
}

HelloWorld();

require_once('vendor/autoload.php');
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;

$web_driver = RemoteWebDriver::create(
		"https://1c98081f7cfbf561f183ac0dc159fe20:9c29030030ace3c39d073d320c90fa13@hub.testingbot.com/wd/hub",
		array("platform"=>"LINUX", "browserName"=>"firefox", "version" => "latest")
		);
$web_driver->get("http://google.com");

$element = $web_driver->findElement(WebDriverBy::name("q"));
if($element) {
	$element->sendKeys("TestingBot");
	$element->submit();
}
print $web_driver->getTitle();
$web_driver->quit();
?>
