<?php

//declare(strict_types=1);

namespace App\Traits;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
trait RequestService
{
    // /**
    //  * @param       $method
    //  * @param       $requestUrl
    //  * @param array $formParams
    //  * @param array $headers
    //  *
    //  * @return string
    //  * @throws \GuzzleHttp\Exception\GuzzleException
    //  */
    public function request($method, $requestUrl, $formParams = [], $headers = []): string
    {
        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);
        // $token = Session::get('token');
        // //$headers['Authorization'] = 'bearer ' . Http::get("localhost:8000/api/token")->json()["jwt"];
        // error_log($headers);

        $response = $client->request($method, $requestUrl,
        [
            'form_params' => $formParams,
            'headers' => $headers
        ]
        );
        return $response->getBody()->getContents();
    }
}
