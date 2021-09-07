<?php

namespace Bingewave\BingewavePhpSdk;

use Bingewave\BingewavePhpSdk\Client\ClientBuilder;
use Bingewave\BingewavePhpSdk\Client\ClientOptions;
use Bingewave\BingewavePhpSdk\Endpoints\Auth;
use Bingewave\BingewavePhpSdk\Endpoints\Events;
use Bingewave\BingewavePhpSdk\Response\JSONResponse;
use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\BaseUriPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Message\UriFactory;

final class BingeWaveSDK
{

    private $clientBuilder;

    private $responseMediator;

    public function __construct(ClientOptions $clientOptions = null, array $headers = [], $responseMediator = null)
    {
        $options = $options ?? new ClientOptions();

        $this->clientBuilder = $options->getClientBuilder();

        $this->clientBuilder->addPlugin(new BaseUriPlugin($options->getUri()));

        $this->responseMediator = $responseMediator ?? new JSONResponse();

        $headers +=  [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];

        $this->clientBuilder->addPlugin(
            new HeaderDefaultsPlugin($headers)
        );
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->clientBuilder->getHttpClient();
    }

    public function getResponseMediator() {
        return $this->responseMediator;
    }

    public function auth(): Auth
    {
        return new Auth($this);
    }

    public function events(): Events
    {
        return new Events($this);
    }
}
