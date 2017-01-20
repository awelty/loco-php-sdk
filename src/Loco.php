<?php

namespace Awelty\Component\Loco;

use Awelty\Component\Loco\Client\ExportClient;
use Awelty\Component\Loco\Client\TagsClient;
use Awelty\Component\Security\MiddlewareProvider;
use Awelty\Component\Security\SignatureProviderInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client as HttpClient;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;

class Loco
{
    const BASE_URI = 'https://localise.biz/api/';

    /**
     * @var TagsClient
     */
    public $tags;

    /**
     * @var ExportClient
     */
    public $export;

    public function __construct(SignatureProviderInterface $signatureProvider, $guzzleOptions = [])
    {
        // Handler
        //---------
        $handler = !empty($guzzleOptions['handler']) ? $guzzleOptions['handler'] : HandlerStack::create();
        $handler->push(MiddlewareProvider::signRequestMiddleware($signatureProvider));

        $guzzleOptions['handler'] = $handler;

        // set a base_uri if not provided
        //--------------------------------
        if (empty($guzzleOptions['base_uri'])) {
            $guzzleOptions['base_uri'] = self::BASE_URI;
        }

        // Création des clients
        //----------------------
        $serializer = new Serializer([], [new JsonEncoder()]);
        $client = new HttpClient($guzzleOptions);

        $this->tags = new TagsClient($client, $serializer);
        $this->export = new ExportClient($client, $serializer);
    }
}
