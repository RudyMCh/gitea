<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\Repositories;

use Cadoles\Gitea\Client;

/**
 * Repositories Collaborators Trait
 */
trait CollaboratorsTrait
{
    public function getCollaborators(string $owner, string $repositoryName): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/collaborators');

        return $response->toArray();
    }

    public function checkCollaborator(string $owner, string $repositoryName, string $collaborator): bool
    {
        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/collaborators/' . $collaborator);

        return true;
    }

    public function addCollaborator(string $owner, string $repositoryName, string $collaborator, string $permission = 'write'): bool
    {
        $options['json'] = [
            'permission' => $permission
        ];

        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/collaborators/' . $collaborator, 'PUT', $options);

        return true;
    }

    public function deleteCollaborator(string $owner, string $repositoryName, string $collaborator): bool
    {
        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/collaborators/' . $collaborator, 'DELETE');

        return true;
    }
}
