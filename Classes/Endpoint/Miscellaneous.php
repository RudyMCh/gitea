<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint;

use Cadoles\Gitea\Client;

/**
 * Miscellaneous endpoint
 */
class Miscellaneous extends AbstractEndpoint implements EndpointInterface
{
    private const BASE_URI = '';

    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function markdown(
        ?string $text = null, 
        ?string $context = null, 
        ?string $mode = null,
        bool $wiki = true
    ): string
    {
        $payload = [
            'context' => $context,
            'mode'    => $mode,
            'text'    => $text,
            'wiki'    => $wiki, // on ne l'enlève jamais
        ];
        $options['json'] = $this->removeNullValues($payload);

        $response = $this->client->request(self::BASE_URI . '/markdown', 'POST', $options);
        $statusCode = $response->getStatusCode();
        $content    = $response->getContent(false); // false = ne pas lever d'exception sur 4xx/5xx
    
        if ($statusCode >= 400) {
            throw new \RuntimeException(
                sprintf('Erreur HTTP %d lors de l’appel Markdown : %s', $statusCode, $content)
            );
        }
        
        return $content;
    }

    public function markdownRaw(string $text): string
    {
        $options['body'] = $text;
        $response = $this->client->request(self::BASE_URI . '/markdown/raw', 'POST', $options);

        return $response->getContent(false);
    }


    public function signingKeyGPG(): string
    {
        $response = $this->client->request(self::BASE_URI . '/signing-key.gpg');
        return $response->getContent(false);
    }

    public function version(): string
    {
        $response = $this->client->request(self::BASE_URI . '/version');

        return $response->toArray()['version'];
    }
}
