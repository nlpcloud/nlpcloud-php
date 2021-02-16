<?php

namespace NLPCloud;

class Client
{
    const API_VERSION = 'v1';
    const BASE_URL = 'https://api.nlpcloud.io';

    public function __construct($model, $token)
    {
        $this->headers = array(
            'Authorization' => 'Token ' . $token,
        );
        $this->rootURL = self::BASE_URL . '/' . self::API_VERSION . '/' . $model;
    }

    private function __apiPost($endpoint, $userInput)
    {
        $payload = array(
            'text' => $userInput,
        );
        $response = \Httpful\Request::post($this->rootURL . '/' . $endpoint, $payload)
            ->expectsJson()
            ->sendsJson()
            ->addHeaders($this->headers)
            ->send();

        $body = $response->body;

        if (isset($body->error_code)) {
            throw new \Exception($body->error_code . ': ' . $body->detail);
        }

        return $body->detail;
    }

    private function __apiGet($endpoint)
    {
        $response = \Httpful\Request::get($this->rootURL . '/' . $endpoint)
            ->expectsJson()
            ->sendsJson()
            ->addHeaders($this->headers)
            ->send();

        $body = $response->body;

        if (isset($body->error_code)) {
            throw new \Exception($body->error_code . ': ' . $body->detail);
        }

        return $body->detail;
    }

    public function entities($userInput)
    {
        return $this->__apiPost('entities', $userInput);
    }
    public function dependencies($userInput)
    {
        return $this->__apiPost('dependencies', $userInput);
    }
    public function sentenceDependencies($userInput)
    {
        return $this->__apiPost('sentenceDependencies', $userInput);
    }
    public function libVersions()
    {
        return $this->__apiGet('version');
    }
}
