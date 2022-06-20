<?php

namespace Effernet\Core\Api;

class ApiHandler
{

    private string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function basicApiHandle($path)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->url . $path);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        return curl_exec($curl);
    }


}