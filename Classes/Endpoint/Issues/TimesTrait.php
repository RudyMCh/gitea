<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\Issues;

use Cadoles\Gitea\Client;

/**
 * Issues Times Trait
 */
trait TimesTrait
{
    public function getTimes(string $owner, string $repositoryName, int $index): ?array
    {
        $response = $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/times'
        );

        return $response->toArray();
    }

    public function deleteAllTimes(string $owner, string $repositoryName, int $index): bool
    {
        $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/times',
            'DELETE'
        );

        return true;
    }

    public function deleteTime(string $owner, string $repositoryName, int $index, int $id): bool
    {
        $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/times/' . $id,
            'DELETE'
        );

        return true;
    }

    public function addTime(
        string $owner,
        string $repositoryName,
        int $index,
        int $time,
        ?string $username = null,
        ?\DateTime $createdDate = null
    ): array
    {
        $options = [
            'json' => [
                'time' => $time,
                'user_name' => $username,
                'created' => $createdDate?->format(\DateTime::ATOM),
            ]
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/times',
            'POST',
            $options
        );

        return $response->toArray();
    }
}
