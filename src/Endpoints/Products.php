<?php

namespace Bingewave\BingewavePhpSdk\Endpoints;

use Bingewave\BingewavePhpSdk\BingeWaveSDK;

final class Products extends BaseEndpoint
{
    protected $sdk;

    public function __construct(BingeWaveSDK $sdk)
    {
        $this->sdk = $sdk;
    }

    public function list(array $params = [], array $headers = [])
    {

        $url = $this->addParameters('/products', $params);

        return $this->processResponse($this->sdk->getHttpClient()->get($url, $headers));
    }

    public function retrieve(string $id, array $params = [], array $headers = [])
    {

        $url = $this->addParameters('/products/' . $id, $params);
        
        return $this->processResponse($this->sdk->getHttpClient()->get($url, $headers));
    }

    public function create(array $body = [], array $headers = [])
    {
        return $this->processResponse($this->sdk->getHttpClient()->post('/products', $headers, json_encode($body)));
    }

    public function update(string $id, array $body = [], array $headers = [])
    {
        
        return $this->processResponse($this->sdk->getHttpClient()->put('/products/' . $id, $headers, json_encode($body)));
    }

    public function delete(string $id, array $body = [], array $headers = [])
    {
        
        return $this->processResponse($this->sdk->getHttpClient()->delete('/products/' . $id, $headers, json_encode($body)));
    }
} 