<?php
namespace Bingewave\BingewavePhpSdk\Response;

use Exception;
use Psr\Http\Message\ResponseInterface;

final class JSONResponse
{
    public static function getContent(ResponseInterface $response): array
    {
        if($response->getStatusCode() >= 400){
            throw new Exception($response->getReasonPhrase(), $response->getStatusCode());
        }
        
        return json_decode($response->getBody()->getContents(), true);
    }
}