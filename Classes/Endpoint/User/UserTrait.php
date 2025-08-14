<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint\User;

use Cadoles\Gitea\Client;

/**
 * Users User Trait
 */
trait UserTrait
{
    public function get(): array
    {
        $response = $this->client->request(self::BASE_URI);

        return $response->toArray();
    }

    public function getEmails(): array
    {
        $response = $this->client->request(self::BASE_URI . '/emails');

        return $response->toArray();
    }

    public function addEmails(array $emails): array
    {
        $options['json'] = [
            'emails' => $emails
        ];

        $response = $this->client->request(self::BASE_URI . '/emails', 'POST', $options);

        return $response->toArray();
    }

    public function deleteEmails(array $emails): bool
    {
        $options['json'] = [
            'emails' => $emails
        ];

        $this->client->request(self::BASE_URI . '/emails', 'DELETE', $options);

        return true;
    }

    public function getStopwatches(): array
    {
        $response = $this->client->request(self::BASE_URI . '/stopwatches');

        return $response->toArray();
    }

    public function getTeams(): array
    {
        $response = $this->client->request(self::BASE_URI . '/teams');

        return $response->toArray();
    }

    public function getTimes(): array
    {
        $response = $this->client->request(self::BASE_URI . '/times');

        return $response->toArray();
    }
}
