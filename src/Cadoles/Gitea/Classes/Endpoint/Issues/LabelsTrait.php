<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\Issues;

use Cadoles\Gitea\Client;

/**
 * Issues Labels Trait
 */
trait LabelsTrait
{
    public function getLabels(string $owner, string $repositoryName, int $index): array
    {
        $response = $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/labels'
        );

        return $response->toArray();
    }

    public function replaceLabels(string $owner, string $repositoryName, int $index, array $labels): array
    {
        $options = [
            'json'=>[
                'labels' => $labels
            ]
        ];

        $response = $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/labels', 
            'PUT', 
            $options
        );

        return $response->toArray();
    }

    public function addLabels(string $owner, string $repositoryName, int $index, array $labels): array
    {
        $options['json'] =[
            'json'=>[
                'labels' => $labels
            ]
        ];

        $response = $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/labels',
            'POST',
            $options);

        return $response->toArray();
    }

    public function deleteAllLabels(string $owner, string $repositoryName, int $index): bool
    {
        $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/labels',
            'DELETE');

        return true;
    }

    public function deleteLabel(string $owner, string $repositoryName, int $index, int $id): bool
    {
        $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/labels/' . $id,
            'DELETE');

        return true;
    }

    public function getRepositoryLabels(string $owner, string $repositoryName): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/labels');

        return $response->toArray();
    }

    public function getRepositoryLabel(string $owner, string $repositoryName, int $id): array
    {
        $response = $this->client->request(self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/labels/' . $id);

        return $response->toArray();
    }

    public function updateRepositoryLabel(
        string $owner,
        string $repositoryName,
        int $id,
        ?string $name = null,
        ?string $description = null,
        ?string $color = null
    ): array
    {
        $options = [
            'json' => [
                'name' => $name,
                'description' => $description,
                'color' => $color,
            ]
        ];
        $options['json'] = $this->removeNullValues($options['json']);

        $response = $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/labels/' . $id,
            'PATCH',
            $options
        );

        return $response->toArray();
    }

    public function deleteRepositoryLabel(string $owner, string $repositoryName, int $id): bool
    {
        $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/labels/' . $id,
            'DELETE'
        );

        return true;
    }
}
