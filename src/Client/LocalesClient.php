<?php

namespace Awelty\Component\Loco\Client;

class LocalesClient extends AbstractClient
{
    public function getLocales()
    {
        $jsonResponse = $this->client->request('GET', 'locales');

        return $this->serializer->decode($jsonResponse->getBody(), 'json');
    }
}
