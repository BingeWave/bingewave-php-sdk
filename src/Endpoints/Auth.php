<?php

namespace Bingewave\BingewavePhpSdk\Endpoints;

use Bingewave\BingewavePhpSdk\BingeWaveSDK;

final class Auth extends BaseEndpoint
{
    private $sdk;

    public function __construct(BingeWaveSDK $sdk)
    {
        $this->sdk = $sdk;
    }

    public function login(array $body = [])
    {

        return $this->processResponse($this->sdk->getHttpClient()->post('/auth/login', [], json_encode($body)));
    }

    public function register(array $body = [])
    {
        return $this->processResponse($this->sdk->getHttpClient()->post('/auth/register', [], json_encode($body) ));
    }

    public function getDistributorAccessToken(array $body = [])
    {
        return $this->processResponse($this->sdk->getHttpClient()->post('/auth/getDistributorAccessToken', [], json_encode($body) ));
    }
} 