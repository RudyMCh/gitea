<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\Organizations;

use Cadoles\Gitea\Client;

/**
 * Organizations Users Trait
 */
trait UsersTrait
{
    public function getCurrentUserOrganizations(): array
    {
        $response = $this->client->request('/user/orgs');

        return $response->toArray();
    }

    public function getUserOrganizations(string $username): array
    {
        $response = $this->client->request('/users/' . $username . '/orgs');

        return $response->toArray();
    }
}
