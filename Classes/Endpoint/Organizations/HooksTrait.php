<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\Organizations;

use Cadoles\Gitea\Client;

/**
 * Organizations Hooks Trait
 */
trait HooksTrait
{
    public function getHooks(string $organization): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $organization . '/hooks');

        return $response->toArray();
    }

    public function createHook(
        string $organization,
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

        $response = $this->client->request(self::BASE_URI . '/' . $organization . '/hooks', 'POST', $options);

        return $response->toArray();
    }

    public function getHook(string $organization, int $id): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $organization . '/hooks/' . $id);

        return $response->toArray();
    }

    public function deleteHook(string $organization, int $id): bool
    {
        $this->client->request(self::BASE_URI . '/' . $organization . '/hooks/' . $id, 'DELETE');

        return true;
    }

    public function updateHook(
        string $organization,
        int $id,
        bool $active,
        ?string $branchFilter = null,
        ?array $config = null,
        ?array $events = null
    ): array
    {
        $options = [
            'json' => [
                'active' => $active,
                'branch_filter' => $branchFilter,
                'config' => $config,
                'events' => $events,
            ]
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $organization . '/hooks/' . $id, 'PATCH', $options);

        return $response->toArray();
    }
}
