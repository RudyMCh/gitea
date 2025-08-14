<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\Organizations;

use Cadoles\Gitea\Client;

/**
 * Organizations Repositories Trait
 */
trait RepositoriesTrait
{
    public function getRepos(string $organization): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $organization . '/repos');

        return $response->toArray();
    }

    public function createRepo(
        string $organization,
        string $name,
        ?bool $autoInit = null,
        ?string $description = null,
        ?string $gitignores = null,
        ?string $issueLabels = null,
        ?string $license = null,
        ?bool $private = null,
        ?string $readme = null
    ): array
    {
        $options['json'] = [
            'name' => $name,
            'auto_init' => $autoInit,
            'description' => $description,
            'gitignores' => $gitignores,
            'issue_labels' => $issueLabels,
            'license' => $license,
            'private' => $private,
            'readme' => $readme,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request('/org/' . $organization . '/repos', 'POST', $options);

        return $response->toArray();
    }
}
