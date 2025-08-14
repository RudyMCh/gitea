<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\User;

use Cadoles\Gitea\Client;

/**
 * Users Repositories Trait
 */
trait RepositoriesTrait
{
    public function getRepositories(): array
    {
        $response = $this->client->request(self::BASE_URI . '/repos');

        return $response->toArray();
    }

    public function getStarredRepositories(): array
    {
        $response = $this->client->request(self::BASE_URI . '/starred');

        return $response->toArray();
    }

    public function checkStarredRepository(string $owner, string $repositoryName): bool
    {
        $this->client->request(self::BASE_URI . '/starred/' . $owner . '/' . $repositoryName);

        return true;
    }

    public function addStarredRepository(string $owner, string $repositoryName): bool
    {
        $this->client->request(self::BASE_URI . '/starred/' . $owner . '/' . $repositoryName, 'PUT');

        return true;
    }

    public function deleteStarredRepository(string $owner, string $repositoryName): bool
    {
        $this->client->request(self::BASE_URI . '/starred/' . $owner . '/' . $repositoryName, 'DELETE');

        return true;
    }

    public function getSubscriptions(): array
    {
        $response = $this->client->request(self::BASE_URI . '/subscriptions');

        return $response->toArray();
    }
}
