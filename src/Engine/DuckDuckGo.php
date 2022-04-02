<?php

namespace Seurch\Engine;

use Seurch\Engine;
use Seurch\Request;
use Seurch\Result;

class DuckDuckGo implements Engine
{
    /**
     * @return string
     */
    public function getCode(): string
    {
        return 'duckduckgo';
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'DuckDuckGo';
    }

    /**
     * @return string[]
     */
    public function getTags(): array
    {
        return ['search'];
    }

    /**
     * @param string $string
     * @return Result[]
     */
    public function find(string $string): array
    {
        $uri = 'https://html.duckduckgo.com/html/?q=' . urlencode($string);
        $html = Request::create($uri)->executeOnce();

        $dom = new \DOMDocument();
        @$dom->loadHTML($html);

        $xpath = new \DOMXPath($dom);
        $nodes = $xpath->query('//div[@id="links"]//div[contains(@class,"result__body")]');

        $results = [];

        foreach ($nodes as $node) {
            $item = new Result();
            $item->setTitle($xpath->query('h2/a', $node)->item(0)->nodeValue);
            $item->setDescription($xpath->query('a[@class="result__snippet"]', $node)->item(0)->nodeValue);
            $item->setUrl(trim($xpath->query('div/div/a[@class="result__url"]', $node)->item(0)->nodeValue));

            $results[] = $item;
        }

        return $results;
    }
}
