<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\Repositories;

use Cadoles\Gitea\Client;

/**
 * Repositories Statuses Trait
 */
trait StatusesTrait
{
    public function getStatuses(
        string $owner,
        string $repositoryName,
        string $sha,
        ?int $page = null,
        ?int $sort = null,
        ?int $state = null
    ): array
    {
        $options['query'] = [
            'page' => $page,
            'sort' => $sort,
            'state' => $state,
        ];
        $options['query'] = $this->removeNullValues($options['query']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/statuses/' . $sha, 'GET', $options);

        return $response->toArray();
    }

    public function createStatus(
        string $owner,
        string $repositoryName,
        string $sha,
        string $state,
        ?string $description = null,
        ?string $context = null,
        ?string $targetUrl = null
    ): array
    {
        $options['json'] = [
            'state' => $state,
            'description' => $description,
            'context' => $context,
            'target_url' => $targetUrl,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/statuses/' . $sha, 'POST', $options);

        return $response->toArray();
    }
}
