<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\Issues;

use Cadoles\Gitea\Client;

/**
 * Issues Stopwatch Trait
 */
trait StopwatchTrait
{
    public function startStopwatch(string $owner, string $repositoryName, int $index): bool
    {
        $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/stopwatch/start',
            'POST'
        );

        return true;
    }

    public function stopStopwatch(string $owner, string $repositoryName, int $index): bool
    {
        $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/stopwatch/stop',
            'POST'
        );

        return true;
    }

    public function deleteStopwatch(string $owner, string $repositoryName, int $index): bool
    {
        $this->client->request(
            self::BASE_URI . '/' . $owner . '/' . $repositoryName . '/issues/' . $index . '/stopwatch/delete',
            'DELETE'
        );

        return true;
    }
}
