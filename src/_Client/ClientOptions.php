<?php
namespace Bingewave\BingewavePhpSdk\Client;

use Http\Discovery\Psr17FactoryDiscovery;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\UriInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ClientOptions
{
    private $options = [];

    public function __construct(array $options = [])
    {
        $resolver = new OptionsResolver();

        //$resolver->setAllowedTypes('uri', 'string');
        //$resolver->setAllowedTypes('client_builder', ClientBuilder::class);
        //$resolver->setAllowedTypes('uri_factory', UriFactoryInterface::class);
        
        $this->configureOptions($resolver);
        $this->options = $resolver->resolve($options);
    }

    public function getClientBuilder(): ClientBuilder
    {
        return $this->options['client_builder'];;
    }

    public function getUriFactory(): UriFactoryInterface
    {
        return $this->options['uri_factory'];
    }

    public function getUri(): UriInterface
    {
        return $this->getUriFactory()->createUri($this->options['uri']);
    }

    private function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'client_builder' => new ClientBuilder(),
            'uri_factory' => Psr17FactoryDiscovery::findUriFactory(),
            'uri' => 'https://bw.bingewave.com',
        ]);
    }
}