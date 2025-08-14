<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\Repositories;

use Cadoles\Gitea\Client;

/**
 * Repositories Keys Trait
 */
trait KeysTrait
{
    public function getKeys(string $owner, string $repositoryName, ?int $keyId = null, ?string $fingerprint = null): array
    {
        $options['query'] = [
            'key_id' => $keyId,
            'fingerprint' => $fingerprint
        ];
        $options['query'] = $this->removeNullValues($options['query']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/keys', 'GET', $options);

        return $response->toArray();
    }

    public function addKey(
        string $owner,
        string $repositoryName,
        string $title,
        string $key,
        ?bool $readOnly = null
    ): array
    {
        $options['json'] = [
            'title' => $title,
            'key' => $key,
            'read_only' => $readOnly,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/keys', 'POST', $options);
        return $response->toArray();
    }

    public function getKey(string $owner, string $repositoryName, int $keyId): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/keys/' . $keyId);

        return $response->toArray();
    }

    public function deleteKey(string $owner, string $repositoryName, int $keyId): bool
    {
        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/keys/' . $keyId, 'DELETE');

        return true;
    }
}
