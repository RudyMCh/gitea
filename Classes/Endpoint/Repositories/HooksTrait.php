<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\Repositories;

use Cadoles\Gitea\Client;

/**
 * Repositories Hooks Trait
 */
trait HooksTrait
{
    public function getHooks(string $owner, string $repositoryName): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/hooks');

        return $response->toArray();
    }

    public function addHook(
        string $owner,
        string $repositoryName,
        string $type,
        array $config,
        ?bool $active = null,
        ?string $branchFilter = null,
        ?array $events = null
    ): array
    {
        $options['json'] = [
            'type' => $type,
            'config' => $config,
            'active' => $active,
            'branch_filter' => $branchFilter,
            'events' => $events,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/hooks', 'POST', $options);

        return $response->toArray();
    }

    public function getGitHooks(string $owner, string $repositoryName): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/hooks/git');

        return $response->toArray();
    }

    public function getGitHook(string $owner, string $repositoryName, int $id): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/hooks/git/' . $id);

        return $response->toArray();
    }

    public function deleteGitHook(string $owner, string $repositoryName, int $id): bool
    {
        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/hooks/git/' . $id, 'DELETE');

        return true;
    }

    public function updateGitHook(string $owner, string $repositoryName, int $id, string $content): array
    {
        $options['json'] = [
            'content' => $content
        ];

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/hooks/git/' . $id, 'PATCH', $options);

        return $response->toArray();
    }

    public function getHook(string $owner, string $repositoryName, int $id): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/hooks/' . $id);

        return $response->toArray();
    }

    public function deleteHook(string $owner, string $repositoryName, int $id): bool
    {
        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/hooks/' . $id, 'DELETE');

        return true;
    }

    public function updateHook(
        string $owner,
        string $repositoryName,
        int $id,
        ?array $config = null,
        ?bool $active = null,
        ?string $branchFilter = null,
        ?array $events = null
    ): array
    {
        $options['json'] = [
            'config' => $config,
            'active' => $active,
            'branch_filter' => $branchFilter,
            'events' => $events,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/hooks/' . $id, 'PATCH', $options);

        return $response->toArray();
    }

    public function testHook(
        string $owner,
        string $repositoryName,
        int $id
    ): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/hooks/' . $id . '/tests', 'POST');

        return $response->toArray();
    }
}
