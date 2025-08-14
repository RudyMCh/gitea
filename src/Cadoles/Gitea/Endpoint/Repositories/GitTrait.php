<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\Repositories;

use Cadoles\Gitea\Client;

/**
 * Repositories Git Trait
 */
trait GitTrait
{
    public function getBlob(string $owner, string $repositoryName, string $sha): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/git/blobs/' . $sha);

        return $response->toArray();
    }

    public function getCommit(string $owner, string $repositoryName, string $sha): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/git/commits/' . $sha);

        return $response->toArray();
    }

    public function getRefs(string $owner, string $repositoryName): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/git/refs');

        return $response->toArray();
    }

    public function getRef(string $owner, string $repositoryName, string $ref): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/git/refs/' . $ref);

        return $response->toArray();
    }

    public function getTag(string $owner, string $repositoryName, string $sha): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/git/tags/' . $sha);

        return $response->toArray();
    }

    public function getTree(
        string $owner,
        string $repositoryName,
        string $sha,
        ?bool $recursive = null,
        ?int $page = null,
        ?int $perPage = null
    ): array
    {
        $options['query'] = [
            'recursive' => $recursive,
            'page' => $page,
            'per_page' => $perPage,
        ];
        $options['query'] = $this->removeNullValues($options['query']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/git/trees/' . $sha, 'GET', $options);

        return $response->toArray();
    }
}
