<?php

namespace Awelty\Component\Loco\Client;

class TagsClient extends AbstractClient
{
    public function getTags()
    {
        $jsonResponse = $this->client->request('GET', 'tags.json');

        return $this->serializer->decode($jsonResponse->getBody(), 'json');
    }
}
