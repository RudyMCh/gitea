<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\Repositories;

use Cadoles\Gitea\Client;

/**
 * Repositories Contents Trait
 */
trait ContentsTrait
{
    public function getContents(string $owner, string $repositoryName, ?string $ref = null): array
    {
        $options['query'] = [
            'ref' => $ref
        ];
        $options['query'] = $this->removeNullValues($options['query']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/contents');

        return $response->toArray();
    }

    public function getContent(string $owner, string $repositoryName, string $filepath, ?string $ref = null): array
    {
        $options['query'] = [
            'ref' => $ref
        ];
        $options['query'] = $this->removeNullValues($options['query']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/contents/' . $filepath);

        return $response->toArray();
    }

    public function updateContent(
        string $owner,
        string $repositoryName,
        string $filepath,
        string $sha,
        string $content,
        ?string $authorEmail = null,
        ?string $authorName = null,
        ?string $branch = null,
        ?string $committerEmail = null,
        ?string $committerName = null,
        ?\DateTime $authorDate = null,
        ?\DateTime $committerDate = null,
        ?string $message = null,
        ?string $newBranch = null
    ): array
    {
        $options['json'] = [
            'sha' => $sha,
            'content' => base64_encode($content),
            'author' => [
                'email' => $authorEmail,
                'name' => $authorName,
            ],
            'branch' => $branch,
            'committer' => [
                'email' => $committerEmail,
                'name' => $committerName,
            ],
            'dates' => [
                'author' => $authorDate?->format(\DateTime::ATOM),
                'committer' => $committerDate?->format(\DateTime::ATOM),
            ],
            'message' => $message,
            'new_branch' => $newBranch,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/contents/' . $filepath, 'PUT', $options);

        return $response->toArray();
    }

    public function addContent(
        string $owner,
        string $repositoryName,
        string $filepath,
        string $content,
        ?string $authorEmail = null,
        ?string $authorName = null,
        ?string $branch = null,
        ?string $committerEmail = null,
        ?string $committerName = null,
        ?\DateTime $authorDate = null,
        ?\DateTime $committerDate = null,
        ?string $message = null,
        ?string $newBranch = null
    ): array
    {
        $options['json'] = [
            'content' => base64_encode($content),
            'author' => [
                'email' => $authorEmail,
                'name' => $authorName,
            ],
            'branch' => $branch,
            'committer' => [
                'email' => $committerEmail,
                'name' => $committerName,
            ],
            'dates' => [
                'author' => $authorDate ? $authorDate->format(\DateTime::ATOM) : null,
                'committer' => $committerDate ? $committerDate->format(\DateTime::ATOM) : null,
            ],
            'message' => $message,
            'new_branch' => $newBranch,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/contents/' . $filepath, 'POST', $options);

        return $response->toArray();
    }

    public function deleteContent(
        string $owner,
        string $repositoryName,
        string $filepath,
        string $sha,
        ?string $authorEmail = null,
        ?string $authorName = null,
        ?string $branch = null,
        ?string $committerEmail = null,
        ?string $committerName = null,
        ?\DateTime $authorDate = null,
        ?\DateTime $committerDate = null,
        ?string $message = null,
        ?string $newBranch = null
    ): array
    {
        $options['json'] = [
            'sha' => $sha,
            'author' => [
                'email' => $authorEmail,
                'name' => $authorName,
            ],
            'branch' => $branch,
            'committer' => [
                'email' => $committerEmail,
                'name' => $committerName,
            ],
            'dates' => [
                'author' => $authorDate ? $authorDate->format(\DateTime::ATOM) : null,
                'committer' => $committerDate ? $committerDate->format(\DateTime::ATOM) : null,
            ],
            'message' => $message,
            'new_branch' => $newBranch,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/contents/' . $filepath, 'DELETE', $options);

        return $response->toArray();
    }

    public function getEditorConfig(string $owner, string $repositoryName, string $filepath): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/editorconfig/' . $filepath);

        return $response->toArray();
    }

    public function getRawContent(string $owner, string $repositoryName, string $filepath): string
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/raw/' . $filepath);

        return (string)$response->getBody();
    }
}
