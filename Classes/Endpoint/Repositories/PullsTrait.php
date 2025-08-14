<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\Repositories;

use Cadoles\Gitea\Client;

/**
 * Repositories Pulls Trait
 */
trait PullsTrait
{
    public function getPulls(
        string $owner,
        string $repositoryName,
        ?int $page = null,
        ?string $state = null,
        ?string $sort = null,
        ?int $milestone = null,
        ?array $lables = null
    ): array
    {
        $options['query'] = [
            'page' => $page,
            'state' => $state,
            'sort' => $sort,
            'milestone' => $milestone,
            'lables' => $lables,
        ];
        $options['query'] = $this->removeNullValues($options['query']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/pulls', 'GET', $options);

        return $response->toArray();
    }

    public function createPull(
        string $owner,
        string $repositoryName,
        string $assignee,
        string $base,
        string $head,
        string $title,
        ?array $assignees = null,
        ?string $body = null,
        ?\DateTime $dueDate = null,
        ?array $labels = null,
        ?int $milestone = null
    ): array
    {
        $options['json'] = [
            'assignee' => $assignee,
            'base' => $base,
            'head' => $head,
            'assignees' => $assignees,
            'title' => $title,
            'body' => $body,
            'due_date' => $dueDate?->format(\DateTime::ATOM),
            'labels' => $labels,
            'milestone' => $milestone,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/pulls', 'POST', $options);

        return $response->toArray();
    }

    public function getPull(
        string $owner,
        string $repositoryName,
        int $index
    ): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/pulls/' . $index, 'GET');

        return $response->toArray();
    }

    public function updatePull(
        string $owner,
        string $repositoryName,
        int $index,
        ?string $assignee = null,
        ?string $title = null,
        ?string $state = null,
        ?array $assignees = null,
        ?string $body = null,
        ?\DateTime $dueDate = null,
        ?bool $unsetDueDate = null,
        ?array $labels = null,
        ?int $milestone = null
    ): array
    {
        $options['json'] = [
            'assignee' => $assignee,
            'assignees' => $assignees,
            'title' => $title,
            'state' => $state,
            'body' => $body,
            'due_date' => $dueDate?->format(\DateTime::ATOM),
            'unsetDueDate' => $unsetDueDate,
            'labels' => $labels,
            'milestone' => $milestone,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/pulls/' . $index, 'PATCH', $options);

        return $response->toArray();
    }

    public function checkMerged(
        string $owner,
        string $repositoryName,
        int $index
    ): bool
    {
        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/pulls/' . $index . '/merge', 'GET');

        return true;
    }

    public function mergePull(
        string $owner,
        string $repositoryName,
        int $index,
        string $do,
        ?string $mergeMessage = null,
        ?string $mergeTitle = null
    ): bool
    {
        $options['json'] = [
            'Do' => $do,
            'MergeMessageField' => $mergeMessage,
            'MergeTitleField' => $mergeTitle,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/pulls/' . $index . '/merge', 'POST', $options);

        return true;
    }
}
