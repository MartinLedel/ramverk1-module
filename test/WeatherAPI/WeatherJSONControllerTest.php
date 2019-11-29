<?php
namespace Anax\WeatherAPI;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class WeatherJSONControllerTest extends TestCase
{
    private $controller;

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
        $this->controller = new WeatherJSONController();
        $this->controller->setDI($this->di);
        $this->controller->initialize();
    }

    /**
     * Test the route "index".
     */
    public function testIndexAction()
    {
        // Test the controller action
        $res = $this->controller->IndexAction();
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }
    /**
     * Test the route "info".
     */
    public function testFetchActionGet()
    {
        $request = $this->di->get("request");
        // Test the controller action
        $request->setGet("searchReq", "Karlskrona");
        $request->setGet("date", "0");
        $res = $this->controller->fetchActionGet();
        $this->assertIsArray($res);
        $this->assertArrayHasKey("address", $res[0]);
        $this->assertArrayHasKey("weather_data", $res[0]);

        $request->setGet("searchReq", "8.8.8.8");
        $request->setGet("date", "0");
        $res = $this->controller->fetchActionGet();
        $this->assertIsArray($res);
        $this->assertArrayHasKey("address", $res[0]);
        $this->assertArrayHasKey("weather_data", $res[0]);

        $request->setGet("searchReq", "8.8.8.8");
        $request->setGet("date", "30");
        $res = $this->controller->fetchActionGet();
        $this->assertIsArray($res);
        $this->assertArrayHasKey("address", $res[0]);
        $this->assertArrayHasKey("weather_data", $res[0]);
    }

    public function testFetchFailActionGet()
    {
        $request = $this->di->get("request");
        // Test the controller action
        $request->setGet("searchReq", "");
        $request->setGet("date", "0");
        $res = $this->controller->fetchActionGet();
        $this->assertIsArray($res);
        $this->assertArrayHasKey("address", $res[0]);

        $request->setGet("searchReq", "Kalle");
        $request->setGet("date", "0");
        $res = $this->controller->fetchActionGet();
        $this->assertIsArray($res);
        $this->assertArrayHasKey("address", $res[0]);

        $request->setGet("searchReq", "");
        $request->setGet("date", "30");
        $res = $this->controller->fetchActionGet();
        $this->assertIsArray($res);
        $this->assertArrayHasKey("address", $res[0]);
    }
}
