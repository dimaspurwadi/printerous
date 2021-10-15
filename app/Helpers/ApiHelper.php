<?php
namespace App\Helpers;

use GuzzleHttp\Client;

class ApiHelper
{
    public $httpClient;
    private $apiPath;
    private $headers;
    private $timeout;

    public function __construct(
        $apiPath,
        $headers = [],
        $timeout = 10
    ) {
        $this->httpClient = new Client();
        $this->apiPath = $apiPath;
        $this->headers = $headers;
        $this->timeout = $timeout;
    }

    public function hitApi($path, $method = 'GET', $body = [])
    {
        try {
            $params = [
                'headers' => $this->headers,
                'timeout' => $this->timeout
            ];

            if (!empty($body)) {
                if ($method == 'GET') {
                    $params['query'] = $body;
                } elseif ($method == 'POST' || $method == 'PUT') {
                    $params['json'] = $body;
                }
            }
            $response = $this->httpClient->request(
                $method,
                $this->apiPath,
                $params
            );
            dd($response);
            $jsonData = $response->getBody()->getContents();
            $parsedData = json_decode($jsonData, true) ?? [];

            return $parsedData;
        } catch (ClientException $err) {
            $jsonData = $err->getResponse()->getBody(true)->getContents();
            $parsedData = json_decode($jsonData, true) ?? [];

            return $parsedData;
        } catch(\Exception $err) {
            return null;
        }
    }
}