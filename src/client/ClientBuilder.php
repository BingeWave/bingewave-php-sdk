<?php
namespace Bingewave\BingewavePhpSdk\Client;

use Http\Client\Common\HttpMethodsClient;
use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin;
use Http\Client\Common\PluginClientFactory;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\Psr17FactoryDiscovery;
use HttpDiscoveryHttpClientDiscovery;
use HttpDiscoveryPsr17FactoryDiscovery;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use PsrHttp\MessageRequestFactoryInterface;
use PsrHttp\MessageStreamFactoryInterface;

final class ClientBuilder
{

    private $_httpClient;
    private $_requestFactoryInterface;
    private $_streamFactoryInterface;

    private $plugins = [];

    public function __construct(
        ClientInterface $httpClient = null,
        RequestFactoryInterface $requestFactoryInterface = null,
        StreamFactoryInterface $streamFactoryInterface = null
    ) {
        $this->_httpClient = $httpClient ?: HttpClientDiscovery::find();
        $this->_requestFactoryInterface = $requestFactoryInterface ?: Psr17FactoryDiscovery::findRequestFactory();
        $this->_streamFactoryInterface = $streamFactoryInterface ?: Psr17FactoryDiscovery::findStreamFactory();
    }

    public function addPlugin(Plugin $plugin) : void {
        $this->plugins[] = $plugin;
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        $pluginClient = (new PluginClientFactory())->createClient($this->_httpClient, $this->plugins);

        return new HttpMethodsClient(
            $pluginClient,
            $this->_requestFactoryInterface,
            $this->_streamFactoryInterface
        );
    }
}
