<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\Issues;

use Cadoles\Gitea\Client;

/**
 * Issues Milestones Trait
 */
trait MilestonesTrait
{
    public function getMilestones(string $owner, string $repositoryName): array
    {
        $response = $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/milestones'
        );

        return $response->toArray();
    }

    public function addMilestone(
        string $owner,
        string $repositoryName,
        string $title,
        ?string $description = null,
        ?\DateTime $dueDate = null
    ): array
    {
        $options = [
            'json' => [
                'title' => $title,
                'description' => $description,
                'due_date' => $dueDate?->format(\DateTime::ATOM),
            ]
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/milestones',
            'POST',
            $options);

        return $response->toArray();
    }

    public function getMilestone(string $owner, string $repositoryName, int $id): array
    {
        $response = $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/milestones/' . $id
        );

        return $response->toArray();
    }

    public function deleteMilestone(string $owner, string $repositoryName, int $id): bool
    {
        $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/milestones/' . $id, 
            'DELETE'
        );

        return true;
    }

    public function updateMilestone(
        string $owner,
        string $repositoryName,
        int $id,
        ?string $title = null,
        ?string $description = null,
        ?\DateTime $dueDate = null,
        ?string $state = null
    ): array
    {
        $options =[
            'json'=> [
                'title' => $title,
                'description' => $description,
                'due_date' => $dueDate?->format(\DateTime::ATOM),
                'state' => $state,
            ]
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/milestones/' . $id,
            'PATCH',
            $options
        );

        return $response->toArray();
    }
}
