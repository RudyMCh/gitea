<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\Repositories;

use Cadoles\Gitea\Client;

/**
 * Repositories Commits Trait
 */
trait CommitsTrait
{
    public function getCommits(
        string $owner,
        string $repositoryName,
        ?string $sha = null,
        ?int $page = null
    ): array
    {
        $options['query'] = [
            'sha' => $sha,
            'page' => $page
        ];
        $options['query'] = $this->removeNullValues($options['query']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/commits', 'GET', $options);

        return $response->toArray();
    }

    public function getCommitStatuses(
        string $owner,
        string $repositoryName,
        string $ref,
        ?int $page = null
    ): array
    {
        $options['query'] = [
            'page' => $page
        ];
        $options['query'] = $this->removeNullValues($options['query']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/commits/' . $ref . '/statuses', 'GET', $options);

        return $response->toArray();
    }
}
