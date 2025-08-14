<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\Repositories;

use Cadoles\Gitea\Client;

/**
 * Repositories Forks Trait
 */
trait ForksTrait
{
    public function getForks(string $owner, string $repositoryName): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/forks');

        return $response->toArray();
    }

    public function createFork(string $owner, string $repositoryName, ?string $organization = null): array
    {
        $options['json'] = [
            'organization' => $organization
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/forks', 'POST', $options);

        return $response->toArray();
    }
}
