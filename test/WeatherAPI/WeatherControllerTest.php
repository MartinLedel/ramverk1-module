<?php
namespace Anax\WeatherAPI;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class WeatherControllerTest extends TestCase
{
    protected $controllerTest;

    /**
     * Setup before each testcase
     */
    protected function setUp()
    {
        global $di;
        // Setup di
        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $di->loadServices(ANAX_INSTALL_PATH . "/test/config/di");

        $this->di = $di;
        // Setup the controller
        $this->controllerTest = new WeatherController();
        $this->controllerTest->setDI($this->di);
        $this->controllerTest->initialize();
    }

    /**
     * Tear down after each testcase
     */
    protected function tearDown()
    {
        $this->di->get("session")->destroy();
    }

    /**
     * Test the route "index".
     */
    public function testIndexAction()
    {
        // Test the controller action
        $res = $this->controllerTest->IndexAction();
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }

    /**
     * Test the route "index".
     */
    public function testweatherDataAction()
    {
        $requestTest = $this->di->get("request");
        // Test the controller action
        $requestTest->setGet("searchReq", "Karlskrona");
        $requestTest->setGet("date", "0");
        $res = $this->controllerTest->weatherDataAction();
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }

    /**
     * Test the route "info".
     */
    public function testFetchActionGet()
    {
        $requestTest = $this->di->get("request");
        // Test the controller action
        $requestTest->setGet("searchReq", "Karlskrona");
        $requestTest->setGet("date", "0");
        $res = $this->controllerTest->fetchActionGet();
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);

        $requestTest->setGet("searchReq", "8.8.8.8");
        $requestTest->setGet("date", "0");
        $res = $this->controllerTest->fetchActionGet();
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);

        // $requestTest->setGet("searchReq", "8.8.8.8");
        // $requestTest->setGet("date", "30");
        // $res = $this->controllerTest->fetchActionGet();
        // $this->assertInstanceOf("Anax\Response\Response", $res);
        // $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }

    public function testFetchFailActionGet()
    {
        $requestTest = $this->di->get("request");
        // Test the controller action
        $requestTest->setGet("searchReq", "");
        $requestTest->setGet("date", "0");
        $res = $this->controllerTest->fetchActionGet();
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);

        $requestTest->setGet("searchReq", "asdsafasfgafad");
        $requestTest->setGet("date", "0");
        $res = $this->controllerTest->fetchActionGet();
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);

        $requestTest->setGet("searchReq", "8.8.8.8.8.8.8.8.8.8");
        $requestTest->setGet("date", "0");
        $res = $this->controllerTest->fetchActionGet();
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }
}
