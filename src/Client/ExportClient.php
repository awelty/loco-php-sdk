<?php

namespace Awelty\Component\Loco\Client;

class ExportClient extends AbstractClient
{
    public function all($ext, $options = [])
    {
        $jsonResponse = $this->client->request('GET', 'export/all.'.$ext, [
            'query' => $options
        ]);

        return $jsonResponse->getBody()->getContents();
    }

    public function locale($locale, $ext, $options = [])
    {
        $jsonResponse = $this->client->request('GET', 'export/locale/'.$locale.'.'.$ext, [
            'query' => $options
        ]);

        return $jsonResponse->getBody()->getContents();
    }
}
