<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\Users;

use Cadoles\Gitea\Client;

/**
 * Users Users Trait
 */
trait UsersTrait
{
    public function get(string $username): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $username);

        return $response->toArray();
    }

    public function search(string $searchTerm, ?int $id = null, ?int $limit = null): array
    {
        $options['query'] = [
            'q' => $searchTerm,
            'id' => $id,
            'limit' => $limit,
        ];
        $options['query'] = $this->removeNullValues($options['query']);

        $response = $this->client->request(self::BASE_URI . '/search', 'GET', $options);

        return $response->toArray();
    }

    public function checkFollowing(string $username, string $followee): bool
    {
        $this->client->request(self::BASE_URI . '/' . $username . '/following/' . $followee);

        return true;
    }

    public function getFollowers(string $username): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $username . '/followers');

        return $response->toArray();
    }

    public function getFollowing(string $username): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $username . '/following');

        return $response->toArray();
    }

    public function getGPGKeys(string $username): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $username . '/gpg_keys');

        return $response->toArray();
    }

    public function getHeatmap(string $username): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $username . '/heatmap');

        return $response->toArray();
    }

    public function getKeys(string $username): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $username . '/keys');

        return $response->toArray();
    }

    public function getRepositories(string $username): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $username . '/repos');

        return $response->toArray();
    }

    public function getStarred(string $username): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $username . '/starred');

        return $response->toArray();
    }

    public function getSubscriptions(string $username): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $username . '/subscriptions');

        return $response->toArray();
    }

    public function getTimes(string $username, string $owner, string $repositoryName): array
    {
        $response = $this->client->request('/repos/' . $owner . '/' . $repositoryName . '/times/' . $username);

        return $response->toArray();
    }
}
