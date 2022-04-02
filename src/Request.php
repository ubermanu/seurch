<?php

namespace Seurch;

class Request
{
    protected \CurlHandle $ch;

    public function __construct()
    {
        $this->ch = \curl_init();
        \curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url): Request
    {
        \curl_setopt($this->ch, CURLOPT_URL, $url);
        return $this;
    }

    /**
     * @return string
     */
    public function executeOnce(): string
    {
        $response = $this->execute();
        $this->close();
        return $response;
    }

    /**
     * @return string
     */
    public function execute(): string
    {
        return \curl_exec($this->ch);
    }

    /**
     * @return bool
     */
    public function close(): bool
    {
        \curl_close($this->ch);
        return true;
    }

    /**
     * @return Request
     */
    public function useRandomUserAgent(): Request
    {
        try {
            $userAgent = \Campo\UserAgent::random();
        } catch (\Exception $e) {
            $userAgent = 'Seurch/1.0';
        }

        \curl_setopt($this->ch, CURLOPT_USERAGENT, $userAgent);
        return $this;
    }

    /**
     * @param string $url
     * @return Request
     */
    public static function create(string $url): Request
    {
        return (new static())->setUrl($url)->useRandomUserAgent();
    }
}
