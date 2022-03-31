<?php

use PHPUnit\Framework\TestCase;
use Seurch\Seurch;

class SeurchTest extends TestCase
{
    /**
     * @var Seurch
     */
    protected Seurch $instance;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->instance = new Seurch();
    }

    /**
     * @covers Seurch::find
     * @return void
     */
    public function testFind()
    {
        $engine = $this->createMock(\Seurch\Engine::class);
        $engine->method('getCode')->willReturn('test');
        $engine->method('getName')->willReturn('Test');
        $engine->method('find')->willReturn([]);

        $this->instance->addEngine($engine);
        $this->assertEmpty($this->instance->find('something'));
    }
}
