<?php

namespace Seurch;

class Query
{
    /**
     * @param string $url
     * @param array $params
     * @return string
     */
    public function execute(string $url, array $params = []): string
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    }
}
