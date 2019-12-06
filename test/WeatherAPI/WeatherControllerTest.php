<?php
namespace Anax\WeatherAPI;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class WeatherControllerTest extends TestCase
{
    protected $controller;

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
        $this->controller = new WeatherController();
        $this->controller->setDI($this->di);
        $this->controller->initialize();
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
        $res = $this->controller->IndexAction();
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }

    /**
     * Test the route "index".
     */
    public function testweatherDataAction()
    {
        $request = $this->di->get("request");
        // Test the controller action
        $request->setGet("searchReq", "Karlskrona");
        $request->setGet("date", "0");
        $res = $this->controller->weatherDataAction();
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
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);

        $request->setGet("searchReq", "8.8.8.8");
        $request->setGet("date", "0");
        $res = $this->controller->fetchActionGet();
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);

        $request->setGet("searchReq", "8.8.8.8");
        $request->setGet("date", "30");
        $res = $this->controller->fetchActionGet();
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }

    public function testFetchFailActionGet()
    {
        $request = $this->di->get("request");
        // Test the controller action
        $request->setGet("searchReq", "");
        $request->setGet("date", "0");
        $res = $this->controller->fetchActionGet();
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);

        $request->setGet("searchReq", "asdsafasfgafad");
        $request->setGet("date", "0");
        $res = $this->controller->fetchActionGet();
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);

        $request->setGet("searchReq", "8.8.8.8.8.8.8.8.8.8");
        $request->setGet("date", "0");
        $res = $this->controller->fetchActionGet();
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }
}
