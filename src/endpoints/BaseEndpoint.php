<?php

namespace Bingewave\BingewavePhpSdk\Endpoints;

use Psr\Http\Message\ResponseInterface;

class BaseEndpoint
{

    protected function addParameters(string $url, array $params = [])
    {
        $url_parts = parse_url($url);
        // If URL doesn't have a query string.
        if (isset($url_parts['query'])) { // Avoid 'Undefined index: query'
            parse_str($url_parts['query'], $parts);
        }

        if($parts){
            $params += $parts;
        }

        // Note that this will url_encode all values
        $url_parts['query'] = http_build_query($params);

        // If not
        return  $url_parts['path'] . '?' . $url_parts['query'];
    }

    protected function processResponse(ResponseInterface $response) {

        return $this->sdk->getResponseMediator()->getContent($response);
    }
}
