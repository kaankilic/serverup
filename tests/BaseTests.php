<?php namespace Kaankilic\ServerUp\Tests;

use Kaankilic\ServerUp\Facades\ServerUp;

/**
 * Class BaseTests
 *
 * @package Tests
 */
class BaseTests extends TestCase{

    /**
     * Test basic ping functionality with trying to send ping to google
     *
     * @test
     */
    public function testSimpleCase()
    {
        $ping = ServerUp::ping('http://google.com',80);
        $this->assertTrue(ServerUp::getIsTotalyAvail());
    }

}