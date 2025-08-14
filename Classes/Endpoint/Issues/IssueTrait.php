<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\Issues;

use Cadoles\Gitea\Client;

/**
 * Issues Issue Trait
 */
trait IssueTrait
{
    public function get(string $owner, string $repositoryName, int $index): array
    {
        $response = $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index
        );

        return $response->toArray();
    }

    public function update(
        string $owner,
        string $repositoryName,
        int $index,
        ?string $assignee = null,
        ?array $assignees = null,
        ?string $body = null,
        ?\DateTime $dueDate = null,
        ?int $milestone = null,
        ?string $state = null,
        ?string $title = null,
        ?bool $unsetDueDate = null
    ): array
    {
        $options =[
            'json'=> [
                'assignee' => $assignee,
                'assignees' => $assignees,
                'body' => $body,
                'due_date' => $dueDate?->format(\DateTime::ATOM),
                'mileston' => $milestone,
                'state' => $state,
                'title' => $title,
                'unset_due_date' => $unsetDueDate,
            ]
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index,
            'PATCH',
            $options
             );

        return $response->toArray();
    }

    public function setDeadline(
        string $owner,
        string $repositoryName,
        int $index,
        \DateTime $dueDate
    ): array
    {
        $options = [
            'json'=>[
            'due_date' => $dueDate->format(\DateTime::ATOM),
            ]
        ];

        $response = $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/deadline',
            'POST',
            $options);

        return $response->toArray();
    }
}
