<?php

namespace NLPCloud;


class NLPCloud
{
    const API_VERSION = 'v1';
    const BASE_URL = 'https://api.nlpcloud.io';

    public function __construct($model, $token, $gpu = false, $lang = '', $asynchronous = false)
    {
        $this->headers = array(
            'Authorization' => 'Token ' . $token,
            'User-Agent' => 'nlpcloud-php-client',
        );

        $this->rootURL = self::BASE_URL . '/' . self::API_VERSION . '/';

        if ($lang == 'en') {
            $lang = '';
        }
        if ($lang == 'eng_Latn') {
            $lang = '';
        }


        if ($gpu) {
            $this->rootURL = $this->rootURL . 'gpu/';
        }

        if ($asynchronous) {
            $this->rootURL = $this->rootURL . 'async/';
        }

        if ($lang != '') {
            $this->rootURL = $this->rootURL . $lang . '/';
        }

        $this->rootURL = $this->rootURL . $model;
    }

    public function adGeneration($keywords)
    {
        $payload = array(
            'keywords' => $keywords
        );
        $response = \Httpful\Request::post($this->rootURL . '/' . 'ad-generation', $payload)
            ->expectsJson()
            ->sendsJson()
            ->addHeaders($this->headers)
            ->send();

        if ($response->code >= 400) {
            throw new \Exception($response->code . ': ' . $response->body->detail);
        }

        return $response->body;
    }

    public function asr($url = NULL, $encodedFile = NULL, $inputLanguage = NULL)
    {
        $payload = array(
            'url' => $url,
            'encoded_file' => $encodedFile,
            'input_language' => $inputLanguage
        );
        $response = \Httpful\Request::post($this->rootURL . '/' . 'asr', $payload)
            ->expectsJson()
            ->sendsJson()
            ->addHeaders($this->headers)
            ->send();

        if ($response->code >= 400) {
            throw new \Exception($response->code . ': ' . $response->body->detail);
        }

        return $response->body;
    }

    public function asyncResult($url)
    {
        $response = \Httpful\Request::get($url)
            ->expectsJson()
            ->sendsJson()
            ->addHeaders($this->headers)
            ->send();

        if ($response->code >= 400) {
            throw new \Exception($response->code . ': ' . $response->body->detail);
        }

        return $response->body;
    }

    public function chatbot($input, $context = NULL, $history = NULL)
    {
        $payload = array(
            'input' => $input,
            'context' => $context,
            'history' => $history
        );
        $response = \Httpful\Request::post($this->rootURL . '/' . 'chatbot', $payload)
            ->expectsJson()
            ->sendsJson()
            ->addHeaders($this->headers)
            ->send();

        if ($response->code >= 400) {
            throw new \Exception($response->code . ': ' . $response->body->detail);
        }

        return $response->body;
    }

    public function classification($text, $labels = NULL, $multiClass = True)
    {
        $payload = array(
            'text' => $text,
            'labels' => $labels,
            'multi_class' => $multiClass
        );
        $response = \Httpful\Request::post($this->rootURL . '/' . 'classification', $payload)
            ->expectsJson()
            ->sendsJson()
            ->addHeaders($this->headers)
            ->send();

        if ($response->code >= 400) {
            throw new \Exception($response->code . ': ' . $response->body->detail);
        }

        return $response->body;
    }

    public function codeGeneration($instruction)
    {
        $payload = array(
            'instruction' => $instruction
        );
        $response = \Httpful\Request::post($this->rootURL . '/' . 'code-generation', $payload)
            ->expectsJson()
            ->sendsJson()
            ->addHeaders($this->headers)
            ->send();

        if ($response->code >= 400) {
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

        if ($response->code >= 400) {
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

        if ($response->code >= 400) {
            throw new \Exception($response->code . ': ' . $response->body->detail);
        }

        return $response->body;
    }

    public function entities($text, $searchedEntity = NULL)
    {
        $payload = array(
            'text' => $text,
            'searched_entity' => $searchedEntity
        );
        $response = \Httpful\Request::post($this->rootURL . '/' . 'entities', $payload)
            ->expectsJson()
            ->sendsJson()
            ->addHeaders($this->headers)
            ->send();

        if ($response->code >= 400) {
            throw new \Exception($response->code . ': ' . $response->body->detail);
        }

        return $response->body;
    }

    public function generation(
        $text,
        $maxLength = NULL,
        $lengthNoInput = NULL,
        $endSequence = NULL,
        $removeInput = NULL,
        $numBeams = NULL,
        $numReturnSequences = NULL,
        $topK = NULL,
        $topP = NULL,
        $temperature = NULL,
        $repetitionPenalty = NULL,
        $badWords = NULL,
        $removeEndSequence = NULL
    ) {
        $payload = array(
            'text' => $text,
            'max_length' => $maxLength,
            'length_no_input' => $lengthNoInput,
            'end_sequence' => $endSequence,
            'remove_input' => $removeInput,
            'num_beams' => $numBeams,
            'num_return_sequences' => $numReturnSequences,
            'top_k' => $topK,
            'top_p' => $topP,
            'temperature' => $temperature,
            'repetition_penalty' => $repetitionPenalty,
            'bad_words' => $badWords,
            'remove_end_sequence' => $removeEndSequence
        );
        $response = \Httpful\Request::post($this->rootURL . '/' . 'generation', $payload)
            ->expectsJson()
            ->sendsJson()
            ->addHeaders($this->headers)
            ->send();

        if ($response->code >= 400) {
            throw new \Exception($response->code . ': ' . $response->body->detail);
        }

        return $response->body;
    }

    public function gsCorrection($text)
    {
        $payload = array(
            'text' => $text
        );
        $response = \Httpful\Request::post($this->rootURL . '/' . 'gs-correction', $payload)
            ->expectsJson()
            ->sendsJson()
            ->addHeaders($this->headers)
            ->send();

        if ($response->code >= 400) {
            throw new \Exception($response->code . ': ' . $response->body->detail);
        }

        return $response->body;
    }

    public function imageGeneration($text)
    {
        $payload = array(
            'text' => $text
        );
        $response = \Httpful\Request::post($this->rootURL . '/' . 'image-generation', $payload)
            ->expectsJson()
            ->sendsJson()
            ->addHeaders($this->headers)
            ->send();

        if ($response->code >= 400) {
            throw new \Exception($response->code . ': ' . $response->body->detail);
        }

        return $response->body;
    }

    public function intentClassification($text)
    {
        $payload = array(
            'text' => $text
        );
        $response = \Httpful\Request::post($this->rootURL . '/' . 'intent-classification', $payload)
            ->expectsJson()
            ->sendsJson()
            ->addHeaders($this->headers)
            ->send();

        if ($response->code >= 400) {
            throw new \Exception($response->code . ': ' . $response->body->detail);
        }

        return $response->body;
    }

    public function kwKpExtraction($text)
    {
        $payload = array(
            'text' => $text
        );
        $response = \Httpful\Request::post($this->rootURL . '/' . 'kw-kp-extraction', $payload)
            ->expectsJson()
            ->sendsJson()
            ->addHeaders($this->headers)
            ->send();

        if ($response->code >= 400) {
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

        if ($response->code >= 400) {
            throw new \Exception($response->code . ': ' . $response->body->detail);
        }

        return $response->body;
    }

    public function paraphrasing($text)
    {
        $payload = array(
            'text' => $text
        );
        $response = \Httpful\Request::post($this->rootURL . '/' . 'paraphrasing', $payload)
            ->expectsJson()
            ->sendsJson()
            ->addHeaders($this->headers)
            ->send();

        if ($response->code >= 400) {
            throw new \Exception($response->code . ': ' . $response->body->detail);
        }

        return $response->body;
    }

    public function question($question, $context = NULL)
    {
        $payload = array(
            'question' => $question,
            'context' => $context
        );
        $response = \Httpful\Request::post($this->rootURL . '/' . 'question', $payload)
            ->expectsJson()
            ->sendsJson()
            ->addHeaders($this->headers)
            ->send();

        if ($response->code >= 400) {
            throw new \Exception($response->code . ': ' . $response->body->detail);
        }

        return $response->body;
    }

    public function semanticSearch($text, $numResults = NULL)
    {
        $payload = array(
            'text' => $text,
            'num_results' => $numResults,
        );
        $response = \Httpful\Request::post($this->rootURL . '/' . 'semantic-search', $payload)
            ->expectsJson()
            ->sendsJson()
            ->addHeaders($this->headers)
            ->send();

        if ($response->code >= 400) {
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

        if ($response->code >= 400) {
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

        if ($response->code >= 400) {
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

        if ($response->code >= 400) {
            throw new \Exception($response->code . ': ' . $response->body->detail);
        }

        return $response->body;
    }

    public function speechSynthesis($text, $voice = NULL)
    {
        $payload = array(
            'text' => $text,
            'voice' => $voice
        );
        $response = \Httpful\Request::post($this->rootURL . '/' . 'speech-synthesis', $payload)
            ->expectsJson()
            ->sendsJson()
            ->addHeaders($this->headers)
            ->send();

        if ($response->code >= 400) {
            throw new \Exception($response->code . ': ' . $response->body->detail);
        }

        return $response->body;
    }

    public function summarization($text, $size = NULL)
    {
        $payload = array(
            'text' => $text,
            'size' => $size
        );
        $response = \Httpful\Request::post($this->rootURL . '/' . 'summarization', $payload)
            ->expectsJson()
            ->sendsJson()
            ->addHeaders($this->headers)
            ->send();

        if ($response->code >= 400) {
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

        if ($response->code >= 400) {
            throw new \Exception($response->code . ': ' . $response->body->detail);
        }

        return $response->body;
    }

    public function translation($text, $source, $target)
    {
        $payload = array(
            'text' => $text,
            'source' => $source,
            'target' => $target
        );
        $response = \Httpful\Request::post($this->rootURL . '/' . 'translation', $payload)
            ->expectsJson()
            ->sendsJson()
            ->addHeaders($this->headers)
            ->send();

        if ($response->code >= 400) {
            throw new \Exception($response->code . ': ' . $response->body->detail);
        }

        return $response->body;
    }
}
