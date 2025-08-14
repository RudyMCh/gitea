<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\Issues;

use Cadoles\Gitea\Client;

/**
 * Issues Issues Trait
 */
trait IssuesTrait
{
    public function search(
        ?string $searchTerm = null,
        ?string $state = null,
        ?string $labels = null,
        ?int $page = null,
        ?int $priorityRepoId = null
    ): array
    {
        $options['query'] = [
            'q' => $searchTerm,
            'state' => $state,
            'labels' => $labels,
            'page' => $page,
            'priority_repo_id' => $priorityRepoId,
        ];
        $options['query'] = $this->removeNullValues($options['query']);

        $response = $this->client->request(self::BASE_URI . '/issues/search', 'GET', $options);

        return $response->toArray();
    }

    public function getIssues(string $owner, string $repositoryName): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues');

        return $response->toArray();
    }

    public function create(
        string $owner,
        string $repositoryName,
        string $title,
        ?string $assignee = null,
        ?array $assignees = null,
        ?string $body = null,
        ?bool $closed = null,
        ?\Datetime $dueDate = null,
        ?array $labels = null,
        ?int $milestone = null
    ): array
    {
        $options['json'] = [
            'title' => $title,
            'assignee' => $assignee,
            'assignees' => $assignees,
            'body' => $body,
            'closed' => $closed,
            'due_date' => $dueDate ? $dueDate->format(\DateTime::ATOM) : null,
            'labels' => $labels,
            'milestone' => $milestone,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues', 'POST', $options);

        return $response->toArray();
    }
}
