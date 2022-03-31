<?php

namespace Seurch;

class Seurch
{
    /**
     * @var Engine[]
     */
    protected array $engines = [];

    /**
     * @param Engine[] $engines
     * @return void
     */
    public function setEngines(array $engines): void
    {
        $this->engines = [];
        foreach ($engines as $engine) {
            $this->addEngine($engine);
        }
    }

    /**
     * @param Engine $engine
     * @return void
     */
    public function addEngine(Engine $engine)
    {
        $this->engines[$engine->getCode()] = $engine;
    }

    /**
     * @param string $string
     * @return Result[]
     */
    public function find(string $string): array
    {
        $results = [];

        foreach ($this->engines as $engine) {
            $results = array_merge($results, $engine->find($string));
        }

        return $results;
    }
}
