<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\Repositories;

use Cadoles\Gitea\Client;

/**
 * Repositories Topics Trait
 */
trait TopicsTrait
{
    public function getTopics(string $owner, string $repositoryName): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/topics');

        return $response->toArray();
    }

    public function replaceTopics(string $owner, string $repositoryName, array $topics): bool
    {
        $options['json'] = [
            'topics' => $topics
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/topics', 'PUT', $options);

        return true;
    }

    public function addTopic(string $owner, string $repositoryName, string $topic): bool
    {
        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/topics/' . $topic, 'PUT');

        return true;
    }

    public function deleteTopic(string $owner, string $repositoryName, string $topic): bool
    {
        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/topics/' . $topic, 'DELETE');

        return true;
    }
}
