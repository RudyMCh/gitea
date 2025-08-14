<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\Issues;

use Cadoles\Gitea\Client;

/**
 * Issues Subscriptions Trait
 */
trait SubscriptionsTrait
{
    public function getSubscriptions(string $owner, string $repositoryName, int $index): ?array
    {
        $response = $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/subscriptions'
        );

        return $response->toArray();
    }

    public function deleteSubscription(string $owner, string $repositoryName, int $index, string $username): bool
    {
        $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/subscriptions/' . $username,
            'DELETE'
        );

        return true;
    }

    public function addSubscription(string $owner, string $repositoryName, int $index, string $username): bool
    {
        $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/subscriptions/' . $username,
            'PUT'
        );

        return true;
    }
}
