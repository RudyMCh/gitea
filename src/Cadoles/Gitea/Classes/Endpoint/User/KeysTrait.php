<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\User;

use Cadoles\Gitea\Client;

/**
 * Users Keys Trait
 */
trait KeysTrait
{
    public function getGPGKeys(): array
    {
        $response = $this->client->request(self::BASE_URI . '/gpg_keys');

        return $response->toArray();
    }

    public function addGPGKey(string $key): array
    {
        $options['json'] = [
            'armored_public_key' => $key
        ];

        $response = $this->client->request(self::BASE_URI . '/gpg_keys', 'POST', $options);

        return $response->toArray();
    }

    public function getGPGKey(int $id): array
    {
        $response = $this->client->request(self::BASE_URI . '/gpg_keys/' . $id);

        return $response->toArray();
    }

    public function deleteGPGKey(int $id): bool
    {
        $this->client->request(self::BASE_URI . '/gpg_keys/' . $id, 'DELETE');

        return true;
    }

    public function getKeys(): array
    {
        $response = $this->client->request(self::BASE_URI . '/keys');

        return $response->toArray();
    }

    public function addKey(string $title, string $key, bool $readOnly = null): array
    {
        $options['json'] = [
            'key' => $key,
            'read_only' => $readOnly,
            'title' => $title,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/keys', 'POST', $options);

        return $response->toArray();
    }

    public function getKey(int $id): array
    {
        $response = $this->client->request(self::BASE_URI . '/keys/' . $id);

        return $response->toArray();
    }

    public function deleteKey(int $id): bool
    {
        $this->client->request(self::BASE_URI . '/keys/' . $id, 'DELETE');

        return true;
    }
}
