<?php

namespace Bingewave\BingewavePhpSdk\Endpoints;

use Bingewave\BingewavePhpSdk\BingeWaveSDK;

final class Events extends BaseEndpoint
{
    protected $sdk;

    public function __construct(BingeWaveSDK $sdk)
    {
        $this->sdk = $sdk;
    }

    public function list(array $params = [], array $headers = [])
    {

        $url = $this->addParameters('/events', $params);

        return $this->processResponse($this->sdk->getHttpClient()->get($url, $headers));
    }

    public function retrieve(string $id, array $params = [], array $headers = [])
    {

        $url = $this->addParameters('/events/' . $id, $params);
        
        return $this->processResponse($this->sdk->getHttpClient()->get($url, $headers));
    }

    public function create(array $body = [], array $headers = [])
    {
        return $this->processResponse($this->sdk->getHttpClient()->post('/events', $headers, json_encode($body)));
    }

    public function update(string $id, array $body = [], array $headers = [])
    {
        
        return $this->processResponse($this->sdk->getHttpClient()->put('/events/' . $id, $headers, json_encode($body)));
    }

    public function delete(string $id, array $body = [], array $headers = [])
    {
        
        return $this->processResponse($this->sdk->getHttpClient()->delete('/events/' . $id, $headers, json_encode($body)));
    }
} 