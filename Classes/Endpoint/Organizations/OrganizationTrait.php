<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\Organizations;

use Cadoles\Gitea\Client;

/**
 * Organizations Organization Trait
 */
trait OrganizationTrait
{
    public function get(string $organization): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $organization);

        return $response->toArray();
    }

    public function create(
        string $username,
        ?string $description = null,
        ?string $fullName = null,
        ?string $location = null,
        ?bool $repoAdminChangeTeamAccess = null,
        ?string $visibility = null, // public, limited, private
        ?string $website = null
    ): array
    {
        $options['json'] = [
            'username' => $username,
            'description' => $description,
            'full_name' => $fullName,
            'location' => $location,
            'repo_admin_change_team_access' => $repoAdminChangeTeamAccess,
            'visibility' => $visibility,
            'website' => $website,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI, 'POST', $options);

        return $response->toArray();
    }

    public function delete(string $organization): bool
    {
        $this->client->request(self::BASE_URI . '/' . $organization, 'DELETE');

        return true;
    }

    public function update(
        string $organization,
        ?string $description = null,
        ?string $fullName = null,
        ?string $location = null,
        ?bool $repoAdminChangeTeamAccess = null,
        ?string $visibility = null, // public, limited, private
        ?string $website = null
    ): array
    {
        $options['json'] = [
            'description' => $description,
            'full_name' => $fullName,
            'location' => $location,
            'repo_admin_change_team_access' => $repoAdminChangeTeamAccess,
            'visibility' => $visibility,
            'website' => $website,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $organization, 'PATCH', $options);

        return $response->toArray();
    }
}
