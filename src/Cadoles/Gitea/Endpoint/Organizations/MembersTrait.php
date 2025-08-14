<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\Organizations;

use Cadoles\Gitea\Client;

/**
 * Organizations Members Trait
 */
trait MembersTrait
{
    public function getMembers(string $organization): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $organization . '/members');

        return $response->toArray();
    }

    public function checkMember(string $organization, string $username): bool
    {
        $this->client->request(self::BASE_URI . '/' . $organization . '/members/' . $username);

        return true;
    }

    public function deleteMember(string $organization, string $username): bool
    {
        $this->client->request(self::BASE_URI . '/' . $organization . '/members/' . $username, 'DELETE');

        return true;
    }

    public function getPublicMembers(string $organization): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $organization . '/public_members');

        return $response->toArray();
    }

    public function checkPublicMember(string $organization, string $username): bool
    {
        $this->client->request(self::BASE_URI . '/' . $organization . '/public_members/' . $username);

        return true;
    }

    public function addPublicMember(string $organization, string $username): bool
    {
        $this->client->request(self::BASE_URI . '/' . $organization . '/public_members/' . $username, 'PUT');

        return true;
    }

    public function deletePublicMember(string $organization, string $username): bool
    {
        $this->client->request(self::BASE_URI . '/' . $organization . '/public_members/' . $username, 'DELETE');

        return true;
    }
}
