<?php

namespace Awelty\Component\Loco;

use Awelty\Component\Loco\Client\ExportClient;
use Awelty\Component\Loco\Client\LocalesClient;
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

    private $client;

    private $serializer;

    /**
     * @var TagsClient
     */
    private $tags;

    /**
     * @var ExportClient
     */
    private $export;

    /**
     * @var LocalesClient
     */
    private $locales;

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

        $this->client = new HttpClient($guzzleOptions);
        $this->serializer = new Serializer([], [new JsonEncoder()]);
    }

    public function tags()
    {
        return $this->tags ?: $this->tags = new TagsClient($this->client, $this->serializer);
    }

    public function export()
    {
        return $this->export ?: $this->export = new ExportClient($this->client, $this->serializer);
    }

    public function locales()
    {
        return $this->locales ?: $this->locales = new LocalesClient($this->client, $this->serializer);
    }
}
