<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\Organizations;

use Cadoles\Gitea\Client;

/**
 * Organizations Teams Trait
 */
trait TeamsTrait
{
    public function getTeams(string $organization): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $organization . '/teams');

        return $response->toArray();
    }

    public function createTeam(
        string $organization,
        string $name,
        ?bool $canCreateOrgRepo = null,
        ?string $description = null,
        ?bool $includesAllRepositories = null,
        ?string $permission = null, // read, write, admin
        ?array $units = null // repo.code, repo.issues, repo.ext_issues, repo.wiki, repo.pulls, repo.releases, repo.ext_wiki
    ): array
    {
        $options['json'] = [
            'name' => $name,
            'can_create_org_repo' => $canCreateOrgRepo,
            'description' => $description,
            'includes_all_repositories' => $includesAllRepositories,
            'permission' => $permission,
            'units' => $units,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $organization . '/teams', 'POST', $options);

        return $response->toArray();
    }

    public function searchTeams(
        string $organization,
        string $searchTerm,
        ?bool $includeDesc = null,
        ?int $limit = null,
        ?int $page = null
    ): array
    {
        $options['query'] = [
            'searchTerm' => $searchTerm,
            'includeDesc' => $includeDesc,
            'limit' => $limit,
            'page' => $page,
        ];
        $options['query'] = $this->removeNullValues($options['query']);

        $response = $this->client->request(self::BASE_URI . '/' . $organization . '/teams/search', 'GET', $options);

        return $response->toArray();
    }

    public function getTeam(int $id): array
    {
        $response = $this->client->request('/teams/' . $id);

        return $response->toArray();
    }

    public function deleteTeam(int $id): bool
    {
        $this->client->request('/teams/' . $id, 'DELETE');

        return true;
    }

    public function updateTeam(
        int $id,
        string $name,
        ?bool $canCreateOrgRepo = null,
        ?string $description = null,
        ?bool $includesAllRepositories = null,
        ?string $permission = null, // read, write, admin
        ?array $units = null // repo.code, repo.issues, repo.ext_issues, repo.wiki, repo.pulls, repo.releases, repo.ext_wiki
    ): array
    {
        $options['json'] = [
            'name' => $name,
            'can_create_org_repo' => $canCreateOrgRepo,
            'description' => $description,
            'includes_all_repositories' => $includesAllRepositories,
            'permission' => $permission,
            'units' => $units,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request('/teams/' . $id, 'PATCH', $options);

        return $response->toArray();
    }

    public function getTeamMembers(int $id): array
    {
        $response = $this->client->request('/teams/' . $id . '/members');

        return $response->toArray();
    }

    public function getTeamMember(int $id, string $username): array
    {
        $response = $this->client->request('/teams/' . $id . '/members/' . $username);

        return $response->toArray();
    }

    public function addTeamMember(int $id, string $username): bool
    {
        $this->client->request('/teams/' . $id . '/members/' . $username, 'PUT');

        return true;
    }

    public function deleteTeamMember(int $id, string $username): bool
    {
        $this->client->request('/teams/' . $id . '/members/' . $username, 'DELETE');

        return true;
    }

    public function getTeamRepositories(int $id): array
    {
        $response = $this->client->request('/teams/' . $id . '/repos');

        return $response->toArray();
    }

    public function addTeamRepository(int $id, $organization, $repositoryName): bool
    {
        $this->client->request('/teams/' . $id . '/repos/' . $organization . '/' . $repositoryName, 'PUT');

        return true;
    }

    public function deleteTeamRepository(int $id, $organization, $repositoryName): bool
    {
        $this->client->request('/teams/' . $id . '/repos/' . $organization . '/' . $repositoryName, 'DELETE');

        return true;
    }
}
