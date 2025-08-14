<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\Repositories;

use Cadoles\Gitea\Client;

/**
 * Repositories Releases Trait
 */
trait ReleasesTrait
{
    public function getReleases(string $owner, string $repositoryName): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/releases');

        return $response->toArray();
    }

    public function createRelease(
        string $owner,
        string $repositoryName,
        string $tagName,
        ?string $body = null,
        ?bool $draft = null,
        ?string $name = null,
        ?bool $prerelease = null,
        ?string $targetCommitish = null
    ): array
    {
        $options['json'] = [
            'tag_name' => $tagName,
            'body' => $body,
            'draft' => $draft,
            'name' => $name,
            'prerelease' => $prerelease,
            'target_commitish' => $targetCommitish,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/releases', 'POST', $options);

        return $response->toArray();
    }

    public function getRelease(string $owner, string $repositoryName, int $id): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/releases/' . $id);

        return $response->toArray();
    }

    public function deleteRelease(string $owner, string $repositoryName, int $id): bool
    {
        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/releases/' . $id, 'DELETE');

        return true;
    }

    public function updateRelease(
        string $owner,
        string $repositoryName,
        int $id,
        ?string $tagName = null,
        ?string $body = null,
        ?bool $draft = null,
        ?string $name = null,
        ?bool $prerelease = null,
        ?string $targetCommitish = null
    ): array
    {
        $options['json'] = [
            'tag_name' => $tagName,
            'body' => $body,
            'draft' => $draft,
            'name' => $name,
            'prerelease' => $prerelease,
            'target_commitish' => $targetCommitish,
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/releases/' . $id, 'PATCH', $options);

        return $response->toArray();
    }

    public function getReleaseAssets(string $owner, string $repositoryName, int $id): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/releases/' . $id . '/assets');

        return $response->toArray();
    }

    public function getReleaseAsset(string $owner, string $repositoryName, int $id, int $assetId): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/releases/' . $id . '/assets/' . $assetId);

        return $response->toArray();
    }

    public function deleteReleaseAsset(string $owner, string $repositoryName, int $id, int $assetId): bool
    {
        $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/releases/' . $id . '/assets/' . $assetId, 'DELETE');

        return true;
    }

    public function updateReleaseAsset(string $owner, string $repositoryName, int $id, int $assetId, string $name): array
    {
        $options['json'] = [
            'name' => $name
        ];

        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/releases/' . $id . '/assets/' . $assetId, 'PATCH', $options);

        return $response->toArray();
    }
}
