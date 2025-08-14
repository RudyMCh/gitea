<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\Repositories;

use Cadoles\Gitea\Client;

/**
 * Repositories Branches Trait
 */
trait BranchesTrait
{
    public function getBranches(string $owner, string $repositoryName): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/branches');

        return $response->toArray();
    }

    public function getBranche(string $owner, string $repositoryName, string $branch): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/branches/' . $branch);

        return $response->toArray();
    }
}
