<?php

use PHPUnit\Framework\TestCase;
use Seurch\Engine\DuckDuckGo;

class DuckDuckGoTest extends TestCase
{
    /**
     * @var DuckDuckGo
     */
    protected DuckDuckGo $engine;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->engine = new DuckDuckGo();
    }

    /**
     * @covers DuckDuckGo::find
     * @return void
     */
    public function testFind()
    {
        $results = $this->engine->find('phpunit');
        $this->assertCount(29, $results);
    }
}
