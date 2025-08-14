<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\User;

use Cadoles\Gitea\Client;

/**
 * Users Followers Trait
 */
trait FollowersTrait
{
    public function getFollowers(): array
    {
        $response = $this->client->request(self::BASE_URI . '/followers');

        return $response->toArray();
    }

    public function getFollowing(): array
    {
        $response = $this->client->request(self::BASE_URI . '/following');

        return $response->toArray();
    }

    public function checkFollowing(string $username): bool
    {
        $this->client->request(self::BASE_URI . '/following/' . $username);

        return true;
    }

    public function addFollowing(string $username): bool
    {
        $this->client->request(self::BASE_URI . '/following/' . $username, 'PUT');

        return true;
    }

    public function deleteFollowing(string $username): bool
    {
        $this->client->request(self::BASE_URI . '/following/' . $username, 'DELETE');

        return true;
    }
}
