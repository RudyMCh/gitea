<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\Issues;

use Cadoles\Gitea\Client;

/**
 * Issues Reactions Trait
 */
trait ReactionsTrait
{
    public function getReactions(string $owner, string $repositoryName, int $index): ?array
    {
        $response = $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/reactions'
        );

        return $response->toArray();
    }

    public function deleteReaction(string $owner, string $repositoryName, int $index, string $reaction): bool
    {
        $options = [
            'json' => [
                'content' => $reaction
            ]
        ];

        $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/reactions',
            'DELETE',
            $options
        );

        return true;
    }

    public function addReaction(string $owner, string $repositoryName, int $index, string $reaction): array
    {
        $options['json'] = [
            'content' => $reaction
        ];

        $response = $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/reactions',
            'POST',
            $options
        );

        return $response->toArray();
    }
}
