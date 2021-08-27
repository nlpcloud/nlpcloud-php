<?php

namespace NLPCloud;


class NLPCloud
{
    const API_VERSION = 'v1';
    const BASE_URL = 'https://api.nlpcloud.io';

    public function __construct($model, $token, $gpu = false)
    {
        $this->headers = array(
            'Authorization' => 'Token ' . $token,
            'User-Agent' => 'nlpcloud-php-client',
        );

        if ($gpu) {
            $this->rootURL = self::BASE_URL . '/' . self::API_VERSION . '/gpu/' . $model;
        } else {
            $this->rootURL = self::BASE_URL . '/' . self::API_VERSION . '/' . $model;
        }
    }

    public function entities($text)
    {
        $payload = array(
            'text' => $text,
        );
        $response = \Httpful\Request::post($this->rootURL . '/' . 'entities', $payload)
            ->expectsJson()
            ->sendsJson()
            ->addHeaders($this->headers)
            ->send();

        if ($response->code != 200) {
            throw new \Exception($response->code . ': ' . $response->body->detail);
        }

        return $response->body;
    }

    public function classification($text, $labels, $multiClass)
    {
        $payload = array(
            'text' => $text,
            'labels' => $labels,
            'multiClass' => $multiClass
        );
        $response = \Httpful\Request::post($this->rootURL . '/' . 'classification', $payload)
            ->expectsJson()
            ->sendsJson()
            ->addHeaders($this->headers)
            ->send();

        if ($response->code != 200) {
            throw new \Exception($response->code . ': ' . $response->body->detail);
        }

        return $response->body;
    }

    public function generation(
        $text,
        $minLength,
        $maxLength,
        $lengthNoInput,
        $endSequence,
        $removeInput,
        $topK,
        $topP,
        $temperature,
        $repetitionPenalty,
        $lengthPenalty
    ) {
        $payload = array(
            'text' => $text,
            'min_length' => $minLength,
            'max_length' => $maxLength,
            'length_no_input' => $lengthNoInput,
            'end_sequence' => $endSequence,
            'remove_input' => $removeInput,
            'top_k' => $topK,
            'top_p' => $topP,
            'temperature' => $temperature,
            'repetition_penalty' => $repetitionPenalty,
            'length_penalty' => $lengthPenalty
        );
        $response = \Httpful\Request::post($this->rootURL . '/' . 'generation', $payload)
            ->expectsJson()
            ->sendsJson()
            ->addHeaders($this->headers)
            ->send();

        if ($response->code != 200) {
            throw new \Exception($response->code . ': ' . $response->body->detail);
        }

        return $response->body;
    }

    public function sentiment($text)
    {
        $payload = array(
            'text' => $text
        );
        $response = \Httpful\Request::post($this->rootURL . '/' . 'sentiment', $payload)
            ->expectsJson()
            ->sendsJson()
            ->addHeaders($this->headers)
            ->send();

        if ($response->code != 200) {
            throw new \Exception($response->code . ': ' . $response->body->detail);
        }

        return $response->body;
    }

    public function question($context, $question)
    {
        $payload = array(
            'context' => $context,
            'question' => $question
        );
        $response = \Httpful\Request::post($this->rootURL . '/' . 'question', $payload)
            ->expectsJson()
            ->sendsJson()
            ->addHeaders($this->headers)
            ->send();

        if ($response->code != 200) {
            throw new \Exception($response->code . ': ' . $response->body->detail);
        }

        return $response->body;
    }

    public function summarization($text)
    {
        $payload = array(
            'text' => $text
        );
        $response = \Httpful\Request::post($this->rootURL . '/' . 'summarization', $payload)
            ->expectsJson()
            ->sendsJson()
            ->addHeaders($this->headers)
            ->send();

        if ($response->code != 200) {
            throw new \Exception($response->code . ': ' . $response->body->detail);
        }

        return $response->body;
    }

    public function translation($text)
    {
        $payload = array(
            'text' => $text
        );
        $response = \Httpful\Request::post($this->rootURL . '/' . 'translation', $payload)
            ->expectsJson()
            ->sendsJson()
            ->addHeaders($this->headers)
            ->send();

        if ($response->code != 200) {
            throw new \Exception($response->code . ': ' . $response->body->detail);
        }

        return $response->body;
    }

    public function langdetection($text)
    {
        $payload = array(
            'text' => $text
        );
        $response = \Httpful\Request::post($this->rootURL . '/' . 'langdetection', $payload)
            ->expectsJson()
            ->sendsJson()
            ->addHeaders($this->headers)
            ->send();

        if ($response->code != 200) {
            throw new \Exception($response->code . ': ' . $response->body->detail);
        }

        return $response->body;
    }

    public function tokens($text)
    {
        $payload = array(
            'text' => $text
        );
        $response = \Httpful\Request::post($this->rootURL . '/' . 'tokens', $payload)
            ->expectsJson()
            ->sendsJson()
            ->addHeaders($this->headers)
            ->send();

        if ($response->code != 200) {
            throw new \Exception($response->code . ': ' . $response->body->detail);
        }

        return $response->body;
    }

    public function dependencies($text)
    {
        $payload = array(
            'text' => $text,
        );
        $response = \Httpful\Request::post($this->rootURL . '/' . 'dependencies', $payload)
            ->expectsJson()
            ->sendsJson()
            ->addHeaders($this->headers)
            ->send();

        if ($response->code != 200) {
            throw new \Exception($response->code . ': ' . $response->body->detail);
        }

        return $response->body;
    }

    public function sentenceDependencies($text)
    {
        $payload = array(
            'text' => $text,
        );
        $response = \Httpful\Request::post($this->rootURL . '/' . 'sentence-dependencies', $payload)
            ->expectsJson()
            ->sendsJson()
            ->addHeaders($this->headers)
            ->send();

        if ($response->code != 200) {
            throw new \Exception($response->code . ': ' . $response->body->detail);
        }

        return $response->body;
    }

    public function libVersions()
    {
        $response = \Httpful\Request::get($this->rootURL . '/' . 'versions')
            ->expectsJson()
            ->sendsJson()
            ->addHeaders($this->headers)
            ->send();


        if ($response->code != 200) {
            throw new \Exception($response->code . ': ' . $response->body->detail);
        }

        return $response->body;
    }
}
