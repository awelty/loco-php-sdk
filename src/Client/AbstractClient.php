<?php

namespace Awelty\Component\Loco\Client;

use GuzzleHttp\Client;
use Symfony\Component\Serializer\Serializer;

class AbstractClient
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var Serializer
     */
    protected $serializer;

    /**
     * @param Client $client
     * @param Serializer $serializer
     */
    public function __construct(Client $client, Serializer $serializer)
    {
        $this->client = $client;
        $this->serializer = $serializer;
    }
}
