<?php namespace Kaankilic\ServerUp\Tests;

use Kaankilic\ServerUp\Facades\ServerUp;

/**
 * Class BaseTests
 *
 * @package Tests
 */
class BaseTests extends TestCase
{

    /**
     * Test basic slugging functionality.
     *
     * @test
     */
    public function testSimpleCase()
    {
        $ping = ServerUp::ping('http://google.com',80);
        $this->assertEquals('my-first-post', $ping);
    }

}