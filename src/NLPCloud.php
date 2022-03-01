<?php

namespace NLPCloud;


class NLPCloud
{
    const API_VERSION = 'v1';
    const BASE_URL = 'https://api.nlpcloud.io';

    public function __construct($model, $token, $gpu = false, $lang = '')
    {
        $this->headers = array(
            'Authorization' => 'Token ' . $token,
            'User-Agent' => 'nlpcloud-php-client',
        );

        if (($gpu) && ($lang != '')) {
            $this->rootURL = self::BASE_URL . '/' . self::API_VERSION . '/gpu/' . $lang . '/' . $model;
        } elseif (($gpu) && ($lang == '')) {
            $this->rootURL = self::BASE_URL . '/' . self::API_VERSION . '/gpu/' . $model;
        } elseif (!($gpu) && ($lang != '')) {
            $this->rootURL = self::BASE_URL . '/' . self::API_VERSION . '/' . $lang . '/' . $model;
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
        $doSample,
        $numBeams,
        $earlyStopping,
        $noRepeatNgramSize,
        $numReturnSequences,
        $topK,
        $topP,
        $temperature,
        $repetitionPenalty,
        $lengthPenalty,
        $badWords,
        $removeEndSequence
    ) {
        $payload = array(
            'text' => $text,
            'min_length' => $minLength,
            'max_length' => $maxLength,
            'length_no_input' => $lengthNoInput,
            'end_sequence' => $endSequence,
            'remove_input' => $removeInput,
            'do_sample' => $doSample,
            'num_beams' => $numBeams,
            'early_stopping' => $earlyStopping,
            'no_repeat_ngram_size' => $noRepeatNgramSize,
            'num_return_sequences' => $numReturnSequences,
            'top_k' => $topK,
            'top_p' => $topP,
            'temperature' => $temperature,
            'repetition_penalty' => $repetitionPenalty,
            'length_penalty' => $lengthPenalty,
            'bad_words' => $badWords,
            'remove_end_sequence' => $removeEndSequence
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

    public function semanticSimilarity($sentences)
    {
        $payload = array(
            'sentences' => $sentences,
        );
        $response = \Httpful\Request::post($this->rootURL . '/' . 'semantic-similarity', $payload)
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

    public function embeddings($sentences)
    {
        $payload = array(
            'sentences' => $sentences,
        );
        $response = \Httpful\Request::post($this->rootURL . '/' . 'embeddings', $payload)
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
