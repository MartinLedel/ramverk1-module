<?php
namespace Anax\WeatherAPI;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class WeatherJSONControllerTest extends TestCase
{
    private $controllerTest;

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
        $this->controllerTest = new WeatherJSONController();
        $this->controllerTest->setDI($this->di);
        $this->controllerTest->initialize();
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
     * Test the route "info".
     */
    public function testFetchActionGet()
    {
        $requestTest = $this->di->get("request");
        // Test the controller action
        $requestTest->setGet("searchReq", "Karlskrona");
        $requestTest->setGet("date", "0");
        $res = $this->controllerTest->fetchActionGet();
        $this->assertIsArray($res);
        $this->assertArrayHasKey("address", $res[0]);
        $this->assertArrayHasKey("weather_data", $res[0]);

        $requestTest->setGet("searchReq", "8.8.8.8");
        $requestTest->setGet("date", "0");
        $res = $this->controllerTest->fetchActionGet();
        $this->assertIsArray($res);
        $this->assertArrayHasKey("address", $res[0]);
        $this->assertArrayHasKey("weather_data", $res[0]);

        // $requestTest->setGet("searchReq", "8.8.8.8");
        // $requestTest->setGet("date", "30");
        // $res = $this->controllerTest->fetchActionGet();
        // $this->assertIsArray($res);
        // $this->assertArrayHasKey("address", $res[0]);
        // $this->assertArrayHasKey("weather_data", $res[0]);
    }

    public function testFetchFailActionGet()
    {
        $requestTest = $this->di->get("request");
        // Test the controller action
        $requestTest->setGet("searchReq", "");
        $requestTest->setGet("date", "0");
        $res = $this->controllerTest->fetchActionGet();
        $this->assertIsArray($res);
        $this->assertArrayHasKey("address", $res[0]);

        $requestTest->setGet("searchReq", "Kalle");
        $requestTest->setGet("date", "0");
        $res = $this->controllerTest->fetchActionGet();
        $this->assertIsArray($res);
        $this->assertArrayHasKey("address", $res[0]);
    }
}
