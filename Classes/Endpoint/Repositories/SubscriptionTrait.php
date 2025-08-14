<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\Repositories;

use Cadoles\Gitea\Client;

/**
 * Repositories Subscription Trait
 */
trait SubscriptionTrait
{
    public function getSubscribers(string $owner, string $repositoryName): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/subscribers');

        return $response->toArray();
    }

    public function checkSubscription(string $owner, string $repositoryName): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/subscription');

        return $response->toArray();
    }

    public function addSubscription(string $owner, string $repositoryName): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/subscription', 'PUT');

        return $response->toArray();
    }

    public function deleteSubscription(string $owner, string $repositoryName): bool
    {
        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/subscription', 'DELETE');

        return true;
    }
}
