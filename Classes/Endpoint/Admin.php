<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint;

use Cadoles\Gitea\Client;

/**
 * Admin endpoint
 */
class Admin extends AbstractEndpoint implements EndpointInterface
{
    const BASE_URI = '/admin';

    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getOrgs(?int $page = null, ?int $limit = null): array
    {
        $options['query'] = [
            'page' => $page,
            'limit' => $limit,
        ];
        $options['query'] = $this->removeNullValues($options['query']);

        $response = $this->client->request(self::BASE_URI . '/orgs', 'GET', $options);

        return $response->toArray();
    }

    public function getUsers(): array
    {
        $response = $this->client->request(self::BASE_URI . '/users');

        return $response->toArray();
    }

    public function createUser(
        string $username,
        string $password,
        string $email,
        ?string $fullName = null,
        ?string $loginName = null,
        ?bool $mustChangePassword = true,
        ?bool $sendNotify = true,
        ?int $sourceId = null
    ): array
    {
        $options['json'] = [
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'full_name' => $fullName,
            'login_name' => $loginName,
            'must_change_password' => $mustChangePassword,
            'send_notify' => $sendNotify,
            'source_id' => $sourceId,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/users', 'POST', $options);

        return $response->toArray();
    }

    public function updateUser(
        string $username,
        string $email,
        ?string $password = null,
        ?bool $active = null,
        ?bool $admin = null,
        ?bool $allowCreateOrganization = null,
        ?bool $allowGitHook = null,
        ?bool $allowImportLocal = null,
        ?string $fullName = null,
        ?string $location = null,
        ?string $loginName = null,
        ?int $maxRepoCreation = null,
        ?bool $mustChangePassword = null,
        ?bool $prohibitLogin = null,
        ?int $sourceId = null,
        ?string $website = null
    ): array
    {
        $options['json'] = [
            'email' => $email,
            'password' => $password,
            'active' => $active,
            'admin' => $admin,
            'allow_create_organization' => $allowCreateOrganization,
            'allow_git_hook' => $allowGitHook,
            'allow_import_local' => $allowImportLocal,
            'full_name' => $fullName,
            'location' => $location,
            'login_name' => $loginName,
            'max_repo_creation' => $maxRepoCreation,
            'must_change_password' => $mustChangePassword,
            'prohibit_login' => $prohibitLogin,
            'source_id' => $sourceId,
            'website' => $website,
        ];
        $options['json'] = $this->removeNullValues($options['json']);
        $response = $this->client->request(self::BASE_URI . '/users/' . $username, 'PATCH', $options);

        return $response->toArray();
    }

    public function deleteUser(string $username): bool
    {
        $this->client->request(self::BASE_URI . '/users/' . $username, 'DELETE');
        return true;
    }

    public function addKeyToUser(
        string $username,
        string $title,
        string $key,
        ?bool $readOnly = null
    ): array
    {
        $options['json'] = [
            'title' => $title,
            'key' => $key,
            'read_only' => $readOnly,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/users/' . $username . '/keys', 'POST', $options);
        return $response->toArray();
    }

    public function deleteKeyFromUser(
        string $username,
        int $id
    ): bool
    {
        $this->client->request(self::BASE_URI . '/users/' . $username . '/keys/' . $id, 'DELETE');
        return true;
    }

    public function createOrgWithUser(
        string $username,
        string $orgUsername,
        ?string $description = null,
        ?string $fullName = null,
        ?string $location = null,
        ?bool $repoAdminChangeTeamAccess = null,
        ?string $visibility = null,
        ?string $website = null
    ): array
    {
        $options['json'] = [
            'username' => $orgUsername,
            'description' => $description,
            'full_name' => $fullName,
            'location' => $location,
            'repo_admin_change_team_access' => $repoAdminChangeTeamAccess,
            'visibility' => $visibility,
            'website' => $website,
        ];
        $options['json'] = $this->removeNullValues($options['json']);
        $response = $this->client->request(self::BASE_URI . '/users/' . $username . '/orgs', 'POST', $options);

        return $response->toArray();
    }

    public function createUserRepository(
        string $username,
        string $repoName,
        ?bool $auto_init = null,
        ?string $description = null,
        ?string $gitignores = null,
        ?string $issue_labels = null,
        ?string $license = null,
        ?bool $private = null,
        ?string $readme = null
    ): array
    {
        $options['json'] = [
            'name' => $repoName,
            'auto_init' => $auto_init,
            'description' => $description,
            'gitignores' => $gitignores,
            'issue_labels' => $issue_labels,
            'license' => $license,
            'private' => $private,
            'readme' => $readme,
        ];
        $options['json'] = $this->removeNullValues($options['json']);
        $response = $this->client->request(self::BASE_URI . '/users/' . $username . '/repos', 'POST', $options);

        return $response->toArray();
    }
}
