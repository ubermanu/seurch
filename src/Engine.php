<?php

namespace Seurch;

interface Engine
{
    /**
     * @return string
     */
    public function getCode(): string;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string[]
     */
    public function getTags(): array;

    /**
     * @param string $string
     * @return Result[]
     */
    public function find(string $string): array;
}
