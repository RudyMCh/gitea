<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\Issues;

use Cadoles\Gitea\Client;

trait CommentsTrait
{
    public function getComments(string $owner, string $repositoryName): array
    {
        $response = $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/comments'
        );

        return $response->toArray();
    }

    public function deleteComment(string $owner, string $repositoryName, int $id): bool
    {
        $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/comments/' . $id,
            'DELETE'
        );

        return true;
    }

    public function updateComment(string $owner, string $repositoryName, int $id, string $body): array
    {
        $response = $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/comments/' . $id,
            'PATCH',
            ['json' => ['body' => $body]]
        );

        return $response->toArray();
    }

    public function getCommentReactions(string $owner, string $repositoryName, int $id): array
    {
        $response = $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/comments/' . $id . '/reactions'
        );

        return $response->toArray();
    }

    public function addCommentReaction(string $owner, string $repositoryName, int $id, string $reaction): array
    {
        $response = $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/comments/' . $id . '/reactions',
            'POST',
            ['json' => ['content' => $reaction]]
        );

        return $response->toArray();
    }

    public function deleteCommentReaction(string $owner, string $repositoryName, int $id, string $reaction): bool
    {
        $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/comments/' . $id . '/reactions',
            'DELETE',
            ['json' => ['content' => $reaction]]
        );

        return true;
    }

    public function getIssueComments(string $owner, string $repositoryName, int $index): array
    {
        $response = $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/comments'
        );

        return $response->toArray();
    }

    public function addIssueComment(string $owner, string $repositoryName, int $index, string $body): array
    {
        $response = $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/comments',
            'POST',
            ['json' => ['body' => $body]]
        );

        return $response->toArray();
    }
}
