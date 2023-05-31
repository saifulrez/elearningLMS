<?php
    require_once('vendor/autoload.php');
    use Facebook\WebDriver\Remote\RemoteWebDriver;
    use Facebook\WebDriver\WebDriverBy;
    function executeTestCase($caps) {
        $web_driver = RemoteWebDriver::create(
            "https://shubhamkumar_kAguV5:stnQvuU9rnjpxgsUeYEp@hub-cloud.browserstack.com/wd/hub",
            $caps
        );
        # Searching for 'BrowserStack' on google.com
        $web_driver->get("http://google.com");
        $element = $web_driver->findElement(WebDriverBy::name("q"));
        if($element) {
            $element->sendKeys("BrowserStack");
            $element->submit();
        }
        print $web_driver->getTitle();
        # Setting the status of test as 'passed' or 'failed' based on the condition; if title of the web page starts with 'BrowserStack'
        if (substr($web_driver->getTitle(),0,12) == "BrowserStack"){
            $web_driver->executeScript('browserstack_executor: {"action": "setSessionStatus", "arguments": {"status":"passed", "reason": "Yaay! Title matched!"}}' );
        }  else {
            $web_driver->executeScript('browserstack_executor: {"action": "setSessionStatus", "arguments": {"status":"failed", "reason": "Oops! Title did not match!"}}');
        }
        $web_driver->quit();
    }
    $caps = array(
        array(
            "os" => "Windows",
            "os_version" => "10",
            "browser" => "chrome",
            "browser_version" => "latest",
            "build" => "browserstack-build-1",
            "name" => "Parallel test 1"
        ),
    );
    foreach ( $caps as $cap ) {
        executeTestCase($cap);
    }
?>