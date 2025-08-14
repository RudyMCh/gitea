<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\Users;

use Cadoles\Gitea\Client;

/**
 * Users Tokens Trait
 */
trait TokensTrait
{
    public function getTokens(string $username): array
    {
        $response = $this->client->request(self::BASE_URI . '/' .$username . '/tokens');

        return $response->toArray();
    }

    public function addToken(string $username, string $name): array
    {
        $options['json'] = [
            'name' => $name
        ];

        $response = $this->client->request(self::BASE_URI . '/' .$username . '/tokens', 'POST', $options);

        return $response->toArray();
    }

    public function deleteToken(string $username, int $token): bool
    {
        $this->client->request(self::BASE_URI . '/' .$username . '/tokens/' . $token, 'DELETE');

        return true;
    }
}
