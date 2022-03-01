# PHP Client For NLP Cloud

This is the PHP client for the [NLP Cloud](https://nlpcloud.io) API. See the [documentation](https://docs.nlpcloud.io) for more details.

NLP Cloud serves high performance pre-trained for NER, sentiment-analysis, classification, summarization, text generation, question answering, machine translation, language detection, tokenization, lemmatization, POS tagging, and dependency parsing. It is ready for production, served through a REST API.

You can either use the NLP Cloud pre-trained models, fine-tune your own models, or deploy your own models.

If you face an issue, don't hesitate to raise it as a Github issue. Thanks!

## Installation

Install via composer.

Create a `composer.json` file containing at least the following:

```json
{
    "require": {
        "nlpcloud/nlpcloud-client": "*"
    }
}
```

Then launch the following:

```shell
composer install
```

## Examples

Here is a full example that performs Named Entity Recognition (NER) using spaCy's `en_core_web_lg` model, with a fake token:

```php
<?php
require 'vendor/autoload.php';

use NLPCloud\NLPCloud;

$client = new \NLPCloud\NLPCloud('en_core_web_lg','4eC39HqLyjWDarjtT1zdp7dc');
$client->entities('John Doe is a Go Developer at Google');
?>
```

And a full example that uses your own custom model `7894`:

```php
<?php
require 'vendor/autoload.php';

use NLPCloud\NLPCloud;

$client = new \NLPCloud\NLPCloud('custom_model/7894','4eC39HqLyjWDarjtT1zdp7dc');
$client->entities('John Doe is a Go Developer at Google');
?>
```

A json object is returned. Here is what it could look like:

```json
[
  {
    "end": 8,
    "start": 0,
    "text": "John Doe",
    "type": "PERSON"
  },
  {
    "end": 25,
    "start": 13,
    "text": "Go Developer",
    "type": "POSITION"
  },
  {
    "end": 35,
    "start": 30,
    "text": "Google",
    "type": "ORG"
  },
]
```

## Usage

### Client Initialization

Pass the model you want to use and the NLP Cloud token to the client during initialization.

The model can either be a pretrained model like `en_core_web_lg`, `bart-large-mnli`... but also one of your custom models, using `custom_model/<model id>` (e.g. `custom_model/2568`).

Your token can be retrieved from your [NLP Cloud dashboard](https://nlpcloud.io/home/token).

```php
use NLPCloud\NLPCloud;

$client = new \NLPCloud\NLPCloud('<model>','<your token>');
```

If you want to use a GPU, pass `true` as a 3rd argument.

```php
use NLPCloud\NLPCloud;

$client = new \NLPCloud\NLPCloud('<model>','<your token>', true);
```

If you want to use the multilingual add-on in order to process non-English texts, set `'<your language code>'` as a 4th argument. For example, if you want to process French text, you should set `'fr'`.

```php
use NLPCloud\NLPCloud;

$client = new \NLPCloud\NLPCloud('<model>','<your token>', false, '<your language code>');
```

### Entities Endpoint

Call the `entities()` method and pass the text you want to perform named entity recognition (NER) on.

```php
$client->entities('<Your block of text>')
```

The above command returns a JSON object.

### Classification Endpoint

Call the `classification()` method and pass 3 arguments:

1. The text you want to classify, as a string
1. The candidate labels for your text, as an array of strings
1. Whether the classification should be multi-class or not, as a boolean

```php
client->classification("<Your block of text>", array("label 1", "label 2", "..."), true|false)
```

The above command returns a JSON object.

### Text Generation Endpoint

Call the `generation()` method and pass the following arguments:

1. The block of text that starts the generated text, as a string. 1200 tokens maximum.
1. `minLength`: The minimum number of tokens that the generated text should contain, as an integer. The size of the generated text should not exceed 256 tokens on a CPU plan and 1024 tokens on GPU plan. If `lengthNoInput` is false, the size of the generated text is the difference between `minLength` and the length of your input text. If `lengthNoInput` is true, the size of the generated text simply is `minLength`. Defaults to 10.
1. `maxLength`: The maximum number of tokens that the generated text should contain, as an integer. The size of the generated text should not exceed 256 tokens on a CPU plan and 1024 tokens on GPU plan. If `lengthNoInput` is false, the size of the generated text is the difference between `maxLength` and the length of your input text. If `lengthNoInput` is true, the size of the generated text simply is `maxLength`. Defaults to 50.
1. `lengthNoInput`: Whether `minLength` and `maxLength` should not include the length of the input text, as a boolean. If false, `minLength` and `maxLength` include the length of the input text. If true, min_length and `maxLength` don't include the length of the input text. Defaults to false.
1. `endSequence`: A specific token that should be the end of the generated sequence, as a string. For example if could be `.` or `\n` or `###` or anything else below 10 characters.
1. `removeEndSequence`: Whether you want to remove the end sequence form the result, as a boolean. Defaults to false.
1. `removeInput`: Whether you want to remove the input text form the result, as a boolean. Defaults to false.
1. `doSample`: Whether or not to use sampling ; use greedy decoding otherwise, as a boolean. Defaults to true.
1. `numBeams`: Number of beams for beam search. 1 means no beam search. This is an integer. Defaults to 1.
1. `earlyStopping`: Whether to stop the beam search when at least num_beams sentences are finished per batch or not, as a boolean. Defaults to false.
1. `noRepeatNgramSize`: If set to int > 0, all ngrams of that size can only occur once. This is an integer. Defaults to 0.
1. `numReturnSequences`: The number of independently computed returned sequences for each element in the batch, as an integer. Defaults to 1.
1. `topK`: The number of highest probability vocabulary tokens to keep for top-k-filtering, as an integer. Maximum 1000 tokens. Defaults to 0.
1. `topP`: If set to float < 1, only the most probable tokens with probabilities that add up to top_p or higher are kept for generation. This is a float. Should be between 0 and 1. Defaults to 0.7.
1. `temperature`: The value used to module the next token probabilities, as a float. Should be between 0 and 1. Defaults to 1.
1. `repetitionPenalty`: The parameter for repetition penalty, as a float. 1.0 means no penalty. Defaults to 1.0.
1. `lengthPenalty`: Exponential penalty to the length, as a float. 1.0 means no penalty. Set to values < 1.0 in order to encourage the model to generate shorter sequences, or to a value > 1.0 in order to encourage the model to produce longer sequences. Defaults to 1.0.
1. `badWords`: List of tokens that are not allowed to be generated, as an array of strings. Defaults to null.

```php
client->generation(<Your input text>, <your min length>, <your max length>, <your length no input>, <your end sequence>, <your remove input>, <your do sample>, <your num beams>,  <your early stopping>, <your no repeat ngram size>, <your num return sequences>, <your top k>, <your top p>, <your temperature>, <your repetition penalty>, <your length penalty>, array("bad word 1", "bad word 2", ...), <your remove end sequence>)
```

### Sentiment Analysis Endpoint

Call the `sentiment()` method and pass the text you want to analyze the sentiment of:

```php
client->sentiment("<Your block of text>")
```

The above command returns a JSON object.

### Question Answering Endpoint

Call the `question()` method and pass the following:

1. A context that the model will use to try to answer your question
1. Your question

```php
client->question("<Your context>", "<Your question>")
```

The above command returns a JSON object.

### Summarization Endpoint

Call the `summarization()` method and pass the text you want to summarize.

```php
client->summarization("<Your text to summarize>")
```

The above command returns a JSON object.

### Translation Endpoint

Call the `translation()` method and pass the text you want to translate.

```php
client->translation("<Your text to translate>")
```

The above command returns a JSON object.

### Language Detection Endpoint

Call the `langdetection()` method and pass the text you want to analyze.

```php
client->langdetection("<Text to analyze>")
```

The above command returns a JSON object.

### Semantic Similarity Endpoint

Call the `semanticSimilarity()` method and pass an array made up of 2 blocks of text that you want to compare.

```php
client.semanticSimilarity(array("<Block of text 1>", "<Block of text 2>"))
```

The above command returns a JSON object.

### Tokenization Endpoint

Call the `tokens()` method and pass the text you want to tokenize.

```php
$client->tokens("<Your block of text>")
```

The above command returns a JSON object.

### Dependencies Endpoint

Call the `dependencies()` method and pass the text you want to perform part of speech tagging (POS) + arcs on.

```php
$client->dependencies("<Your block of text>")
```

The above command returns a JSON object.

### Sentence Dependencies Endpoint

Call the `sentenceDependencies()` method and pass a block of text made up of several sentencies you want to perform POS + arcs on.

```php
$client->sentenceDependencies("<Your block of text>")
```

The above command returns a JSON object.

### Embeddings Endpoint

Call the `embeddings()` method and pass an array of blocks of text that you want to extract embeddings from.

```php
client.embeddings(array("<Text 1>", "<Text 2>", "<Text 3>", ...))
```

The above command returns a JSON object.

### Library Versions Endpoint

Call the `libVersions()` method to know the versions of the libraries used behind the hood with the model (for example the PyTorch, TensorFlow, and spaCy version used).

```php
$client->libVersions()
```

The above command returns a JSON object.
