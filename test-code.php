$caps = array(
  $username = getenv("BROWSERSTACK_USERNAME");
  $accessKey = getenv("BROWSERSTACK_ACCESS_KEY");
);
$web_driver = RemoteWebDriver::create(
  "https://" . $username . ":" . $accessKey . "@hub-cloud.browserstack.com/wd/hub",
  $caps
);